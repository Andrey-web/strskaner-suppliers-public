<?php

namespace frontend\models;

class CompanyTypes extends BaseCompanyTypes
{
    public static function getCompanyTypesById($id): ?string
    {
        $companyType = self::findOne($id);
        return $companyType ? $companyType->name : null;
    }
}