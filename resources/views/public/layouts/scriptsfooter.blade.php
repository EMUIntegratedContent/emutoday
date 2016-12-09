<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/public-scripts.js"></script>
<script type="text/javascript" src="/js/vue-search-form.js"></script>
<script type="text/javascript" src="/js/vue-search-form-offcanvas.js"></script>
<script type="text/javascript" src="/js/emergency.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            callbacks: {
                open: function () {
                    var video = document.getElementById("holiday");

                    if (video != null) {
                        video.pause();
                    }

                    _gaq.push(['_trackEvent', 'Front Video', 'Play', 'YouTube']);
                },
                close: function () {
                    var video = document.getElementById("holiday");

                    if (video != null && video.ended == false) {
                        video.play();
                    }
                }
            }
        });
    });
</script>
@yield('scriptsfooter')
