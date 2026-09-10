;(function (exports) {
	var MS_IN_MINUTES = 60 * 1000

	var formatTime = function (date) {
		return date.toISOString().replace(/-|:|\.\d+/g, "")
	}

	var calculateEndTime = function (event) {
		return event.end
			? formatTime(event.end)
			: formatTime(
					new Date(event.start.getTime() + event.duration * MS_IN_MINUTES)
				)
	}

	var calendarGenerators = {
		google: function (event) {
			var startTime = formatTime(event.start)
			var endTime = calculateEndTime(event)

			var href = encodeURI(
				[
					"https://www.google.com/calendar/render",
					"?action=TEMPLATE",
					"&text=" + (event.title || ""),
					"&dates=" + (startTime || ""),
					"/" + (endTime || ""),
					"&details=" + (event.description || ""),
					"&location=" + (event.address || ""),
					"&timeZone=" + (event.timezone || ""),
					"&sprop=&sprop=name:"
				].join("")
			)
			return (
				'<a class="icon-google" target="_blank" href="' +
				href +
				'"><i class="fa fa-google" aria-hidden="true"></i>Add to Google Calendar</a>'
			)
		},

		ics: function (event, eClass, calendarName) {
			// If a server-hosted .ics URL is provided, link to it directly. A real
			// text/calendar file lets mobile Safari / iOS Calendar open the "Add to
			// Calendar" sheet -- iOS blocks navigation to the data: URI used below,
			// which is why this option did nothing on mobile.
			if (event.icsUrl) {
				return (
					'<a class="' +
					eClass +
					'" href="' +
					event.icsUrl +
					'">' +
					calendarName +
					'</a>'
				)
			}

			var startTime = formatTime(event.start)
			var endTime = calculateEndTime(event)

			var href = encodeURI(
				"data:text/calendar;charset=utf8," +
					[
						"BEGIN:VCALENDAR",
						"VERSION:2.0",
						"BEGIN:VEVENT",
						"URL:" + document.URL,
						"DTSTART:" + (startTime || ""),
						"DTEND:" + (endTime || ""),
						"SUMMARY:" + (event.title || ""),
						"DESCRIPTION:" + (event.description || ""),
						"LOCATION:" + (event.address || ""),
						"END:VEVENT",
						"END:VCALENDAR"
					].join("\n")
			)

			return (
				'<a class="' +
				eClass +
				'" target="_blank" href="' +
				href +
				'">' +
				calendarName +
				'</a>'
			)
		},

		apple: function (event) {
			return this.ics(
				event,
				"icon-apple",
				'<i class="fa fa-apple" aria-hidden="true"></i>Add to Apple Calendar'
			)
		},

		ical: function (event) {
			return this.ics(
				event,
				"icon-ical",
				'<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>Download .ics File'
			)
		},

		outlook: function (event) {
			// Outlook web compose deeplink (Microsoft 365 / work + school accounts).
			// Wants ISO 8601 with separators (2026-09-10T18:00:00Z), unlike the
			// stripped format used for the .ics data URI above. Personal
			// @outlook.com/@hotmail accounts use outlook.live.com instead of
			// outlook.office.com; EMU is M365 so office.com is the right host.
			var end = event.end
				? event.end
				: new Date(event.start.getTime() + event.duration * MS_IN_MINUTES)
			var startTime = event.start.toISOString().replace(/\.\d{3}/, "")
			var endTime = end.toISOString().replace(/\.\d{3}/, "")

			var href =
				"https://outlook.office.com/calendar/0/deeplink/compose?path=/calendar/action/compose&rru=addevent" +
				"&subject=" +
				encodeURIComponent(event.title || "") +
				"&startdt=" +
				encodeURIComponent(startTime) +
				"&enddt=" +
				encodeURIComponent(endTime) +
				"&body=" +
				encodeURIComponent(event.description || "") +
				"&location=" +
				encodeURIComponent(event.address || "")

			return (
				'<a class="icon-outlook" target="_blank" href="' +
				href +
				'"><i class="fa fa-windows" aria-hidden="true"></i>Add to Outlook Calendar</a>'
			)
		}
	}

	var generateCalendars = function (event) {
		return {
			google: calendarGenerators.google(event),
			apple: calendarGenerators.apple(event),
			outlook: calendarGenerators.outlook(event),
			ical: calendarGenerators.ical(event)
		}
	}

	// Create CSS
	var addCSS = function () {
		if (!document.getElementById("ouical-css")) {
			document.getElementsByTagName("head")[0].appendChild(generateCSS())
		}
	}

	var generateCSS = function () {
		var styles = document.createElement("style")
		styles.id = "ouical-css"

		styles.innerHTML =
			"#add-to-calendar-checkbox-label{cursor:pointer}.add-to-calendar-checkbox~.cal-line{display:none}.add-to-calendar-checkbox:checked~.cal-line{display:block;margin-left:20px}.cal-line>a{display:inline}input[type=checkbox].add-to-calendar-checkbox{position:absolute;top:-9999px;left:-9999px}.cal-line>a .fa{margin-right:.4em}"

		return styles
	}

	// Make sure we have the necessary event data, such as start time and event duration
	var validParams = function (params) {
		return (
			params.data !== undefined &&
			params.data.start !== undefined &&
			(params.data.end !== undefined || params.data.duration !== undefined)
		)
	}

	var generateMarkup = function (calendars, clazz, calendarId) {
		var result = document.createElement("div")

		result.innerHTML =
			'<label for="checkbox-for-' +
			calendarId +
			'" class="add-to-calendar-checkbox"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add to Calendar</label>'
		result.innerHTML +=
			'<input name="add-to-calendar-checkbox" class="add-to-calendar-checkbox" id="checkbox-for-' +
			calendarId +
			'" type="checkbox">'

		Object.keys(calendars).forEach(function (services) {
			result.innerHTML += '<div class="cal-line">' + calendars[services] + "</div>"
		})

		result.className = "add-to-calendar"
		if (clazz !== undefined) {
			result.className += " " + clazz
		}

		addCSS()

		result.id = calendarId
		return result
	}

	var getClass = function (params) {
		if (params.options && params.options.class) {
			return params.options.class
		}
	}

	var getOrGenerateCalendarId = function (params) {
		return params.options && params.options.id
			? params.options.id
			: Math.floor(Math.random() * 1000000) // Generate a 6-digit random ID
	}

	exports.createCalendar = function (params) {
		if (!validParams(params)) {
			console.log("Event details missing.")
			return
		}

		return generateMarkup(
			generateCalendars(params.data),
			getClass(params),
			getOrGenerateCalendarId(params)
		)
	}
})(this)
