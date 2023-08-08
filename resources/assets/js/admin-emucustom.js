$(document).ready(function () {
	$("#admin-search-form").submit(function (e) {
		e.preventDefault();
		if ($.trim($("#searchterm").val()) != '') {
			$("#admin-search-form")[0].submit();
		}
	});


  // used in the admin/user view to toggle showing archived users in the table
	$("#showarchived").on("change", function() {
		const showParam = 'showarchived';

		// Get the current URL
		let url = window.location.href;

		// Check if the checkbox is checked or unchecked
		if($(this).prop('checked')) {
			// Add the 'show' parameter to the URL
			if (url.indexOf('?') === -1) {
				url += '?' + showParam + '=1';
			}
			else {
				url += '&' + showParam + '=1';
			}
		}
		else {
			// Remove the 'show' parameter from the URL
			url = url.replace(new RegExp('[?&]' + showParam + '=1'), '');
		}

		// Perform the redirection
		window.location.href = url;
	});
});
