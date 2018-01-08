$(function(){
    $('.admin-header__item--user').hover(function(){
        $(this).children('ul').stop().slideToggle();
    });

    $('.admin-main-form__file-input').on('change', function() {
        var file = $(this).prop('files')[0];
        if(!($('.admin-main-form__file-name').length)){
            $('.admin-main-form__file').append('<span class="admin-main-form__file-name">'+file.name+'</span>');
        };
    });

    $('.application-main-form__submit--go-select_plan').on('click', function() {
        $('.application-main-form').attr('action', 'select_plan.php');
    });
    $('.application-main-form__submit--go-input_com_info').on('click', function() {
        $('.application-main-form').attr('action', 'input_com_info.php');
    });
});
