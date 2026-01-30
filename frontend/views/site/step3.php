<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use frontend\assets\Step3Asset;
Step3Asset::register($this);

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
                    <a href="<?= Url::to(['/site/step2']) ?>" class="back">Назад</a>
                </div>
            </div>
            <br>

            <?php $form = ActiveForm::begin(); ?>

            <input id="confirm-id" type="hidden" name="id" value="<?= $model->id ?>">

            <p><b>Добро пожаловать!</b></p>

            <?php if ($name): ?>
                <p>Поставщик <?= $name ?></p>
            <?php endif; ?>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <p><b>На Ваш номер отправлен код, введите его чтобы продолжить</b></p>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <input type="text" class="form-control shadow-sm codeCheck" name="codeCheck"
                               placeholder="Код из СМС"
                               required>
                    </div>
                </div>
            </div>
            <div class="b-sms">
                <a href="<?= Url::to(['/site/send-code-ajax']) ?>" class="sms" style="display: none;">Отправить код еще раз</a>
            </div>

            <div class="row d-flex justify-content-center" style="text-align: center;">
                <div class="col-12 col-md-4">
                    <div class="margin-top-30">

                        <?= Html::a('Продолжить', Url::to(['/site/step4']), [
                            'class' => 'btn-block btn-confirm-code btn-go shadow',
                            'data-url' => Url::to(['/site/check', 'id' => $model->id,
                            ]),
                            'data-click' => '1',
                        ]) ?>

                    </div>
                    <div class="margin-top-30"><b>3 из 3</b></div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
</div>
<?php if ($model->getErrors()): ?>
    <div id="hidden-content">
        <h2>Ошибка</h2>
        <?php foreach ($model->getErrors() as $fieldErrors): ?>
            <?php foreach ($fieldErrors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


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

                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100 shadow" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-new-code" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <p class="text-center">
                    <strong>
                        Новый код отправлен
                    </strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100 shadow" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

