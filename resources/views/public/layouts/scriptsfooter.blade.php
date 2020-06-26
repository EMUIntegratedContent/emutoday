<script type="text/javascript" src="/js/public-scripts.js"></script>
<!--[if IE]>
    <script type="text/javascript" src="/js/foundation.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/js/vue-search-form.js"></script>
<script type="text/javascript" src="/js/vue-search-form-offcanvas.js"></script>
<script type="text/javascript" src="/js/jquery.magnific-popup.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
<!-- Add-to-calendar free js plugin -->
<script type="text/javascript" src="/add-to-calendar/ouical.min.js"></script>
<!-- Add Event (replaced with a free solution (add-to-calendar/ouical.js) on 9/28/18) -->
<!--
<script type="text/javascript" src="https://addevent.com/libs/atc/1.6.1/atc.min.js" async defer></script>
-->
<script type="text/javascript">
/* Add Event settings (replaced with a free solution (add-to-calendar/ouical.js) on 9/28/18) */
/*
window.addeventasync = function(){
    addeventatc.settings({
        license    : "atdkyfGQrzEzDlSNTmQU26933",
        mouse      : false,
        css        : true,
        outlook    : {show:true, text:"Outlook"},
        google     : {show:true, text:"Google <em>(online)</em>"},
        yahoo      : {show:true, text:"Yahoo <em>(online)</em>"},
        outlookcom : {show:true, text:"Outlook.com <em>(online)</em>"},
        appleical  : {show:true, text:"Apple Calendar"},
        facebook   : {show:true, text:"Facebook Event"},
        dropdown   : {order:"outlook,google,appleical"}
    });
};
*/
// Detects the presence of an alert issued from the emergency application on EMU's main website.
$(document).ready(function(){
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
    });
});
</script>
@yield('scriptsfooter')
