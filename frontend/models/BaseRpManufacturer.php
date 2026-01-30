<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rp_manufacturer".
 *
 * @property int $id
 * @property int $companyType
 * @property string|null $ownership
 * @property string|null $founders
 * @property string|null $yearOfRegistration
 * @property string|null $companyName
 * @property string|null $companyShortName
 * @property string $inn
 * @property string|null $ogrn
 * @property string|null $kpp
 * @property string|null $enterpriseCard
 * @property string|null $statutoryDocuments
 * @property string|null $bankDetails
 * @property string|null $photoFiles
 * @property string|null $date
 * @property string|null $manufacturerAddressUr
 * @property string|null $manufacturerAdressFact
 * @property string|null $companySite
 * @property string|null $companyEmail
 * @property int|null $status
 * @property string|null $tax
 * @property string|null $okved
 * @property string|null $actual
 * @property string|null $phone Телефон
 *
 * @property ConfirmManufacturer[] $confirmManufacturers
 * @property BaseSchedule[] $schedules
 */
class BaseRpManufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rp_manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companyType'], 'required'],
            [['companyType', 'status'], 'integer'],
            [['founders', 'manufacturerAddressUr', 'manufacturerAdressFact'], 'string'],
            [['date'], 'safe'],
            [['ownership', 'tax', 'okved'], 'string', 'max' => 255],
            [['yearOfRegistration'], 'string', 'max' => 10],
            [['companyName', 'photoFiles'], 'string', 'max' => 2000],
            [['companyShortName', 'enterpriseCard', 'statutoryDocuments', 'bankDetails'], 'string', 'max' => 1000],
            [['inn', 'kpp', 'companySite', 'companyEmail'], 'string', 'max' => 500],
            [['ogrn'], 'string', 'max' => 512],
            [['actual', 'phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companyType' => 'Company Type',
            'ownership' => 'Ownership',
            'founders' => 'Founders',
            'yearOfRegistration' => 'Year Of Registration',
            'companyName' => 'Company Name',
            'companyShortName' => 'Company Short Name',
            'inn' => 'Inn',
            'ogrn' => 'Ogrn',
            'kpp' => 'Kpp',
            'enterpriseCard' => 'Enterprise Card',
            'statutoryDocuments' => 'Statutory Documents',
            'bankDetails' => 'Bank Details',
            'photoFiles' => 'Photo Files',
            'date' => 'Date',
            'manufacturerAddressUr' => 'Manufacturer Address Ur',
            'manufacturerAdressFact' => 'Manufacturer Adress Fact',
            'companySite' => 'Company Site',
            'companyEmail' => 'Company Email',
            'status' => 'Status',
            'tax' => 'Tax',
            'okved' => 'Okved',
            'actual' => 'Actual',
            'phone' => 'Телефон',
        ];
    }

    /**
     * Gets query for [[ConfirmManufacturers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmManufacturers()
    {
        return $this->hasMany(ConfirmManufacturer::class, ['manufacturer_id' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(BaseSchedule::class, ['company_id' => 'id']);
    }
}
