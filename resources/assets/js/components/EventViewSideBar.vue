<template>
	<div class="calendar-box row">
		<div class="small-12 columns">
			<div class="calendar small-12 columns">
				<div class="calendar-nav row small-collapse">
					<div class="small-2 columns">
						<button
							type="button"
							id="month-prev"
							class="text-left"
							v-on:click="newMonth('prev')"
						>
							<img
								src="/assets/imgs/calendar/green-calendar-arrow-before.png"
								alt="Previous month"
							/>
						</button>
					</div>
					<div class="text-center calendar-title small-8 columns">
						<h3 id="calendar-month-title">{{ monthVarWord }} {{ yearVar }}</h3>
					</div>
					<div class="small-2 columns">
						<button
							type="button"
							id="month-next"
							class="text-right"
							v-on:click="newMonth('next')"
						>
							<img
								src="/assets/imgs/calendar/green-calendar-arrow-after.png"
								alt="Next month"
							/>
						</button>
					</div>
				</div>
				<p class="show-for-sr" role="status" aria-live="polite">
					{{ monthAnnouncement }}
				</p>
				<table class="calendar-grid" aria-labelledby="calendar-month-title">
					<thead class="weekdays">
						<tr>
							<th v-for="weekday in weekdays" :key="weekday.short" scope="col">
								<abbr :title="weekday.full">{{ weekday.short }}</abbr>
							</th>
						</tr>
					</thead>
					<tbody class="days">
						<tr v-for="(week, weekIndex) in calendarWeeks" :key="weekIndex">
							<td v-for="(item, dayIndex) in week" :key="dayIndex">
								<span v-if="!item" aria-hidden="true"></span>
								<span v-else-if="isFiller(item.day)" class="day filler" aria-hidden="true">_</span>
								<button
									v-else-if="item.hasevents == yesEventClass"
									type="button"
									:class="dayClasses(item)"
									:aria-label="dayLabel(item)"
									:aria-pressed="item.day == selectedDayInMonth ? 'true' : 'false'"
									:aria-current="item.day == currentDayInMonth ? 'date' : null"
									v-on:click="selectDay(item.day)"
								>
									{{ item.day }}
								</button>
								<span
									v-else
									:class="dayClasses(item)"
									:aria-current="item.day == currentDayInMonth ? 'date' : null"
									>{{ item.day }}<span class="show-for-sr">, no events</span></span
								>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="row calendar-categories">
				<div class="small-12 column">
					<div class="calendar-other-categories">
						<h3>Event Categories</h3>
						<ul class="events-by-category">
							<li class="event-category">
								<label class="category-checkbox">
									<input
										type="checkbox"
										:checked="selectedCalendarCategoryIds.length === 0"
										v-on:change="selectAllEvents()"
									/>
									<strong v-if="selectedCalendarCategoryIds.length === 0"
										>All Events</strong
									>
									<span v-else>All Events</span>
								</label>
							</li>
							<li
								v-for="category in calendarCategories"
								:key="category.id"
								class="event-category"
							>
								<label class="category-checkbox">
									<input
										type="checkbox"
										:checked="
											selectedCalendarCategoryIds.includes(category.id)
										"
										v-on:change="toggleCategory(category.id)"
									/>
									<strong
										v-if="selectedCalendarCategoryIds.includes(category.id)"
										>{{ category.category }}</strong
									>
									<span v-else>{{ category.category }}</span>
								</label>
							</li>
						</ul>
					</div>
					<div class="calendar-other-categories">
						<div class="submit-calendar">
							<a href="/calendar/event/form" class="button emu-button"
								>Submit an Event</a
							>
						</div>
						<div class="ypsi-graphic">
							<a href="https://www.ypsireal.com/"
								><img
									src="/assets/imgs/calendar/visit-ypsi-real.png"
									alt="Visit Ypsi Calendar"
							/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<style>
.submit-calendar {
	padding: 0;
}

.ypsi-graphic {
	padding-bottom: 3rem;
	max-width: 140px;
}

.calendar-bar {
	background: #bebdbd;
}

.calendar-bar h4 {
	text-transform: uppercase;
	color: #fff;
	font-size: 1.2rem;
	margin-top: 0.5rem;
	margin-bottom: 0.5rem;
}

