$(document).foundation();
$(document).ready(function() {
  $('.popup-youtube').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
  });

  // Internet Explorer 6-11 (http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser)
  const isIE = /*@cc_on!@*/false || !!document.documentMode;
  if(isIE){
      $('#outdated-browser-container').html('<p class="browserupgrade">EMU Today does not support Internet Explorer 10 or below. Please download the latest versions of <a href="https://www.mozilla.org/en-US/firefox/new/?utm_medium=referral&utm_source=firefox-com" class="firefox">Firefox</a> or <a href="https://www.google.com/chrome/" class="chrome">Chrome</a> to improve your viewing experience.</p>');
  }

  // Emergency Banner
  const env = window.APP_ENV // passed in from scriptsfooter.blade.php
  let url = "https://ic.emich.edu/api/emergency/banner"
  if(env !== "production"){
    url = "https://ictest.emich.edu/api/emergency/banner"
  }

  $.getJSON(url, function( data ) {
    if(data.displayBanner === true){
        $( "#emergency-bar" ).removeClass("no")
        $( "#emergency-title" ).html( data.bannerTitle )
        $( "#emergency-message" ).html( data.bannerMessage )
        $( "#emergency-bar-content").append('<h3 id="emergency-title">' + data.bannerTitle + '</h3>')
        $( "#emergency-bar-content").append('<p id="emergency-message">' + data.bannerMessage + '</p>')
        if( data.severity == "warning" ){
            $("#emergency-bar").addClass("emergency-yellow")
        }
        if( data.severity == "red" ){
            $("#emergency-bar").addClass("emergency-red")
        }
    }
  })
})

// KEYBOARD BINDINGS
const map = {}; // Stores key that have been pressed
onkeydown = onkeyup = function(e){
	e = e || event; // to deal with IE
	map[e.keyCode] = e.type == "keydown";

	// Keybind to Admin lock button []\
	if(map[219] && map[220] && map[221]){
		document.getElementById("admin-area-lock").click();
	}
}
