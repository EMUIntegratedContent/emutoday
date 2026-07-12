
/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/assets/js/admin-emucustom.js ***!
  \************************************************/
$(document).ready(function () {
  $("#admin-search-form").submit(function (e) {
    e.preventDefault();
    if ($.trim($("#searchterm").val()) != '') {
      $("#admin-search-form")[0].submit();
    }
  });

  // used in the admin/user view to toggle showing archived users in the table
  $("#showarchived").on("change", function () {
    var showParam = 'showarchived';

    // Get the current URL
    var url = window.location.href;

    // Check if the checkbox is checked or unchecked
    if ($(this).prop('checked')) {
      // Add the 'show' parameter to the URL
      if (url.indexOf('?') === -1) {
        url += '?' + showParam + '=1';
      } else {
        url += '&' + showParam + '=1';
      }
    } else {
      // Remove the 'show' parameter from the URL
      url = url.replace(new RegExp('[?&]' + showParam + '=1'), '');
    }

    // Perform the redirection
    window.location.href = url;
  });
});
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9lbXV0b2RheS8uL3Jlc291cmNlcy9hc3NldHMvanMvYWRtaW4tZW11Y3VzdG9tLmpzIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5Iiwic3VibWl0IiwiZSIsInByZXZlbnREZWZhdWx0IiwidHJpbSIsInZhbCIsIm9uIiwic2hvd1BhcmFtIiwidXJsIiwid2luZG93IiwibG9jYXRpb24iLCJocmVmIiwicHJvcCIsImluZGV4T2YiLCJyZXBsYWNlIiwiUmVnRXhwIl0sIm1hcHBpbmdzIjoiOzs7Ozs7QUFBQUEsQ0FBQyxDQUFDQyxRQUFRLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFlBQVk7RUFDN0JGLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDRyxNQUFNLENBQUMsVUFBVUMsQ0FBQyxFQUFFO0lBQzNDQSxDQUFDLENBQUNDLGNBQWMsRUFBRTtJQUNsQixJQUFJTCxDQUFDLENBQUNNLElBQUksQ0FBQ04sQ0FBQyxDQUFDLGFBQWEsQ0FBQyxDQUFDTyxHQUFHLEVBQUUsQ0FBQyxJQUFJLEVBQUUsRUFBRTtNQUN6Q1AsQ0FBQyxDQUFDLG9CQUFvQixDQUFDLENBQUMsQ0FBQyxDQUFDLENBQUNHLE1BQU0sRUFBRTtJQUNwQztFQUNELENBQUMsQ0FBQzs7RUFHRDtFQUNESCxDQUFDLENBQUMsZUFBZSxDQUFDLENBQUNRLEVBQUUsQ0FBQyxRQUFRLEVBQUUsWUFBVztJQUMxQyxJQUFNQyxTQUFTLEdBQUcsY0FBYzs7SUFFaEM7SUFDQSxJQUFJQyxHQUFHLEdBQUdDLE1BQU0sQ0FBQ0MsUUFBUSxDQUFDQyxJQUFJOztJQUU5QjtJQUNBLElBQUdiLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2MsSUFBSSxDQUFDLFNBQVMsQ0FBQyxFQUFFO01BQzNCO01BQ0EsSUFBSUosR0FBRyxDQUFDSyxPQUFPLENBQUMsR0FBRyxDQUFDLEtBQUssQ0FBQyxDQUFDLEVBQUU7UUFDNUJMLEdBQUcsSUFBSSxHQUFHLEdBQUdELFNBQVMsR0FBRyxJQUFJO01BQzlCLENBQUMsTUFDSTtRQUNKQyxHQUFHLElBQUksR0FBRyxHQUFHRCxTQUFTLEdBQUcsSUFBSTtNQUM5QjtJQUNELENBQUMsTUFDSTtNQUNKO01BQ0FDLEdBQUcsR0FBR0EsR0FBRyxDQUFDTSxPQUFPLENBQUMsSUFBSUMsTUFBTSxDQUFDLE1BQU0sR0FBR1IsU0FBUyxHQUFHLElBQUksQ0FBQyxFQUFFLEVBQUUsQ0FBQztJQUM3RDs7SUFFQTtJQUNBRSxNQUFNLENBQUNDLFFBQVEsQ0FBQ0MsSUFBSSxHQUFHSCxHQUFHO0VBQzNCLENBQUMsQ0FBQztBQUNILENBQUMsQ0FBQyxDIiwiZmlsZSI6Ii9qcy9hZG1pbi1lbXVjdXN0b20uanMiLCJzb3VyY2VzQ29udGVudCI6WyIkKGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbiAoKSB7XG5cdCQoXCIjYWRtaW4tc2VhcmNoLWZvcm1cIikuc3VibWl0KGZ1bmN0aW9uIChlKSB7XG5cdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xuXHRcdGlmICgkLnRyaW0oJChcIiNzZWFyY2h0ZXJtXCIpLnZhbCgpKSAhPSAnJykge1xuXHRcdFx0JChcIiNhZG1pbi1zZWFyY2gtZm9ybVwiKVswXS5zdWJtaXQoKTtcblx0XHR9XG5cdH0pO1xuXG5cbiAgLy8gdXNlZCBpbiB0aGUgYWRtaW4vdXNlciB2aWV3IHRvIHRvZ2dsZSBzaG93aW5nIGFyY2hpdmVkIHVzZXJzIGluIHRoZSB0YWJsZVxuXHQkKFwiI3Nob3dhcmNoaXZlZFwiKS5vbihcImNoYW5nZVwiLCBmdW5jdGlvbigpIHtcblx0XHRjb25zdCBzaG93UGFyYW0gPSAnc2hvd2FyY2hpdmVkJztcblxuXHRcdC8vIEdldCB0aGUgY3VycmVudCBVUkxcblx0XHRsZXQgdXJsID0gd2luZG93LmxvY2F0aW9uLmhyZWY7XG5cblx0XHQvLyBDaGVjayBpZiB0aGUgY2hlY2tib3ggaXMgY2hlY2tlZCBvciB1bmNoZWNrZWRcblx0XHRpZigkKHRoaXMpLnByb3AoJ2NoZWNrZWQnKSkge1xuXHRcdFx0Ly8gQWRkIHRoZSAnc2hvdycgcGFyYW1ldGVyIHRvIHRoZSBVUkxcblx0XHRcdGlmICh1cmwuaW5kZXhPZignPycpID09PSAtMSkge1xuXHRcdFx0XHR1cmwgKz0gJz8nICsgc2hvd1BhcmFtICsgJz0xJztcblx0XHRcdH1cblx0XHRcdGVsc2Uge1xuXHRcdFx0XHR1cmwgKz0gJyYnICsgc2hvd1BhcmFtICsgJz0xJztcblx0XHRcdH1cblx0XHR9XG5cdFx0ZWxzZSB7XG5cdFx0XHQvLyBSZW1vdmUgdGhlICdzaG93JyBwYXJhbWV0ZXIgZnJvbSB0aGUgVVJMXG5cdFx0XHR1cmwgPSB1cmwucmVwbGFjZShuZXcgUmVnRXhwKCdbPyZdJyArIHNob3dQYXJhbSArICc9MScpLCAnJyk7XG5cdFx0fVxuXG5cdFx0Ly8gUGVyZm9ybSB0aGUgcmVkaXJlY3Rpb25cblx0XHR3aW5kb3cubG9jYXRpb24uaHJlZiA9IHVybDtcblx0fSk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=