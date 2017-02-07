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
      var imgWidth = $(this).width();
      var figureWidth = imgWidth + 40; //38px ~ 1.11rem x 2(sides)
      $(this).closest('figure').css({'width': figureWidth, 'overflow-wrap': 'break-word'});

      console.log(imgWidth);
  });
  $.each($('.visbox img'), function() {
      var imgWidth = $(this).width();
      $(this).closest('div.visbox').css({'width': imgWidth, 'overflow-wrap': 'break-word'});

      console.log(imgWidth);
  });
});
