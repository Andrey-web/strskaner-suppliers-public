<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\IndexAsset;
use yii\widgets\ActiveForm;

IndexAsset::register($this);

$this->title = 'Строительные материалы без посредников';
?>
<div class="container-fluid">
    <div class="row bg none-d">
        <div class="header">
            <div class="header-text">
                <a href="<?= Url::to(['/']) ?>">
                    <img class="index-logo" src="/img/logo2.svg" width="140px" height="auto" alt="">
                </a>
                <div class="text"><span>Строительные материалы</span><br> без посредников</div>
                <div class="open">
                    Открыта <br> регистрация поставщиков <br> и производителей в Тюмени
                    <hr class="border"> Запуск сервиса <br> май 2025 <br><br>
                    <img width="30px" src="/img/phone.png" alt="phone"> 8 (969) 800-88-55 <br>
                    <a href="#" class="btn btn-register btn-lg margin-top-20" data-toggle="modal" data-target="#modal-registration">
                        Зарегистрироваться<br> поставщиком
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row none-m top">
        <div class="col-6">
            <img class="logo" style="text-align: left;" src="/img/logo.svg" alt="logo">
        </div>
        <div class="col-6" style="text-align: right;">
            <img class="map" src="/img/map.svg" alt="map"> <span class="tmn">Тюмень</span>
        </div>
    </div>
    <div class="row bg none-m">
        <div class="text"><span>Строительные материалы</span><br> без посредников</div>
        <div class="header">
            <div class="header-text">
                <div class="open">
                    Открыта <br> регистрация поставщиков <br> и производителей в Тюмени
                    <hr class="border"> Запуск сервиса <b>май 2021</b> <br>
                    <a href="<?= Url::to(['/site/registration']) ?>"
                       class="btn btn-register btn-lg margin-top-20">Зарегистрироваться<br>
                        поставщиком</a><br><br>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="about">
            <div class="text">
                <div class="title">О сервисе</div><img class="logo-phone" src="/img/logo.svg" alt="logo">
                <br> Независимый онлайн-сервис поиска, выбора и заказа строительных материалов.
                <br>Напрямую от проверенных поставщиков и производителей. Без посредников.
                <br>Мы не продаем строительные материалы, мы помогаем найти лучшие варианты.
            </div>
        </div>
    </div>
    <div class="row">
        <div class="principles">
            <div class="text">
                <div class="title">Наши принципы</div><br>
                <p>
                    <strong>Честность</strong>
                    <br> Мы никогда не изменим алгоритм поиска в чью-либо пользу ни по какой причине.
                    <br> Результаты основываются на реальных ценах, ассортименте, удаленности от клиента,
                    <br> стоимости доставки и других параметров.
                </p>
                <p>
                    <strong>Конфиденциальность</strong>
                    <br>Будьте уверены, ваши данные под надежной защитой.
                    <br> Мы не передадим их третьим лицам и не
                    <br> станем использовать их в корыстных целях.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="footer">
            <div class="text">
                <div class="title">Преимущества для Поставщика</div><br>
                <ul>
                    <li>
                        Современный, дополнительный канал продаж для Вас.
                    </li>
                    <li>
                        Размещение и работа с сервисом бесплатно.
                    </li>
                    <li>
                        Справедливая выдача в поиске. Нет «проплаченых» предложений и компаний.
                    </li>
                    <li>
                        Без посредников. Все поставщики сервиса юридические или физические лица, с проверенным статусом Поставщика.
                    </li>
                    <li>
                        Явное присутствие в интернете. Нет необходимости иметь свой сайт.
                    </li>
                    <li>
                        Реклама и продвижение за наш счет.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="footer-2">
            <div class="text">
                <img width="50px" src="/img/phone.svg" alt="phone"> <a class="tel" href="tel:+79698008855">8(969)
                    800-88-55</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="footer-3">
            <div class="text">
                <a href="#" class="btn btn-register btn-lg margin-top-20" data-toggle="modal" data-target="#modal-registration">
                    Зарегистрироваться<br> поставщиком
                </a>
            </div>
        </div>
    </div>
</div>

<div id="modal-registration" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin([
                    'action' => Url::current(),
                    'method' => 'get',
                ]);
                ?>
                <div class="modal__header">
                    <p class="modal__header-32">В настоящее время доступна регистрация в категориях:
                        песок, щебень, отсев, пщс</p>
                    <p class="modal__header-16">Выберите пожалуйста свой статус (только один)</p>
                </div>
                <div>
                    <div class="button-group">
                        <?= Html::radio('companyType', true, ['id' => 'option1', 'value' => '4', 'class' => 'hidden-radio']) ?>
                        <?= Html::label('<span><b>ПРОИЗВОДИТЕЛЬ</b></span><span>Карьер песчаный / щебёночный</span><span>Производит, продаёт, доставляет*</span>', 'option1', ['class' => 'button']) ?>

                        <?= Html::radio('companyType', false, ['id' => 'option2', 'value' => '1', 'class' => 'hidden-radio']) ?>
                        <?= Html::label('<span><b>ТОРГОВАЯ КОМПАНИЯ</b></span><span>Продаёт, доставляет</span>', 'option2', ['class' => 'button']) ?>

                        <?= Html::radio('companyType', false, ['id' => 'option3', 'value' => '2', 'class' => 'hidden-radio']) ?>
                        <?= Html::label('<span><b>ПЕРЕВОЗЧИК</b></span><span>Только доставляет</span>', 'option3', ['class' => 'button']) ?>
                    </div>
                </div>
                <div class="button__save">
                    <?= Html::submitButton('ПРОДОЛЖИТЬ', ['class' => 'button__blue']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
