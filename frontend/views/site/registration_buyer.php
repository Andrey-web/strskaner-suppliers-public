<?php
use yii\helpers\Url;
use frontend\assets\RegistrationAsset;
RegistrationAsset::register($this);

$this->title = 'Регистрация торговой компании | Стройсканер';

?>
<script src="https://api-maps.yandex.ru/2.1/?apikey=<?=Yii::$app->params['yandexMapApiKey']?>&lang=ru_RU" type="text/javascript"></script>
<div class="header__head border__top">
    <div class="container">
        <p>Регистрация торговой компании</p>
    </div>
</div>
<section class="border__top">
    <div class="container">
        <div class="account">
            <div class="account__content">
                <div class="account__content-top">
                    <div>
                        <p style="text-transform: uppercase">РЕГИСТРАЦИЯ торговой компании</p>
                        <p>В настоящее время доступна регистрация в категориях:
                            песок, щебень, отсев, ПЩС
                            что бы стать поставщиком сервиса вы должны иметь</p>
                        <ol>
                            <li>Действующее Юридическое лицо и ИП</li>
                            <li>ОКВЭД 46.73 или 46.73.6 основным или дополнительным (обязательно)</li>
                        </ol>
                    </div>
                    <div>
                        <a href="/" class="button__save file__download-false">
                            <button class="button__download">
                                Назад
                            </button>
                        </a>
                    </div>
                </div>
                <form method="post" id="registration">
                    <input type="hidden" name="companyType" value="<?= $companyType ?>">
                    <div class="material__editing-block">
                        <div class="material__editing-block-header">
                            <p>Торговая компания</p>
                        </div>
                        <div class="material__input material__input-50">

                            <div>
                                <div class="mm1 material__input-block">

                                    <label>
                                        <input name="name" class="w-100 name" type="text" placeholder="ИНН, название компании или ИП" required>
                                    </label>
                                    <input type="hidden" name="inn" class="inn" value="">
                                    <input type="hidden" name="full-name" class="full-name" value="">
                                </div>
                            </div>
                            <div>
                                <div class="m1  material__input-block">
                                    <label>
                                        <input class="w-100 legal-address addressInput" name="legal-address" type="text" placeholder="Адрес юридический" required disabled>
                                    </label>
                                </div>
                            </div>

                            <div>
                                <div class="mm2 material__input-block">
                                    <label>
                                        <input class="w-100" type="email" pattern=".+@.+\..+" name="email" placeholder="Email" required>
                                    </label>
                                    <label>
                                        <input class="w-100" type="text" name="site" placeholder="Сайт (если есть)">
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="m2  material__input-block">
                                    <div class="button__check">
                                        <label>
                                            <input type="checkbox" class="checkbox__1-block address-copy">
                                            <span class="checkbox__1">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                    <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="button__check openMap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
                                            <path d="M19.25 9.58203C19.25 16.2904 11 22.0404 11 22.0404C11 22.0404 2.75 16.2904 2.75 9.58203C2.75 7.29454 3.61919 5.10074 5.16637 3.48323C6.71354 1.86573 8.81196 0.957031 11 0.957031C13.188 0.957031 15.2865 1.86573 16.8336 3.48323C18.3808 5.10074 19.25 7.29454 19.25 9.58203Z" stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11 6.70703C10.2707 6.70703 9.57118 7.00993 9.05546 7.5491C8.53973 8.08827 8.25 8.81953 8.25 9.58203C8.25 10.3445 8.53973 11.0758 9.05546 11.615C9.57118 12.1541 10.2707 12.457 11 12.457C11.7293 12.457 12.4288 12.1541 12.9445 11.615C13.4603 11.0758 13.75 10.3445 13.75 9.58203C13.75 8.81953 13.4603 8.08827 12.9445 7.5491C12.4288 7.00993 11.7293 6.70703 11 6.70703Z" stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <label>
                                        <input id="addressInput" class="w-100 o1 address addressInput" type="text" name="address" placeholder="Адрес офиса фактический (если совпадает поставьте галочку)" required>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="material__editing-block material__editing-block-delivery">
                        <div class="material__editing-block-header">
                            <p>Вариант поставки (можно выбрать несколько вариантов)</p>
                        </div>
                        <div class="material__input material__input-50 delivery-option">
                            <div>
                                <div class="m3  material__input-block">
                                    <div class="button__check">
                                        <label>
                                            <input type="checkbox" checked name="checkbox__1" class="checkbox__1-block">
                                            <span class="checkbox__1">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                    <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </label>
                                    </div>
                                    <select name="quarries[0][name]">
                                        <option data-description="base-description" value="База">База</option>
                                        <option data-description="quarry-description" value="Напрямую с карьера">Напрямую с карьера</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="m4 material__input-block quarry-address-wrapper">
                                    <div class="button__check openMap">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
                                            <path d="M19.25 9.58203C19.25 16.2904 11 22.0404 11 22.0404C11 22.0404 2.75 16.2904 2.75 9.58203C2.75 7.29454 3.61919 5.10074 5.16637 3.48323C6.71354 1.86573 8.81196 0.957031 11 0.957031C13.188 0.957031 15.2865 1.86573 16.8336 3.48323C18.3808 5.10074 19.25 7.29454 19.25 9.58203Z" stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M11 6.70703C10.2707 6.70703 9.57118 7.00993 9.05546 7.5491C8.53973 8.08827 8.25 8.81953 8.25 9.58203C8.25 10.3445 8.53973 11.0758 9.05546 11.615C9.57118 12.1541 10.2707 12.457 11 12.457C11.7293 12.457 12.4288 12.1541 12.9445 11.615C13.4603 11.0758 13.75 10.3445 13.75 9.58203C13.75 8.81953 13.4603 8.08827 12.9445 7.5491C12.4288 7.00993 11.7293 6.70703 11 6.70703Z" stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <label>
                                        <input id="addressInput1" class="w-100 quarry-address addressInput" name="quarries[0][address]" type="text" placeholder="Адрес" required>
                                    </label>
                                </div>
                                <div class="d-flex db1">
                                    <div class="w-50 d1">
                                        <span class="base-description">Действующая база, на правах собственности или аренды, с которой вы отгружаете продукцию самовывозом или с доставкой. Доставка только своим транспортом в собственности или аренде)</span>
                                        <span class="quarry-description">Поставка продукции напрямую с карьера только с доставкой и только вашим транспортом, на правах собственности или аренды</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="add__item add-quarry">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                                <rect width="13" height="13" fill="#4A90C8"></rect>
                                <path d="M6.55251 3L6.51751 10" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path d="M10 6.44751L3 6.48251" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                            Добавить
                        </button>
                    </div>
                    <div class="material__editing-block payment-block-wrapper">
                        <div class="material__editing-block-header">
                            <p>Оплата (можно выбрать несколько вариантов)</p>
                        </div>
                        <div class="material__input material__input-25">
                            <div class="">
                                <div class="m7  material__input-block">
                                    <div class="button__check">
                                        <input id="payment-nds" type="checkbox" checked name="payment-nds" class="checkbox__1-block checkbox__1-block-p">
                                        <span class="checkbox__1">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <label class="w-100" for="payment-nds">
                                        Безнал с НДС
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div class="m8  material__input-block">
                                    <div class="button__check">
                                        <input id="payment-without-nds" type="checkbox"  name="payment-without-nds" class="checkbox__1-block checkbox__1-block-p">
                                        <span class="checkbox__1">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <label class="w-100" for="payment-without-nds">
                                        Безнал без НДС
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div class="m9 material__input-block">
                                    <div class="button__check">
                                        <input id="payment-card" type="checkbox" checked name="payment-card" class="checkbox__1-block">
                                        <span class="checkbox__1">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <label class="w-100" for="payment-card">
                                        Наличные / Карта
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div class="m10 material__input-block">
                                    <div class="button__check">
                                        <input id="payment-receipt" type="checkbox" checked name="payment-receipt" class="checkbox__1-block">
                                        <span class="checkbox__1">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                                <path d="M1 5.5L4.33333 10L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                    <label class="w-100" for="payment-receipt">
                                        Предоставляем кассовый чек
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="material__editing-block">
                        <div class="material__editing-block-header">
                            <p>Телефон</p>
                        </div>
                        <div class="material__input material__input-50">
                            <div class="">
                                <div class="m11  material__input-block">
                                    <label class="w-100">
                                        <input name="phone" class="w-100 tel" type="tel" placeholder="Мобильный телефон (на него будет отправлен код)" required>
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div class="m12  material__input-block">
                                    <div class=" button__code">
                                        <button class="button__download">
                                            ВЫСЛАТЬ&nbsp;КОД
                                        </button>
                                    </div>
                                    <label class="w-50">
                                        <input class="w-50" type="text" placeholder="код из СМС">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button__save">
                        <button class="button__blue">
                            Зарегистрироваться
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    #mapModal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    #mapContainer {
        width: 80%;
        height: 80%;
        background-color: white;
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>
<div id="mapModal">
    <button class="close-btn" id="closeMap">×</button>
    <div id="mapContainer"></div>
</div>
<div id="modal-registration" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p style="text-align:center;"><strong>Спасибо за регистрацию на платформе «СтройСканер»!</strong></p>
                <p>Мы рады, что вы присоединились к числу поставщиков, которые выбирают прямую, прозрачную и честную работу.</p>
                <p>Мы проверим вашу анкету и свяжемся с вами в течение одного рабочего дня. После активации вы сможете публиковать товары, получать заявки от клиентов и работать напрямую — без посредников и лишних рисков.</p>
                <p>Если у вас возникнут вопросы, мы всегда на связи с 8–17 в рабочие дни<br>
                    Почта: <a href="mailto:support@stroyskaner.com">support@stroyskaner.com</a> или телефон <a href="tel:89698008855">8 969 800 88 55</a></p>
                <p style="text-align: right;">Благодарим за доверие к нашей платформе<br>С уважением, команда «СтройСканер»</p>
                <a href="/" class="button__accept">
                    Хорошо, спасибо
                </a>
            </div>
        </div>
    </div>
</div>