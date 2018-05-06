$(function(){
    //メニュートリガークリック
    $('.js-gnav-trigger').on('click', function(){
        $('.system-header-gnav-trigger').toggleClass('is-active');
        if($('.system-header-gnav-trigger.is-active').length > 0){
            $('.system-gnav').addClass('is-show');
        }else{
            $('.system-gnav').removeClass('is-show');
        }
    });

    $('.admin-header__item--user').hover(function(){
        $(this).children('ul').stop().slideToggle();
    });

    $('.admin-main-form__file-input').on('change', function() {
        // cropperによる画像トリミング
        let options = {
            aspectRatio: 3 / 2,
            viewMode:1,
            crop: function(e) {
                cropData = $('#select-image').cropper('getData');
                $('#upload-image-x').val(Math.floor(cropData.x));
                $('#upload-image-y').val(Math.floor(cropData.y));
                $('#upload-image-w').val(Math.floor(cropData.width));
                $('#upload-image-h').val(Math.floor(cropData.height));
            },
            zoomable:false,
            minCropBoxWidth:300,
            minCropBoxHeight:200
        }

        // 初期設定セット
        $('#select-image').cropper(options);

        // ファイル選択変更時に、選択した画像をcropperに設定する
        $('#select-image').cropper('replace', URL.createObjectURL(this.files[0]));

        let file = $(this).prop('files')[0];
        if(!($('.admin-main-form__file-name').length)){
            $('.admin-main-form__file').append('<span class="admin-main-form__file-name">'+file.name+'</span>');
        };
    });

    //現地決済
    $('.js-pay-local').on('click', paymentLocal);

    // クレジットカード決済
    $('.js-pay-credit').on('click', paymentCredit);
});

function paymentLocal() {
    // 総額取得
    const totalDue = $('.js-total-due').html();

    if(window.confirm(totalDue + '円を現地決済します。注文確定しますか？')){
        location.href = '/user/order/insert.php?pay=local';
	}else{
        return false;
    }
}

function paymentCredit() {
    if (!window.PaymentRequest) {
        alert('お使いの環境はPayment Request APIに対応していません。');
        return;
    }

    // 総額取得
    const totalDue = $('.js-total-due').html();

    // 対応支払い方法
    const supportedInstruments = [{
        supportedMethods: ['basic-card'],
        data: {
            supportedNetworks: [
                'visa', 'mastercard', 'amex', 'discover',
                'diners', 'jcb', 'unionpay'
            ]
        }
    }];

    // 金額詳細
    const details = {
        total: {
            label: '合計金額',
            amount: { currency: 'JPY', value : totalDue }
        }
    };

    // PaymentRequestインスタンス生成
    const request = new PaymentRequest(supportedInstruments, details);

    // ネイティブ UI表示
    request.show()
    // 決済処理
    .then(result => {
        location.href = '/user/order/insert.php';
        return result.complete('success');
    });
}