.calendar-box {
	background: #f2f2f3;
	padding-top: 0.8rem;
}

.calendar-other-categories {
	padding-top: 0.8rem;
}

.calendar-sidebar-title h4 {
	text-transform: uppercase;
	color: #fff;
	margin-top: 0.5rem;
}

.calendar-text-content p {
	text-align: left;
}

.events-by-category .event-category label {
	font-size: 0.9rem;
}

.calendar .calendar-grid {
	width: 100%;
	table-layout: fixed;
	border-collapse: collapse;
	margin: 0;
}

.calendar .calendar-grid thead,
.calendar .calendar-grid tbody,
.calendar .calendar-grid tr,
.calendar .calendar-grid tr:nth-child(even) {
	background: transparent;
	border: 0;
}

.calendar .calendar-grid th,
.calendar .calendar-grid td {
	padding: 4px 0;
	text-align: center;
	font-size: 12px;
	font-weight: normal;
}

.calendar .weekdays {
	color: #515151;
}

.calendar .weekdays abbr {
	border-bottom: none;
	text-decoration: none;
	cursor: default;
}

.calendar .days {
	color: #595959;
}

.calendar .event-category span {
	font-size: 10px;
	text-transform: uppercase;
	font-weight: bold;
}

.calendar .day {
	display: block;
	width: 100%;
	padding: 4px 0;
	border: 1px solid #f2f2f3;
	font-size: 12px;
	line-height: inherit;
	color: #595959;
}

.calendar button.day {
	cursor: pointer;
}

.calendar button.day:hover {
	border-radius: 5px;
	border: 1px solid #0f654a;
}

.calendar .day:focus-visible,
.calendar-nav button:focus-visible {
	outline: 2px solid #0f654a;
	outline-offset: 1px;
	border-radius: 5px;
}

.calendar .day.istoday {
	border-radius: 5px;
	border: 1px solid #0f654a;
}

.calendar .day.active {
	border-radius: 5px;
	border: 1px solid #0f654a;
	background: #fff;
}

.calendar .day.yes-events {
	color: #0f654a;
	font-weight: bold;
}

.calendar .day.no-events {
	color: #595959;
}

.calendar-box caption {
	font-weight: 400;
	margin-bottom: 0.3rem;
}

.calendar-caption p {
	font-weight: 400;
	margin-bottom: 0.3rem;
}

.calendar-caption a {
	font-weight: 400;
	margin-bottom: 0.3rem;
	border: 1px none #000;
}

.calendar-nav button {
	display: block;
	width: 100%;
	padding: 4px 0;
	border: none;
	background: none;
	cursor: pointer;
}

.calendar-title h3 {
	font-family: inherit;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.4rem;
	margin: 0;
	padding: 4px 0;
}

.calendar-other-categories h3 {
	font-size: 1.2rem;
}

.events-by-category {
	padding: 0;
}

.events-by-category > li:first-child {
	border-bottom: 2px solid #0f654a;
	padding-bottom: 0.2rem;
}

.event-category {
	position: relative;
	list-style: none;
	margin: 0.2rem 0;
}

.category-checkbox {
	display: flex;
	align-items: center;
	gap: 0.5rem;
	cursor: pointer;
	margin: 0;
}

.category-checkbox input[type="checkbox"] {
	margin: 0;
	flex: 0 0 auto;
}
</style>

<script>
import { mapState, mapMutations } from "vuex"

