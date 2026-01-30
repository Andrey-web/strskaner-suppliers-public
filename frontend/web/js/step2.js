$(document).ready(function () {

    $.fn.setCursorPosition = function (pos) {
        if ($(this).get(0).setSelectionRange) {
            $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
            var range = $(this).get(0).createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    };

    $(".tel").click(function () {
        if ($(this).val() == '+7(___)___-__-__') {
            $(this).setCursorPosition(0);
        }
    }).mask("+7(999) 999-9999");

    // $(".inn").click(function () {
    //     if ($(this).val() == '__________') {
    //         $(this).setCursorPosition(0);
    //     }
    // }).mask("9999999999");
    //
    //
    // $(".inn").mask("9999999999");
    $(".tel").mask("+7(999)999-99-99");


    // $('.inn').change(function (e) {
    //     e.preventDefault();
    //     var url = "https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party";
    //     var token = "YOUR_DADATA_API_TOKEN_HERE";
    //     var query = $(this).val();
    //
    //     var options = {
    //         method: "POST",
    //         mode: "cors",
    //         headers: {
    //             "Content-Type": "application/json",
    //             "Accept": "application/json",
    //             "Authorization": "Token " + token
    //         },
    //         body: JSON.stringify({query: query})
    //     }
    //
    //     fetch(url, options)
    //         .then(response => response.text())
    //         .then(result => {
    //             var result = JSON.parse(result),
    //                 checkOkved = false,
    //                 btnSubmit = $('button[type=submit]');
    //             if (result) {
    //                 var suggestions = result.suggestions;
    //                 if (suggestions && suggestions.length) {
    //                     var info = suggestions[0];
    //                     if (info) {
    //                         var data = info.data;
    //                         if (data) {
    //
    //                             //Проверим статус
    //                             var state = data.state,
    //                                 errorMessage = false;
    //                             if (state) {
    //                                 var status = state.status;
    //                                 if (status) {
    //                                     if (status == 'ACTIVE') {
    //                                         var okveds = data.okveds;
    //                                         if (okveds) {
    //                                             for (var i = 0; i < okveds.length; i++) {
    //                                                 if (okveds[i].code == '46.73' || okveds[i].code == '46.73.6') {
    //                                                     //if(okveds[i].code == '46.90' || okveds[i].code == '46.15.3'){
    //
    //                                                     checkOkved = true;
    //                                                     break;
    //                                                 }
    //                                             }
    //                                             if (checkOkved) {
    //                                                 btnSubmit.removeAttr('disabled');
    //                                                 console.log(okveds);
    //                                             } else {
    //                                                 errorMessage = 'В организации ИНН ' + query + ' не прописаны ОКВЭД 43.73 или 46.73.6';
    //                                             }
    //                                         }
    //                                     } else {
    //                                         var listStatus = {
    //                                             'ACTIVE': 'действующая',
    //                                             'LIQUIDATING': 'ликвидируется',
    //                                             'LIQUIDATED': 'ликвидирована',
    //                                             'BANKRUPT': 'банкротство',
    //                                             'REORGANIZING': 'в процессе присоединения к другому юрлицу, с последующей ликвидацией',
    //                                         };
    //                                         errorMessage = 'Организация находится в стадии «' + listStatus[status] + '»';
    //                                     }
    //                                 }
    //
    //
    //                             }
    //
    //
    //                         }
    //                     }
    //                 } else {
    //                     errorMessage = 'Неверный ИНН';
    //                 }
    //             }
    //
    //             if (errorMessage) {
    //                 btnSubmit.attr('disabled', 'disabled');
    //                 $('.message-modal').text(errorMessage);
    //                 $('#exampleModal').modal();
    //
    //                 $('.inn').removeClass('is-valid');
    //             }
    //             else{
    //                 $('.inn').addClass('is-valid');
    //             }
    //
    //             //console.log(result);
    //         })
    //         .catch(error => console.log("error", error));
    // });



    $('#reg-form .email, #reg-form .tel, #reg-form .phone_replay').change(function(e){
        var form = $('#reg-form'),
            url = form.attr('data-url'),
            _this = $(this),
            name = _this.attr('name');
        console.log($(this));
        $.ajax({
            method: "POST",
            url: url,
            data: form.serialize(),
            dataType: "json",
            success: function (data) {
                var res = true;
                if (data) {
                    _this.removeClass('is-valid');
                    _this.removeClass('is-invalid');

                    for(p in data) {
                        console.log(p);
                        console.log(data[p][0]);
                        if(p.toUpperCase()  == name.toUpperCase() ){
                            res = false;
                        }
                    }

                    if(res){
                        _this.addClass('is-valid');
                    }
                    else{
                       // _this.addClass('is-invalid');
                    }
                    console.log(data);
                }
            }
        });
    });

    $(".name").suggestions({
        token: "YOUR_DADATA_API_TOKEN_HERE",
        type: "PARTY",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            var
                checkOkved = false,
                btnSubmit = $('button[type=submit]');

            //Проверим статус
            var data = suggestion.data,
                state = data.state,
                errorMessage = false;
            if (state) {
                var status = state.status,
                    inputINN = $('.inn');
                //Чистим старое значение на всякий случай
                inputINN.val(null);

                if (status) {
                    if (status == 'ACTIVE') {
                        var okveds = data.okveds;
                        if (okveds) {
                            for (var i = 0; i < okveds.length; i++) {
                                if (okveds[i].code == '46.73' || okveds[i].code == '46.73.6') {
                                    //if(okveds[i].code == '46.90' || okveds[i].code == '46.15.3'){

                                    checkOkved = true;
                                    break;
                                }
                            }
                            if (checkOkved) {
                                btnSubmit.removeAttr('disabled');
                                console.log(okveds);
                            } else {
                                errorMessage = 'В организации ИНН ' + data.inn + ' не прописаны ОКВЭД 43.73 или 46.73.6';
                            }
                        }
                    } else {
                        var listStatus = {
                            'ACTIVE': 'действующая',
                            'LIQUIDATING': 'ликвидируется',
                            'LIQUIDATED': 'ликвидирована',
                            'BANKRUPT': 'банкротство',
                            'REORGANIZING': 'в процессе присоединения к другому юрлицу, с последующей ликвидацией',
                        };
                        errorMessage = 'Организация находится в стадии «' + listStatus[status] + '»';
                    }
                }
            }

            if (errorMessage) {
                btnSubmit.attr('disabled', 'disabled');
                $('.message-modal').text(errorMessage);
                $('.btn-modal').text('Изменить ИНН');
                $('#exampleModal').modal();

                $('.name').removeClass('is-valid');
            }
            else{

                $('.inn').val(data.inn);

                //Проверим нет ли уже такой организации

                $.ajax({
                    method: "POST",
                    url: $('#reg-form').attr('data-url-exist'),
                    data: {inn: $('.inn').val()},
                    dataType: "json",
                    success: function (data) {
                        if (data && !data.result) {
                            $('.message-modal').text('Организация с таким ИНН уже зарегистрирована.');
                            $('#exampleModal').modal();
                            $('.btn-modal').text('Изменить ИНН');
                            console.log(data);
                        }
                        else{
                            $('.name').addClass('is-valid');
                        }
                    }
                });
            }

            console.log(suggestion);
        }
    });

    $('.btn-go').click(function(e){
        var phone = $('#phone').val(),
            phoneReplay = $('#phone_replay').val();
        if(phone != phoneReplay){
            e.preventDefault();
            $('.message-modal').text('Телефоны не совпадают.');
            $('.btn-modal').text('Изменить телефоны');
            $('#exampleModal').modal();
        }
    });

});