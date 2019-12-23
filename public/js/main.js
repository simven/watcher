

function opena(event, saisonid) {

    if ($("#"+saisonid).hasClass("open")) {
        $("#saisons").children().removeClass( "open" );
    } else {
        $("#saisons").children().removeClass( "open" );
        $("#"+saisonid).addClass("open");
    }
}