$(document).foundation();
$(document).ready(function() {
  $('.popup-youtube').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
  });

  /**
   * These blocks ensure image captions do not stretch image dimensions on news stories
   */
  $.each($('figure img'), function() {
      const imgWidth = $(this).width();
      const figureWidth = imgWidth + 40; //38px ~ 1.11rem x 2(sides)
      $(this).closest('figure').css({'width': figureWidth, 'overflow-wrap': 'break-word'});
  });
  $.each($('.visbox img'), function() {
      const imgWidth = $(this).width();
      $(this).closest('div.visbox').css({'width': imgWidth, 'overflow-wrap': 'break-word'});
  });

  /**
   * Any story image floated left should have no left margin, and a right margin
   */
  $.each($('#story-content figure'), function(){
    if($(this).css('float') == 'left'){
      $(this).css({'margin-left': 0, 'margin-right': '1.11111rem'});
    }
  })

  // Internet Explorer 6-11 (http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser)
  const isIE = /*@cc_on!@*/false || !!document.documentMode;
  if(isIE){
      $('#outdated-browser-container').html('<p class="browserupgrade">EMU Today does not support Internet Explorer 10 or below. Please download the latest versions of <a href="https://www.mozilla.org/en-US/firefox/new/?utm_medium=referral&utm_source=firefox-com" class="firefox">Firefox</a> or <a href="https://www.google.com/chrome/" class="chrome">Chrome</a> to improve your viewing experience.</p>');
  }

  $.getJSON( "https://www.emich.edu/admin/api/emergency_api.php", function( data ) {
    if(data.display == "yes"){
        $( "#emergency-bar" ).removeClass("no")
        $( "#emergency-title" ).html( data.title )
        $( "#emergency-message" ).html( data.message )
        $( "#emergency-bar-content").append('<h3 id="emergency-title">' + data.title + '</h3>')
        $( "#emergency-bar-content").append('<p id="emergency-message">' + data.message + '</p>')
        if( data.severity == "yellow" ){
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
