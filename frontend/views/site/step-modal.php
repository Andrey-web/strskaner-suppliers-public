<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use frontend\assets\StepModalAsset;
StepModalAsset::register($this);

$this->title = 'Регистрация Поставщика - выбор типа компании';
?>
<!--модальное окно-->
<div class="modal">
    <form action="">
        <span class="close">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" viewBox="0 0 23 25" fill="none">
                <path d="M1.20508 2L21.6031 23.2132" stroke="#4A90C8" stroke-width="2" stroke-linecap="round"/>
                <path d="M21.3982 2L1.00017 23.2132" stroke="#4A90C8" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <div class="modal__header">
            <p class="modal__header-32">В настоящее время доступна регистрация в категориях:
                песок, щебень, отсев, пщс</p>
            <p class="modal__header-16">Выберите пожалуйста свой статус (только один)</p>
        </div>
        <div>
            <div class="button-group">
                <input type="radio" id="option1" name="option" value="4" class="hidden-radio">
                <label for="option1" class="button">
                    <span><b>ПРОИЗВОДИТЕЛЬ</b></span>
                    <span>Карьер песчаный / щебёночный</span>
                    <span>Производит, продаёт, доставляет*</span>
                </label>

                <input type="radio" id="option2" name="option" value="1" class="hidden-radio">
                <label for="option2" class="button">
                    <span><b>ТОРГОВАЯ КОМПАНИЯ</b></span>
                    <span>Продаёт, доставляет</span>
                </label>

                <input type="radio" id="option3" name="option" value="2" class="hidden-radio">
                <label for="option3" class="button">
                    <span><b>ПЕРЕВОЗЧИК</b></span>
                    <span>Только доставляет</span>
                </label>
            </div>
        </div>
        <div class="button__save">
            <button class="button__blue">
                ПРОДОЛЖИТЬ
            </button>
        </div>
    </form>
</div>

<!--модальное окно-->
