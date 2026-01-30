$(document).ready(function () {

    setTimeout(() => $('.sms').css('display', 'inline'), 30000);

    /**
     * Подтверждение
     */
    $('.btn-confirm-code').click(function (e) {
        e.preventDefault();
        var _this = $(this),
            url = _this.attr('data-url'),
            urlReturn = _this.attr('href');

        $.ajax({
            method: "POST",
            url: url,
            data: {code: $('.codeCheck').val(), id: $('#confirm-id').val()},
            dataType: "json",
            success: function (data) {

                /*if(_this.attr('data-click')){
                    setTimeout(() => $('.sms').css('display', 'inline'), 30000);
                    _this.removeAttr('data-click');
                }*/

                if (data.result) {
                    document.location.href = urlReturn;
                }
                else{
                    $('.message-modal').text('Неверный код');
                    $('#exampleModal').modal();
                }
            }
        });
    });

    /**
     * Повторная отправка
     */
    $('.sms').click(function (e) {
        e.preventDefault();
        var _this = $(this),
            url = _this.attr('href');

        $.ajax({
            method: "POST",
            url: url,
            data: {id: $('#confirm-id').val()},
            dataType: "json",
            success: function (data) {
                if (data.result) {
                    _this.css('display', 'none');
                    $('#confirm-id').val(data.result);

                    $('.message-modal').text('Новый код отправлен');
                    $('#modal-new-code').modal();

                    setTimeout(() => $('.sms').css('display', 'inline'), 30000);

                }
            }
        });
    });

});