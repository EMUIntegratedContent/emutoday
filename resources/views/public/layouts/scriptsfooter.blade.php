
<script type="text/javascript" src="/add-to-calendar/ouical.min.js"></script>
<script type="text/javascript" src="/js/public-scripts.js?v=3"></script>
<script type="text/javascript" src="/js/vue-search-form.js"></script>
<script type="text/javascript" src="/js/vue-search-form-offcanvas.js"></script>
<script type="text/javascript">

{{-- Make env variable accessible to app.js file for emergency banner --}}
window.APP_ENV = "{{ config('app.env') }}";
</script>
@yield('scriptsfooter')
