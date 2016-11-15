/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    $("#admin-search-form").submit(function(e){
        e.preventDefault();
        if ( $.trim($("#searchterm").val()) != '' ){
            $("#admin-search-form")[0].submit();
        }
    });
});
