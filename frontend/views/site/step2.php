<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use frontend\assets\Step2Asset;
Step2Asset::register($this);

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
                    <a href="<?= Url::to(['/site/registration']) ?>" class="back">Назад</a>
                </div>
            </div>
            <br>
            <p>Пожалуйста вводите свои реально существующие данные, для отображения достоверной информации </p>

            <?php $form = ActiveForm::begin([
                'id' => 'reg-form',
                'options' => [
                    'data-url' => Url::toRoute('site/validate'),
                    'data-url-exist' => Url::toRoute('site/exist'),
                ],

//                'enableClientValidation' => true,
//                'enableAjaxValidation' => true,
//                'validationUrl' => Url::toRoute('user/ajaxregistration'),
            ]); ?>

            <input type="hidden" name="inn" class="inn" value="<?= $model->inn ?>">
            <input type="hidden" name="companyType" class="companyType" value="<?= $companyType ?>">

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <input type="text" class="form-control shadow-sm name" name="name" placeholder="ИНН"
                               required>
                        <small class="form-text text-muted">ИНН (Потом изменить будет нельзя)</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <input type="email" class="form-control shadow-sm email" name="companyEmail" placeholder="Email"
                               required value="<?= $model->companyEmail ?>">
                    </div>
                </div>
            </div>

            <p>Мобильный номер телефона для связи <br>
                <small>(на него будет отправлен код подтверждения) </small>
            </p>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <input id="phone" type="tel" class="form-control shadow-sm tel" name="phone" placeholder="Телефон" required value="<?= $model->phone ?>">
                        <small class="form-text text-muted">Телефон (только мобильный)</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <input id="phone_replay" type="tel" class="form-control shadow-sm tel" name="phone_replay"
                               placeholder="Телефон еще раз" required value="<?= $model->phone_replay ?>">
                        <small class="form-text text-muted">Повторите номер телефона</small>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center" style="text-align: center;">
                <div class="col-12 col-md-4">
                    <div class="margin-top-30">

                        <?= Html::submitButton('Продолжить', [
                                'class' => 'btn-block btn-go shadow',
                                //'disabled' => 'disabled',
                            ]) ?>
                    </div>
                    <div class="margin-top-30"><b>2 из 3</b></div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
</div>
<div style="display: none;" id="hidden-content">
    <h2>Ошибка</h2>
    <p>Текст ошибки</p>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">
                    <strong>
                        Запрет для Регистрации
                    </strong>
                </p>
                <p class="message-modal text-center">
                    В организации ИНН <span class="inn-modal"></span> не прописаны ОКВЭД 43.73 или 46.73.6
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100 shadow btn-modal" data-dismiss="modal">Изменить ИНН</button>
            </div>
        </div>
    </div>
</div>