$(document).ready(function () {
    let lastSuggestionValue = "";

    $(".name").suggestions({
        token: "YOUR_DADATA_API_TOKEN_HERE",
        type: "PARTY",
        onSelect: function(suggestion) {
            var data = suggestion.data;
            lastSuggestionValue = suggestion.value;

            $('.inn').val(data.inn);
            $('.legal-address').val(data.address.unrestricted_value);
            $('.full-name').val(data.name.full);

            $.ajax({
                method: "POST",
                url: '/site/exist',
                data: { inn: $('.inn').val() },
                dataType: "json",
                success: function (data) {
                    if (data && !data.result) {
                        alert('Организация с таким ИНН уже зарегистрирована');
                    }
                }
            });
        }
    });

    // Очистка связанных полей при ручном изменении
        $(".name").on("input", function () {
            const currentValue = $(this).val();

            // Если значение отличается от последней подсказки — очистить поля
            if (currentValue !== lastSuggestionValue) {
                $('.inn').val('');
                $('.legal-address').val('');
                $('.full-name').val('');
            }
        });


    $(".addressInput").suggestions({
        token: "YOUR_DADATA_API_TOKEN_HERE",
        type: "ADDRESS",
        constraints: [
            {
                locations:
                    { kladr_id: "7200000000000" },
            },
            {
                locations:
                    {kladr_id: "7200000100000"},
            }
        ],
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
        }
    });

    $('.address-copy').on('change' , function () {
        let legalAddress = $('.legal-address').val();
        if (legalAddress.length > 0) {
            $('.address').val(legalAddress)
        } else {
            alert("Юридический адрес не заполнен")
            return false;
        }
    });

    // $('.add-quarry').on('click', function (e) {
    //     e.preventDefault();
    //
    //     let element = $('.delivery-option');
    //     let item = element.first().clone();
    //
    //     // Очистка значений
    //     item.find('input').val('');
    //
    //     // Получаем текущий индекс (количество уже добавленных блоков)
    //     let index = $('.delivery-option').length;
    //
    //     // Обновляем атрибуты name
    //     item.find('[name^="quarries"]').each(function () {
    //         let name = $(this).attr('name');
    //         let newName = name.replace(/\[\d+\]/, '[' + index + ']');
    //         $(this).attr('name', newName);
    //     });
    //
    //     $('.material__editing-block-delivery').append(item);
    //
    //     // Подключаем подсказки для нового input
    //     let newInput = item.find('.addressInput');
    //     newInput.suggestions({
    //         token: "YOUR_DADATA_API_TOKEN_HERE",
    //         type: "ADDRESS",
    //         constraints: [
    //             { locations: { kladr_id: "7200000000000" } },
    //             { locations: { kladr_id: "7200000100000" } }
    //         ],
    //         onSelect: function(suggestion) { }
    //     });
    // });
    $(document).ready(function () {
        $('.add-quarry').on('click', function (e) {
            e.preventDefault();

            let element = $('.delivery-option').first();
            let item = element.clone();

            // Очистка значений
            item.find('input').val('');

            // Определяем новый индекс
            let index = $('.delivery-option').length;

            // Обновляем атрибуты name
            item.find('[name^="quarries"]').each(function () {
                let name = $(this).attr('name');
                let newName = name.replace(/\[\d+\]/, '[' + index + ']');
                $(this).attr('name', newName);
            });

            // Добавляем кнопку удаления у новых блоков
            if (!item.find('.remove-quarry').length) {
                item.find('.quarry-address-wrapper').append('<button type="button" class="remove-quarry">✖</button>');
            }

            // Добавляем блок на страницу
            $('.material__editing-block-delivery').append(item);

            // Подключаем подсказки для нового input
            let newInput = item.find('.addressInput');
            newInput.suggestions({
                token: "YOUR_DADATA_API_TOKEN_HERE",
                type: "ADDRESS",
                constraints: [
                    { locations: { kladr_id: "7200000000000" } },
                    { locations: { kladr_id: "7200000100000" } }
                ],
                onSelect: function(suggestion) { }
            });
        });

        // Удаление блока карьера по клику на крестик (кроме первого)
        $(document).on('click', '.remove-quarry', function () {
            $(this).closest('.delivery-option').remove();

            // Перенумерация индексов
            $('.delivery-option').each(function (i) {
                $(this).find('[name^="quarries"]').each(function () {
                    let name = $(this).attr('name');
                    let newName = name.replace(/\[\d+\]/, '[' + i + ']');
                    $(this).attr('name', newName);
                });
            });
        });
    });



    $('#registration').on('submit', function (event) {
        event.preventDefault();
        let $button = $('.button__blue');
        let $text = $button.find('.button__text');
        let $loader = $button.find('.button__loader');

        $button.prop('disabled', true);
        $text.hide();
        $loader.show();

        let formData = new FormData(this);

        $.ajax({
            url: '/site/registration',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === true) {
                    $('#modal-registration').modal('show');
                } else {
                    alert(response.message || "Что-то пошло не так");
                    $button.prop('disabled', false);
                    $text.show();
                    $loader.hide();
                }
            },
            error: function (jqXHR) {
                let errorMessage = "Произошла ошибка";
                // Обработка HTTP 400 ошибки
                if (jqXHR.status === 400) {
                    // Проверяем, есть ли сообщение об ошибке в responseJSON
                    if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                        errorMessage = jqXHR.responseJSON.message;
                    }
                    // Или проверяем текст ответа, если сервер возвращает просто текст
                    else if (jqXHR.responseText) {
                        try {
                            const response = JSON.parse(jqXHR.responseText);
                            if (response.message) {
                                errorMessage = response.message;
                            }
                        } catch (e) {
                            // Если ответ не JSON, используем как есть
                            errorMessage = jqXHR.responseText;
                        }
                    }
                }
                if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                    errorMessage = jqXHR.responseJSON.error;
                }
                alert(errorMessage);
                console.log('Ошибка:', jqXHR);
                $button.prop('disabled', false);
            }
        });
    });

    $(".tel").mask("+7 (999) 999-99-99");

    $('.payment-block-wrapper span.checkbox__1').on('click', function () {
        let $input = $(this).parent().find('input');
        $input.prop('checked', !$input.prop('checked'));
    });

    $('.checkbox__1-block-p').on('change', function() {
        console.log(123)
        if ($(this).is(':checked')) {
            $('.checkbox__1-block-p').not(this).prop('checked', false);
        }
    });
    $('.payment-block-wrapper .checkbox__1').on('click', function() {
        if ($(this).parent().find('input').is(':checked')) {
            $('.payment-block-wrapper .checkbox__1-block-p').not(this).prop('checked', false);
            $(this).parent().find('input').prop('checked', true);
        }
    });
});

