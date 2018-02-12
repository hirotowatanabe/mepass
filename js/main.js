$(function(){
    $('.admin-header__item--user').hover(function(){
        $(this).children('ul').stop().slideToggle();
    });

    $('.admin-main-form__file-input').on('change', function() {
        //cropper
        let options = {
            aspectRatio: 3 / 2,
            viewMode:1,
            crop: function(e) {
                cropData = $('#select-image').cropper("getData");
                $("#upload-image-x").val(Math.floor(cropData.x));
                $("#upload-image-y").val(Math.floor(cropData.y));
                $("#upload-image-w").val(Math.floor(cropData.width));
                $("#upload-image-h").val(Math.floor(cropData.height));
            },
            zoomable:false,
            minCropBoxWidth:300,
            minCropBoxHeight:200
        }

        // 初期設定セット
        $('#select-image').cropper(options);

        // ファイル選択変更時に、選択した画像をCropperに設定する
        $('#select-image').cropper('replace', URL.createObjectURL(this.files[0]));

        var file = $(this).prop('files')[0];
        if(!($('.admin-main-form__file-name').length)){
            $('.admin-main-form__file').append('<span class="admin-main-form__file-name">'+file.name+'</span>');
        };
    });
});