export default {
	components: {},
	props: {
		starthere: {}
	},
	data: function () {
		return {
			calevents: {},
			yearVar: "",
			monthVar: "",
			monthVarWord: "",
			dayVar: "",
			monthArray: [],
			currentDay: "",
			currentDate: {
				yearVar: "",
				monthVar: "",
				monthVarWord: "",
				dayVar: ""
			},
			selectedDate: {
				yearVar: "",
				monthVar: "",
				monthVarWord: "",
				dayVar: ""
			},
			newDate: {
				yearVar: "",
				monthVar: "",
				monthVarWord: "",
				dayVar: ""
			},
			yesEventClass: "yes-events",
			noEventClass: "no-events",
			haseventClass: "no",
			selectedDay: "",
			calDaysArray: [],
			monthAnnouncement: "",
			weekdays: [
				{ short: "Sun", full: "Sunday" },
				{ short: "Mon", full: "Monday" },
				{ short: "Tue", full: "Tuesday" },
				{ short: "Wed", full: "Wednesday" },
				{ short: "Thu", full: "Thursday" },
				{ short: "Fri", full: "Friday" },
				{ short: "Sat", full: "Saturday" }
			],
			eventObject: {
				eoYear: "",
				eoMonth: "",
				eoDay: ""
			}
		}
	},
	computed: {
		...mapState(["calendarCategories", "selectedCalendarCategoryIds"]),
		currentDayInMonth() {
			if (this.yearVar == this.currentDate.yearVar) {
				if (this.monthVar == this.currentDate.monthVar) {
					return this.currentDate.dayVar
				}
			} else {
				return ""
			}
		},
		selectedDayInMonth() {
			if (this.yearVar == this.selectedDate.yearVar) {
				if (this.monthVar == this.selectedDate.monthVar) {
					return this.selectedDate.dayVar
				}
			} else {
				return ""
			}
		},
		// Split the flat day list into weeks of seven, padding the last week with nulls.
		calendarWeeks() {
			const weeks = []
			for (let i = 0; i < this.calDaysArray.length; i += 7) {
				const week = this.calDaysArray.slice(i, i + 7)
				while (week.length < 7) {
					week.push(null)
				}
				weeks.push(week)
			}
			return weeks
		}
	},
	methods: {
		...mapMutations([
			"setCalendarCategories",
			"setSelectedCalendarCategoryIds",
			"toggleCalendarCategory"
		]),
		fetchEvents() {
			this.$http
				.get("/api/events")
				.then((response) => {
					this.monthArray = response.data.monthArray
					this.currentDay = response.data.dayInMonth
				})
				.catch((e) => {
					console.log(e)
				})
		},
		// Pick a day from the calendar grid. Keeps the current category selections.
		selectDay(value) {
			this.selectedDate.yearVar = this.yearVar
			this.selectedDate.monthVar = this.monthVar
			this.selectedDate.dayVar = value
			this.selectedDay = value
			this.emitSelection()
		},
		// Add or remove a single category from the multi-select.
		toggleCategory(cateid) {
			this.toggleCalendarCategory(cateid)
			this.alignSelectedDateToCurrentDay()
			this.emitSelection()
		},
		// "All Events": clear every category selection so only events for the range show.
		selectAllEvents() {
			this.setSelectedCalendarCategoryIds([])
			this.alignSelectedDateToCurrentDay()
			this.emitSelection()
		},
		// Ensure selectedDate reflects the currently displayed month and day before emitting.
		alignSelectedDateToCurrentDay() {
			this.selectedDate.yearVar = this.yearVar
			this.selectedDate.monthVar = this.monthVar
			this.selectedDate.dayVar =
				this.selectedDayInMonth || this.selectedDate.dayVar
		},
		// Emit the selected date plus the array of selected category ids to the parent,
		// then refresh the category list for the new date range.
		emitSelection() {
			this.selectedDate.cateids = [...this.selectedCalendarCategoryIds]
			this.$emit("change-eobject", this.selectedDate)
			this.fetchCategoryList(
				this.selectedDate.yearVar,
				this.selectedDate.monthVar,
				this.selectedDate.dayVar
			)
		},
		fetchEventsByDay(value) {
			this.$http
				.get(
					"/api/calendar/events/" +
						this.selectedDate.yearVar +
						"/" +
						this.selectedDate.monthVar
				)
				.then((response) => {
					this.selectedDate.yearVar = response.data.yearVar
					this.selectedDate.monthVar = response.data.monthVar
					this.selectedDate.monthVarWord = response.data.monthVa
					this.elist = response.data.groupedByDay
				})
				.catch((e) => {
					console.log(e)
				})
		},
		newMonth(monthkey) {
			let newMonthVarUnit
			let newYearVar
			if (monthkey == "prev") {
				if (this.monthVar == 1) {
					newMonthVarUnit = 12
					newYearVar = this.yearVar - 1
				} else {
					newMonthVarUnit = this.monthVar - 1
					newYearVar = this.yearVar
				}
			} else {
				if (this.monthVar == 12) {
					newMonthVarUnit = 1
					newYearVar = this.yearVar + 1
				} else {
					newMonthVarUnit = this.monthVar + 1
					newYearVar = this.yearVar
				}
			}
			this.fetchEventsForCalendarMonth(newYearVar, newMonthVarUnit)
		},
		fetchEventsForCalendarMonth(pyear, pmonth) {
			this.yearVar = pyear
			this.monthVar = pmonth
			const apiurl = "/api/calendar/month/" + pyear + "/" + pmonth
			this.$http
				.get(apiurl)
				.then((response) => {
					this.calDaysArray = response.data.calDaysArray
					this.monthArray = response.data.monthArray

					this.monthVarWord = response.data.selectedMonthWord
					this.monthAnnouncement = this.monthVarWord + " " + this.yearVar
				})
				.catch((e) => {
					console.log(e)
				})
		},
		fetchCurrentEventsForCalendar(startObject) {
			this.yearVar = startObject.yearVar
			this.monthVar = startObject.monthVar
			this.dayVar = startObject.dayVar
			const startapiurl =
				"/api/calendar/month/" +
				this.yearVar +
				"/" +
				this.monthVar +
				"/" +
				this.dayVar
			this.$http
				.get(startapiurl)
				.then((response) => {
					this.selectedDate.yearVar = response.data.selectedYear
					this.selectedDate.monthVar = response.data.selectedMonth
					this.selectedDate.monthVarWord = response.data.selectedMonthWord
					this.selectedDate.dayVar = response.data.selectedDay
					this.currentDate.yearVar = response.data.currentYear
					this.currentDate.monthVar = response.data.currentMonth
					this.currentDate.monthVarWord = response.data.currentMonthWord
					this.currentDate.dayVar = response.data.currentDay
					this.calDaysArray = response.data.calDaysArray
					this.pushFirstDateRange()
					this.fetchCategoryList(
						this.selectedDate.yearVar,
						this.selectedDate.monthVar,
						this.selectedDate.dayVar
					)
				})
				.catch((e) => {
					console.log(e)
				})
		},
		pushFirstDateRange() {
			this.$emit("change-eobject", this.selectedDate)
		},

		fetchCategoryList(yearVar, monthVar, dayVar) {
			let url = "/api/active-categories/"
			if (yearVar && monthVar && dayVar) {
				url += yearVar + "/" + monthVar + "/" + dayVar
			}
			this.$http
				.get(url)
				.then((response) => {
					// Move the calendar called "Homecoming Week 2026" to the top of the list and remove it from where it was (CP 8/20/26)
					const homecoming = response.data.find(category => category.category === "Homecoming Week 2026")
					if (homecoming) {
						response.data.splice(response.data.indexOf(homecoming), 1)
						response.data.unshift(homecoming)
					}
					this.setCalendarCategories(response.data)
				})
				.catch((e) => {
					console.log(e)
				})
		},
		// Leading cells before the 1st of the month come from the API as "x1", "x2", etc.
		isFiller(day) {
			return String(day)[0] == "x"
		},
		dayClasses(item) {
			return [
				"day",
				{ istoday: item.day == this.currentDayInMonth },
				{ "no-events": item.hasevents == this.noEventClass },
				{ "yes-events": item.hasevents == this.yesEventClass },
				{ active: item.day == this.selectedDayInMonth }
			]
		},
		dayLabel(item) {
			return (
				this.monthVarWord + " " + item.day + ", " + this.yearVar + ", has events"
			)
		}
	},
	mounted() {
		const now = new Date()
		const selYear =
			parseInt(this.selectedDate.yearVar) ||
			parseInt(this.yearVar) ||
			now.getFullYear()
		const selMonth =
			parseInt(this.selectedDate.monthVar) ||
			parseInt(this.monthVar) ||
			now.getMonth() + 1

		this.yearVar = selYear
		this.monthVar = selMonth
		this.monthVarWord = new Date(selYear, selMonth - 1, 1).toLocaleString(
			"en-US",
			{ month: "long" }
		)

		this.fetchCategoryList()
	},
	watch: {
		starthere(newVal) {
			// watch it
			this.fetchCurrentEventsForCalendar(newVal)
		}
	}
}
</script>
