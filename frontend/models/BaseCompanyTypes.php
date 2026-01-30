<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "company_types".
 *
 * @property int $id
 * @property string $name
 */
class BaseCompanyTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
