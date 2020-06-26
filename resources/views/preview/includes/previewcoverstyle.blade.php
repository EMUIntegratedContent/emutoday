<style>

    div.backcover {
        opacity:0.1;
        filter: alpha(opacity=10);
        background-color:#ffffff;
        width:100%;
        height:100%;
        z-index:99999999;
        top:0;
        left:0;
        position:fixed;
    }
    div.backcoveropen {
        opacity:0.0;
        filter: alpha(opacity=0);
        background-color:transparent;
        /*background-color:#ffffff;*/
        width:100%;
        height:100%;
        z-index:99999999;
        top:0;
        left:0;
        position:fixed;
    }

#returnPanel {
position: fixed;
right: 1%; top: 1%;
opacity:0.9;
width: 100px; height: 60px;
background: white;
border-radius: 3px;
padding: 10px;
z-index: 999999999;
/*height: 7%;
width: 20%*/
}
#returnPanel a.button {
    opacity:1.0;
}
    /*div.popup {
        position: fixed;
        left: 50%; top: 50%;
        opacity:0.4;
        width: 50%; height: 50%;
        background: white;
        border-radius: 3px;
        padding: 10px;
        z-index: 11;
        height: 7%;
        width: 20%
    }*/


</style>
