(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

$(document).foundation();
$(document).ready(function () {
  $('.popup-youtube').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });

  /**
   * These blocks ensure image captions do not stretch image dimensions on news stories
   */
  $.each($('figure img'), function () {
    var imgWidth = $(this).width();
    var figureWidth = imgWidth + 40; //38px ~ 1.11rem x 2(sides)
    $(this).closest('figure').css({ 'width': figureWidth, 'overflow-wrap': 'break-word' });
  });
  $.each($('.visbox img'), function () {
    var imgWidth = $(this).width();
    $(this).closest('div.visbox').css({ 'width': imgWidth, 'overflow-wrap': 'break-word' });
  });

  /**
   * Any story image floated left should have no left margin, and a right margin
   */
  $.each($('#story-content figure'), function () {
    if ($(this).css('float') == 'left') {
      $(this).css({ 'margin-left': 0, 'margin-right': '1.11111rem' });
    }
  });

  // Internet Explorer 6-11 (http://stackoverflow.com/questions/9847580/how-to-detect-safari-chrome-ie-firefox-and-opera-browser)
  var isIE = /*@cc_on!@*/false || !!document.documentMode;
  if (isIE) {
    $('#outdated-browser-container').html('<p class="browserupgrade">EMU Today does not support Internet Explorer 10 or below. Please download the latest versions of <a href="https://www.mozilla.org/en-US/firefox/new/?utm_medium=referral&utm_source=firefox-com" class="firefox">Firefox</a> or <a href="https://www.google.com/chrome/" class="chrome">Chrome</a> to improve your viewing experience.</p>');
  }
});

// KEYBOARD BINDINGS
var map = {}; // Stores key that have been pressed
onkeydown = onkeyup = function onkeyup(e) {
  e = e || event; // to deal with IE
  map[e.keyCode] = e.type == "keydown";

  // Keybind to Admin lock button []\
  if (map[219] && map[220] && map[221]) {
    document.getElementById("admin-area-lock").click();
  }
};

},{}]},{},[1]);

//# sourceMappingURL=app.js.map
