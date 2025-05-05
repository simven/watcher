import './bootstrap';
import $ from 'jquery';

window.$ = window.jQuery = $;

window.opena = function(event, saisonid) {
    if ($("#" + saisonid).hasClass("open")) {
        $("#saisons").children().removeClass("open");
    } else {
        $("#saisons").children().removeClass("open");
        $("#" + saisonid).addClass("open");
    }
};
