<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
use backend\modules\transport\models\Places;
use backend\modules\transport\models\Streets;
use backend\modules\contractors\models\OpfList;

class Dadata
{
    public static function suggest($type, $fields)
    {
        $result = false;
        if ($ch = curl_init("http://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/$type")) {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token YOUR_DADATA_API_TOKEN_HERE'
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            // json_encode
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);
        }
        return $result;
    }

    public static function findById($fields)
    {
        $result = false;
        if ($ch = curl_init("https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party")) {
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Token YOUR_DADATA_API_TOKEN_HERE'
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            // json_encode
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            curl_close($ch);
        }
        return $result;
    }

    /**
     * Достает нужные нам данные для создания контрагента
     */
    public static function getObject($q)
    {
        //$result = Self::suggest("party", array("query" => $q, "count" => 2));

        $result = Self::findById(["query" => $q]);

        //print_r(($result)); exit;

        if ($result && $result['suggestions'] && count($result['suggestions'])) {



            $okved = ArrayHelper::getValue($result, 'suggestions.0.data.okved');

            $okveds = ArrayHelper::getValue($result, 'suggestions.0.data.okveds');

            if($okveds && is_array($okveds)){
                $okved = [];
                foreach ($okveds as $value){
                    $okved[] =  ArrayHelper::getValue($value, 'code');
                }
                $okved = implode(' ,', $okved);
            }

            $ogrn = ArrayHelper::getValue($result, 'suggestions.0.data.ogrn');

            $cityCode = null;
            $cityId = null;
            $cityName = '';
            $streetCode = null;
            $streetName = '';
            $house = '';
            $opfUID = null;
            $opfName = '';
            $name = ArrayHelper::getValue($result, 'suggestions.0.data.name.full');
            $nameShort = ArrayHelper::getValue($result, 'suggestions.0.data.name.short');
            $juridical = ArrayHelper::getValue($result, 'suggestions.0.data.type') == 'LEGAL' ? 1 : 0;
            $opfName = ArrayHelper::getValue($result, 'suggestions.0.data.opf.full');
            $kpp = ArrayHelper::getValue($result, 'suggestions.0.data.kpp');

            //Название с ОПФ. Нужно потому что отдельная ОПФ из Dadata бывает неверной
            $nameFullWithOpf = ArrayHelper::getValue($result, 'suggestions.0.data.name.full_with_opf');
            $nameShotWithOpf = ArrayHelper::getValue($result, 'suggestions.0.data.name.short_with_opf');

            //Раздел с адресом. Этого раздела может не быть, тогда придется вытаскивать все из строки
            $addressData = ArrayHelper::getValue($result, 'suggestions.0.data.address.data');
            if ($addressData) {

                $cityStr = ArrayHelper::getValue($addressData, 'settlement');
                //По каким-то странным причинам, город может под другим индексом находиться
                if (!$cityStr) {
                    $cityStr = ArrayHelper::getValue($addressData, 'city');
                }

                //КЛАДР населенного пункта
                $cityCode = ltrim(ArrayHelper::getValue($addressData, 'city_kladr_id'), '0');


                $house = ArrayHelper::getValue($addressData, 'house');
            } //Если нет раздела с адресом в виде объекта, то придется выдергивать адрес из строки
            else {
                $addressArr = explode(',', ArrayHelper::getValue($result, 'suggestions.0.data.address.value'));
                $cityStr = ArrayHelper::getValue($addressArr, '1');
                $cityStr = trim(preg_replace('/(ГОРОД)/i', '', $cityStr));

            }



            return [

                'okved' => $okved,
                'ogrn' => $ogrn,

                'nameFullWithOpf' => $nameFullWithOpf,
                'nameShotWithOpf' => $nameShotWithOpf,

                'name' => $name,
                'nameShort' => $nameShort,
                'juridical' => $juridical,
                'opf' => [
                    'name' => $opfName,
                    'uid' => $opfUID,
                ],
                'address' => [
                    'cityCode' => $cityCode,
                    'cityName' => $cityName,
                    'streetCode' => $streetCode,
                    'streetName' => $streetName,
                    'house' => $house,
                ],
                'kpp' => $kpp,
            ];
        }
    }

}