$(document).ready(function() {
    let map;
    let currentInput = null
    $(document).on('click', '.openMap', function() {
        currentInput = $(this).parent().find('.addressInput');

        $('#mapModal').show().css('display', 'flex');
        initMap();
    });

    // Закрытие модального окна
    $('#closeMap').click(function() {
        $('#mapModal').hide();
        currentInput = null;
    });

    // Инициализация карты
    function initMap() {
        if (!map) {
            ymaps.ready(function() {
                map = new ymaps.Map('mapContainer', {
                    center: [57.153033, 65.534328],
                    zoom: 12,
                    controls: ['zoomControl']
                });

                // Добавляем поиск
                const searchControl = new ymaps.control.SearchControl({
                    options: {
                        provider: 'yandex#search',
                        noPlacemark: true
                    }
                });
                map.controls.add(searchControl);

                // Обработчик выбора результата поиска
                searchControl.events.add('resultselect', function(e) {
                    const index = e.get('index');
                    searchControl.getResult(index).then(function(res) {
                        const address = res.properties.get('text');
                        $('#addressInput').val(address);
                        $('#mapModal').hide();
                    });
                });

                // Обработчик клика по карте
                map.events.add('click', function(e) {
                    const coords = e.get('coords');

                    // Запрашиваем адрес по координатам
                    ymaps.geocode(coords).then(function(res) {
                        if (currentInput) {
                            const firstGeoObject = res.geoObjects.get(0);
                            const address = firstGeoObject.getAddressLine();
                            currentInput.val(address);
                            $('#mapModal').hide();
                            currentInput = null;
                        }
                    });
                });
            });
        }
    }
});

// // Делегирование событий для динамически создаваемых элементов

//
// Закрытие модального окна
$('#closeMap').click(function() {
    $('#mapModal').hide();
    currentInput = null;
});

$(document).ready(function () {
    $(document).on('change', 'select[name^="quarries"][name$="[name]"]', function () {
        const $select = $(this);
        const selectedDescription = $select.find('option:selected').data('description');

        const $container = $select.closest('.material__input-block').parent(); // .m3 -> обертка двух .material__input-block
        const $descBlock = $container.next(); // .d-flex.db1
        const $baseDesc = $descBlock.find('.base-description');
        const $quarryDesc = $descBlock.find('.quarry-description');

        if (selectedDescription === 'base-description') {
            $baseDesc.show();
            $quarryDesc.hide();
        } else if (selectedDescription === 'quarry-description') {
            $baseDesc.hide();
            $quarryDesc.show();
        }
    });

    // Инициализация для уже существующих select'ов при загрузке
    $('select[name^="quarries"][name$="[name]"]').each(function () {
        $(this).trigger('click');
    });
});

$(document).ready(function () {
    $('.fio-checkbox').on('change', function () {
        const $fioInput = $('input[name="fio"]');
        const $nameInput = $('input[name="name"]');

        if ($(this).is(':checked')) {
            $fioInput.attr('required', true);
            $nameInput.removeAttr('required');
        } else {
            $fioInput.removeAttr('required');
            $nameInput.attr('required', true);
        }
    });
});
