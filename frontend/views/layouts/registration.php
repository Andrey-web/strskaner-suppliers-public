<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header>
    <nav>
        <ul class="container">
            <li>
                <a href="<?= Url::to(['/']) ?>">
                    <img src="/img/logo2.svg" width="140px" height="auto" alt="">
                </a>
            </li>
            <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23" fill="none">
                        <path d="M19.25 9.58203C19.25 16.2904 11 22.0404 11 22.0404C11 22.0404 2.75 16.2904 2.75 9.58203C2.75 7.29454 3.61919 5.10074 5.16637 3.48323C6.71354 1.86573 8.81196 0.957031 11 0.957031C13.188 0.957031 15.2865 1.86573 16.8336 3.48323C18.3808 5.10074 19.25 7.29454 19.25 9.58203Z"
                              stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 6.70703C10.2707 6.70703 9.57118 7.00993 9.05546 7.5491C8.53973 8.08827 8.25 8.81953 8.25 9.58203C8.25 10.3445 8.53973 11.0758 9.05546 11.615C9.57118 12.1541 10.2707 12.457 11 12.457C11.7293 12.457 12.4288 12.1541 12.9445 11.615C13.4603 11.0758 13.75 10.3445 13.75 9.58203C13.75 8.81953 13.4603 8.08827 12.9445 7.5491C12.4288 7.00993 11.7293 6.70703 11 6.70703Z"
                              stroke="black" stroke-width="1.24583" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Тюмень
                </a>
                <a href="tel:89698008855">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="23" viewBox="0 0 25 23" fill="none">
                        <path d="M1.00571 3.17596C1.13139 8.16249 3.31367 12.8548 7.15264 16.3858C10.9916 19.9168 16.0931 21.924 21.5145 22.0396H21.8287L23.6111 17.1057L21.1546 15.2351L19.9664 14.3313C19.9664 14.3313 19.9492 14.3208 19.9378 14.3103L19.9264 14.2998L19.8178 14.1999C19.1437 13.5799 18.0469 13.5799 17.3728 14.1999L15.5047 15.9181C15.2019 16.1966 14.7278 16.2282 14.3907 16.0075C13.1453 15.1405 11.7 13.974 10.7345 13.086C9.76909 12.1979 8.61511 10.9894 7.68964 9.88071C7.6268 9.80189 7.5811 9.7546 7.55254 9.71257C7.55254 9.71257 7.55254 9.70731 7.54682 9.70206C7.32403 9.39204 7.36402 8.96643 7.66108 8.69319L9.52915 6.97497C10.2033 6.35494 10.2033 5.34607 9.52915 4.72604L9.42061 4.62621L9.40918 4.6157C9.40918 4.6157 9.39776 4.59993 9.38633 4.58942L8.40374 3.49649L6.37 1.24756L1 2.88696V3.17596H1.00571Z"
                              stroke="#231F20" stroke-width="1.25" stroke-miterlimit="10"/>
                    </svg>
                    8 969 800 88 55
                </a>
            </li>
        </ul>
    </nav>
</header>
<main>
<?= $content ?>
</main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
