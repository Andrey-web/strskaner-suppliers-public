<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rp_payment".
 *
 * @property int $id
 * @property int $companyId
 * @property int|null $cash
 * @property int|null $cashless
 * @property int|null $nds
 * @property int|null $online
 * @property int|null $creditCard
 * @property int|null $receipt
 */
class RpPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rp_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companyId'], 'required'],
            [['companyId', 'cash', 'cashless', 'nds', 'online', 'creditCard', 'receipt'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyId' => 'Company ID',
            'cash' => 'Cash',
            'cashless' => 'Cashless',
            'nds' => 'Nds',
            'online' => 'Online',
            'creditCard' => 'Credit Card',
            'receipt' => 'Receipt',
        ];
    }
}
