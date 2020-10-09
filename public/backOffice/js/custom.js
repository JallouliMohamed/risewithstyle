/*
-------------------------------------------------------------------------
* Template Name    : Fadmin - Responsive Bootstrap Admin Dashboard      * 
* Author           : ThemesBoss                                         *
* Version          : 1.0.0                                              *
* Created          : March 2019                                         * 
* File Description : Main JS file of the template                       *
*------------------------------------------------------------------------
*/
$(document).ready(function(){"use strict";var e=!1,s=!1,l=$("body");$(".page-header"),$(".page-sidebar"),$(".page-content");var t,n;!function(){$(".page-sidebar-inner").slimScroll({height:"100%"}).mouseover();l.hasClass("page-sidebar-fixed")&&!1===e&&(e=!0),!0===e&&(l.addClass("page-sidebar-fixed"),$("#fixed-sidebar-toggle-button").removeClass("mdi mdi-chemical-weapon"),$("#fixed-sidebar-toggle-button").addClass("mdi mdi-chemical-weapon")),$("#fixed-sidebar-toggle-button").on("click",function(){return l.toggleClass("page-sidebar-fixed"),e=!!l.hasClass("page-sidebar-fixed"),$(this).toggleClass("mdi mdi-chemical-weapon"),$(this).toggleClass("mdi mdi-chemical-weapon"),!1}),!0===s&&l.addClass("page-sidebar-collapsed"),$(".page-sidebar-collapsed .page-sidebar .accordion-menu").on({mouseenter:function(){$(".page-sidebar").addClass("fixed-sidebar-scroll")},mouseleave:function(){$(".page-sidebar").removeClass("fixed-sidebar-scroll")}},"li"),$("#collapsed-sidebar-toggle-button").on("click",function(){return l.toggleClass("page-sidebar-collapsed"),s=!!l.hasClass("page-sidebar-collapsed"),$(".page-sidebar-collapsed .page-sidebar .accordion-menu").on({mouseenter:function(){$(".page-sidebar").addClass("fixed-sidebar-scroll")},mouseleave:function(){$(".page-sidebar").removeClass("fixed-sidebar-scroll")}},"li"),!1}),$(window).width()<768&&$("#fixed-sidebar-toggle-button").hasClass("mdi mdi-chemical-weapon")&&$("#fixed-sidebar-toggle-button").click(),$(window).on("resize",function(){$(window).width()<768&&$("#fixed-sidebar-toggle-button").hasClass("mdi mdi-chemical-weapon")&&$("#fixed-sidebar-toggle-button").click()}),$("#sidebar-toggle-button").on("click",function(){return l.toggleClass("page-sidebar-visible"),!1}),$("#sidebar-toggle-button-close").on("click",function(){return l.toggleClass("page-sidebar-visible"),!1})}(),t=$(".page-sidebar li:not(.open) .sub-menu"),n=$(".page-sidebar li.active-page > a"),t.hide(),$(".accordion-menu").on("click","a",function(){var e=$(this).next(".sub-menu"),s=$(this).parent("li"),t=$(".accordion-menu > li.open");return e.length&&!l.hasClass("page-sidebar-collapsed")?(s.hasClass("open")?($(".open .sub-menu li").each(function(e){var s=$(this);setTimeout(function(){s.removeClass("animation")},5*(e+1))}),e.slideUp(100),s.removeClass("open")):(t.length&&($(".accordion-menu > li.open > .sub-menu").slideUp(100),t.removeClass("open")),e.slideDown(100),s.addClass("open"),$(".open .sub-menu li").each(function(e){var s=$(this);setTimeout(function(){s.addClass("animation")},15*(e+1))})),!1):(!e.length||!l.hasClass("page-sidebar-collapsed"))&&void 0}),$(".active-page > .sub-menu").length&&n.click(),$("#toggle-fullscreen").on("click",function(){return document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.msExitFullscreen?document.msExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.msRequestFullscreen?document.documentElement.msRequestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT),!1}),$("#search-button").on("click",function(){l.toggleClass("search-open"),l.hasClass("search-open")&&$(".search-form input").focus()}),$("#close-search").on("click",function(){l.toggleClass("search-open")}),function(){$(".right-sidebar-toggle").on("click",function(){var e=$(this).data("sidebar-id");$("#"+e).toggleClass("visible")});$(".chat-write form input").on("keypress",function(e){if(13===e.which&&0===!$(this).val().length)$(".right-sidebar-chat .chat-bubbles .chat-bubble:last-child").hasClass("me")?$('<span class="chat-bubble-text">'+$(this).val()+"</span>").insertAfter(".right-sidebar-chat .chat-bubbles .chat-bubble:last-child span:last-child"):$('<div class="chat-bubble me"><div class="chat-bubble-text-container"><span class="chat-bubble-text">'+$(this).val()+"</span></div></div>").insertAfter(".right-sidebar-chat .chat-bubbles .chat-bubble:last-child"),$(this).val("");else if(13===e.which)return;var s=$(".right-sidebar-chat").prop("scrollHeight")+"px";$(".right-sidebar-chat").slimscroll({allowPageScroll:!0,scrollTo:s})})}(),function(){$(".slimscroll").slimScroll();var e=$("input[type=checkbox]:not(.js-switch), input[type=radio]:not(.no-uniform)");e.length>0&&e.each(function(){$(this).uniform()}),Array.prototype.slice.call(document.querySelectorAll(".js-switch")).forEach(function(e){new Switchery(e,{size:"small",color:"#637282"})})}()});



// Disable cut copy paste
$('body').bind('cut copy paste', function (e) {
    e.preventDefault();
});



window.onload = function() {
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
        //document.onkeydown = function(e) {
        // "I" key
        if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
            disabledEvent(e);
        }
        // "J" key
        if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
            disabledEvent(e);
        }
        // "S" key + macOS
        if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            disabledEvent(e);
        }
        // "U" key
        if (e.ctrlKey && e.keyCode == 85) {
            disabledEvent(e);
        }
        // "F12" key
        if (event.keyCode == 123) {
            disabledEvent(e);
        }
    }, false);

    function disabledEvent(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        } else if (window.event) {
            window.event.cancelBubble = true;
        }
        e.preventDefault();
        return false;
    }
};