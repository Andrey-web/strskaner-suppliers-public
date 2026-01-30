<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "confirm_manufacturer".
 *
 * @property int $id
 * @property int $manufacturer_id Поставщик
 * @property int $code Код подтверждения
 * @property string $created_at Время создания
 *
 * @property RcManufacturer $manufacturer
 */
class ConfirmManufacturer extends \yii\db\ActiveRecord
{
    public $codeCheck; //Код для проверки


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confirm_manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer_id', 'code'], 'required'],
            [['id', 'manufacturer_id', 'code'], 'integer'],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => RpManufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],

            [['codeCheck'], 'integer'],

            ['code', 'compare', 'compareAttribute' => 'codeCheck', 'message' => '{attribute} неверный', 'when' => function ($model) {
                return !$model->isNewRecord;
            }, 'enableClientValidation' => false],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manufacturer_id' => 'Manufacturer ID',
            'code' => 'Проверочный код',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            //Время изменения/создания
            [
                'class' => TimestampBehavior::className(),
//                'createdAtAttribute' => 'created_at',
//                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Gets query for [[Manufacturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(RcManufacturer::className(), ['id' => 'manufacturer_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (!$insert) {
            $modelRpManufacturer = RpManufacturer::find()
                ->andWhere([
                    'id' => $this->manufacturer_id,
                    'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED
                ])
                ->one();
            if ($modelRpManufacturer) {
                $modelRpManufacturer->status = RpManufacturer::STATUS_LANDING;
                if($modelRpManufacturer->save()){
                    return true;
                }
                else{
                    print_r($modelRpManufacturer->getErrors());
                    exit;
                }
            }
        }
        //Отправка СМС при создании
        else{
            $this->sendSMS1();
        }
    }

    /**
     * Отправка СМС
     */
    public function sendSMS()
    {
        //Массив для prontoSMS
        $arrMessage = [];
        $message = 'Код подтверждения для регистрации на сайте stroyru.ru: ' . $this->code;
        $phone = $this->phone;

        $arrMessage[] = [
            'type' => 'sms',
            'sender' => 'Servise',
            'text' => $message,
            'name_delivery' => 'Рассылка',
            'abonent' => array(
                //array('phone' => '79033256699', 'number_sms' => '1', 'client_id_sms' => '100', 'time_send' => '2016-11-09 12:40', 'validity_period' => '2016-11-09 13:30'),
                array(
                    'phone' => $phone,
                    'number_sms' => 1,
                    //'client_id_sms' => ('tid' . $value['idTraining'] . 'cid' . $value['customer_id']),
                    'validity_period' => (new \DateTime())->format('Y-m-d') . ' 23:59'
                )
            )
        ];

        $param = array(
            'security' => array('login' => ArrayHelper::getValue(Yii::$app->params, 'notification.prontoSMS.login'), 'password' => ArrayHelper::getValue(Yii::$app->params, 'notification.prontoSMS.password')),
            'type' => 'sms',
            'message' => $arrMessage,
        );
        $param_json = json_encode($param, true);
        // JSON-документ
        $href = 'https://clk.prontosms.ru/sendsmsjson.php'; // адрес сервера
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'charset=utf-8', 'Expect:'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_json);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_URL, $href);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $res = curl_exec($ch);
        $result = json_decode($res, true);
        curl_close($ch);
    }


    /**
     * Отправка СМС
     */
    public function sendSMS1()
    {
        //direct.i-dgtl.ru
        $message = 'Код подтверждения для регистрации на сайте stroyru.ru: ' . $this->code;
        $phone = $this->phone;

        $param = [
            'channelType' => "SMS",
            "senderName" => "StroyRu",
            "destination" => $phone,
            "content" => $message,
            "ttl" => 43200,
            "useLocalTime" => true,
            "tags" => ["tag1","tag2"]
        ];


//        `curl --location --request POST 'https://direct.i-dgtl.ru/api/v1/message/' \
//        --header 'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqdm1fYmFja2VuZCIsInN1YiI6IjM0NiIsImNsaWVudF9pZCI6MzA1ODQsInR5cGUiOiJhY2Nlc3MiLCJnZW4iOjEsImdlbmVyYXRlZF9ieSI6MzIxLCJuYW1lIjoi0JjQvdCz0LAg0JPRgNGD0L_QvyIsImlhdCI6MTYyMDEzODcyOSwiZXhwIjo5MjIzMzcyMDM2ODU0Nzc1fQ.fxYciRgTy6SoWOVA6MeDctugA6OA58uQFyk5WKdgiaA' \
//        --header 'Content-Type: application/json' \
//        --data-raw '[{
//        "channelType":"SMS",
//        "senderName":"StroyRu",
//        "destination":"$this->phone",
//        "content":"$message",
//        "useLocalTime":true,"ttl":43200,
//        "tags":["tag1","tag2"]}]'`;



        $param_json = json_encode([$param], true);
        $href = 'https://direct.i-dgtl.ru/api/v1/message';
        $ch = curl_init();
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqdm1fYmFja2VuZCIsInN1YiI6IjM0NiIsImNsaWVudF9pZCI6MzA1ODQsInR5cGUiOiJhY2Nlc3MiLCJnZW4iOjEsImdlbmVyYXRlZF9ieSI6MzIxLCJuYW1lIjoi0JjQvdCz0LAg0JPRgNGD0L_QvyIsImlhdCI6MTYyMDEzODcyOSwiZXhwIjo5MjIzMzcyMDM2ODU0Nzc1fQ.fxYciRgTy6SoWOVA6MeDctugA6OA58uQFyk5WKdgiaA',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_json);
        curl_setopt($ch, CURLOPT_TIMEOUT, 600);
        curl_setopt($ch, CURLOPT_URL, $href);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $res = curl_exec($ch);
        $result = json_decode($res, true);
        curl_close($ch);

        //var_dump($result); exit;

    }

    public function getPhone()
    {
        return RpManufacturer::find()
            ->select([
                'phone'
            ])
            ->andWhere([
                'id' => $this->manufacturer_id,
                'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED,
            ])
            ->scalar();
    }

/*    public function setStatus()
    {
        if ($this->codeCheck == $this->code) {
            if (!$this->status) {
                $this->status = 1;
                if ($this->save()) {
                    $modelRpManufacturer = RpManufacturer::find()
                        ->andWhere([
                            'id' => $this->manufacturer_id,
                            'status' => RpManufacturer::STATUS_LANDING_NOT_CONFIRMED
                        ])
                        ->one();
                    if ($modelRpManufacturer) {
                        $modelRpManufacturer->status = RpManufacturer::STATUS_LANDING;
                        if($modelRpManufacturer->save()){
                            return true;
                        }
                        else{
                            print_r($modelRpManufacturer->getErrors());
                            exit;
                        }
                    }
                }
                else{
                    print_r($this->getErrors());
                    exit;
                }
            }
        }
        return false;
    }*/


}
