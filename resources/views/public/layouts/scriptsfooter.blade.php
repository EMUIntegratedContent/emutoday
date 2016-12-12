<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/public-scripts.js"></script>
<script type="text/javascript" src="/js/vue-search-form.js"></script>
<script type="text/javascript" src="/js/vue-search-form-offcanvas.js"></script>
<script type="text/javascript" src="/js/emergency.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.js"></script>
<script>
    $(document).foundation();
    $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
        });
    });
</script>
@yield('scriptsfooter')
