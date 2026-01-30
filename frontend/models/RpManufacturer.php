<?php

namespace frontend\models;

class RpManufacturer extends \yii\db\ActiveRecord
{
    public $phone_replay;

    const STATUS_ACTIVE = 0;                 // Действующие
    const STATUS_PROCESS_LIQUIDATION = 1;    // В стадии ликвидации
    const STATUS_LIQUADATED = 2;             // Ликвидированы
    const STATUS_BLOCK = 3;                  // Заблокированы
    const STATUS_BLACKLIST = 4;              // Черный список
    const STATUS_LANDING = 5;                // Лендинг
    const STATUS_LANDING_NOT_CONFIRMED = 6;  // Лендинг не подтвержденная через СМС
}
