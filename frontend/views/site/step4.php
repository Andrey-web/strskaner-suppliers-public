<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use frontend\assets\Step4Asset;
Step4Asset::register($this);

$this->title = 'Регистрация Поставщика';
?>
<div class="row">
    <div class="container">
        <div class="registration">
            <div class="row">
                <div class="col-6 title">
                    <b>Регистрация Поставщика</b>
                </div>
                <div class="col-6" style="text-align: right;">
                    <a href="<?= Url::to(['/']) ?>" class="back">Назад</a>
                </div>
            </div>
            <br>

            <p><b>Отлично!</b></p>
            <p><b>Регистрация прошла успешно.</b></p>
            <p>В ближайшее время, мы свяжемся с Вами и обсудим время для встречи, чтобы произвести подключение к
                сервису. Спасибо!</p>
            <p>Наш телефон для связи <b><br><a class="tel" href="tel:+79698008855">8(969)
                        800-88-55</a></b></p>
            <div class="row d-flex justify-content-center" style="text-align: center;">
                <div class="col-12 col-md-4">
                    <div class="margin-top-30">
                        <a href="<?= Url::to(['/']) ?>" class="btn-block btn-go shadow">Готово</a><br><br>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
