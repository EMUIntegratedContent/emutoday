// Detects the presence of an alert issued from CMA 1 on EMU's main website.

$(document).ready(function(){
    $.getJSON( "http://www.emich.edu/admin/api/emergency_api.php", function( data ) {
        if(data.display == "no"){
            $( "#emergency-bar" ).removeClass("no");
            $( "#emergency-title" ).html( data.title );
            $( "#emergency-message" ).html( data.message );
            
            if( data.severity == "yellow" ){
                $("#emergency-bar").addClass("emergency-yellow");
            }
            
            if( data.severity == "red" ){
                $("#emergency-bar").addClass("emergency-red");
            }
        }
        
        console.log(data);
    });
});


