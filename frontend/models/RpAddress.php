<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rp_address".
 *
 * @property int $id
 * @property int $companyId
 * @property string $name
 * @property string $address
 * @property int $index
 */
class RpAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rp_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companyId', 'name', 'address', 'index'], 'required'],
            [['companyId', 'index'], 'integer'],
            [['name', 'address'], 'string', 'max' => 2000],
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
            'name' => 'Name',
            'address' => 'Address',
            'index' => 'Index',
        ];
    }
}
