$(function(){
    $('.admin-header__item--user').hover(function(){
        $(this).children('ul').stop().slideToggle();
    });
});
