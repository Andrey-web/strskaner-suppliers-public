<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $company_id Организация
 * @property string|null $monday_start
 * @property string|null $monday_end
 * @property string|null $tuesday_start
 * @property string|null $tuesday_end
 * @property string|null $wednesday_start
 * @property string|null $wednesday_end
 * @property string|null $thursday_start
 * @property string|null $thursday_end
 * @property string|null $friday_start
 * @property string|null $friday_end
 * @property string|null $saturday_start
 * @property string|null $saturday_end
 * @property string|null $sunday_start
 * @property string|null $sunday_end
 * @property string|null $break_monday_start Начало перерыва в понедельник
 * @property string|null $break_monday_end Конец перерыва в понедельник
 * @property string|null $break_tuesday_start Начало перерыва во вторник
 * @property string|null $break_tuesday_end Конец перерыва во вторник
 * @property string|null $break_wednesday_start Начало перерыва в среду
 * @property string|null $break_wednesday_end Конец перерыва в среду
 * @property string|null $break_thursday_start Начало перерыва в четверг
 * @property string|null $break_thursday_end Конец перерыва в четверг
 * @property string|null $break_friday_start Начало перерыва в пятницу
 * @property string|null $break_friday_end Конец перерыва в пятницу
 * @property string|null $break_saturday_start Начало перерыва в субботу
 * @property string|null $break_saturday_end Конец перерыва в субботу
 * @property string|null $break_sunday_start Начало перерыва в воскресенье
 * @property string|null $break_sunday_end Конец перерыва в воскресенье
 * @property int|null $non_working_monday Нерабочий день. Понедельник.
 * @property int|null $non_working_tuesday Нерабочий день. Вторник.
 * @property int|null $non_working_wednesday Нерабочий день. Среда.
 * @property int|null $non_working_thursday Нерабочий день. Четверг.
 * @property int|null $non_working_friday Нерабочий день. Пятница.
 * @property int|null $non_working_saturday Нерабочий день. Суббота.
 * @property int|null $non_working_sunday Нерабочий день. Воскресенье.
 * @property string|null $holidays_time_start Начало работы в нерабочий день
 * @property string|null $holidays_time_end Конец работы в нерабочий день
 * @property string|null $holidays_break_time_start Начало перерыва в нерабочий день
 * @property string|null $holidays_break_time_end Начало перерыва в нерабочий день
 * @property int|null $work_holidays Работаем в праздничные дни
 * @property string|null $lp_monday_start
 * @property string|null $lp_monday_end
 * @property string|null $lp_tuesday_start
 * @property string|null $lp_tuesday_end
 * @property string|null $lp_wednesday_start
 * @property string|null $lp_wednesday_end
 * @property string|null $lp_thursday_start
 * @property string|null $lp_thursday_end
 * @property string|null $lp_friday_start
 * @property string|null $lp_friday_end
 * @property string|null $lp_saturday_start
 * @property string|null $lp_saturday_end
 * @property string|null $lp_sunday_start
 * @property string|null $lp_sunday_end
 * @property string|null $lp_break_monday_start Начало перерыва в понедельник	
 * @property string|null $lp_break_monday_end Конец перерыва в понедельник	
 * @property string|null $lp_break_tuesday_start 	Начало перерыва во вторник
 * @property string|null $lp_break_tuesday_end Конец перерыва во вторник	
 * @property string|null $lp_break_wednesday_start Начало перерыва в среду	
 * @property string|null $lp_break_wednesday_end Конец перерыва в среду
 * @property string|null $lp_break_thursday_start Начало перерыва в четверг	
 * @property string|null $lp_break_thursday_end Конец перерыва в четверг	
 * @property string|null $lp_break_friday_start Начало перерыва в пятницу	
 * @property string|null $lp_break_friday_end Конец перерыва в пятницу	
 * @property string|null $lp_break_saturday_start Начало перерыва в субботу	
 * @property string|null $lp_break_saturday_end Конец перерыва в субботу	
 * @property string|null $lp_break_sunday_start Начало перерыва в воскресенье	
 * @property string|null $lp_break_sunday_end Конец перерыва в воскресенье	
 * @property int|null $lp_non_working_monday Склад. Нерабочий день. Понедельник.
 * @property int|null $lp_non_working_tuesday Склад. Нерабочий день. Вторник.
 * @property int|null $lp_non_working_wednesday Склад. Нерабочий день. Среда.
 * @property int|null $lp_non_working_thursday Склад. Нерабочий день. Четверг.
 * @property int|null $lp_non_working_friday Склад. Нерабочий день. Пятница.
 * @property int|null $lp_non_working_saturday Склад. Нерабочий день. Суббота.
 * @property int|null $lp_non_working_sunday Склад. Нерабочий день. Воскресенье.
 * @property string|null $lp_holidays_time_start Склад. Начало работы в нерабочий день
 * @property string|null $lp_holidays_time_end Склад. Конец работы в нерабочий день
 * @property string|null $lp_holidays_break_time_start Склад. Начало перерыва в нерабочий день
 * @property string|null $lp_holidays_break_time_end Склад. Начало перерыва в нерабочий день
 * @property int|null $lp_work_holidays Склад. Работаем в праздничные дни
 * @property int|null $created_by Кто создал
 * @property int|null $updated_by Кто изменил
 * @property string|null $created_at Время создания
 * @property string|null $updated_at Время изменения
 * @property int|null $isDeleted Удалена
 *
 * @property RpManufacturer $company
 */
class BaseSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id', 'non_working_monday', 'non_working_tuesday', 'non_working_wednesday', 'non_working_thursday', 'non_working_friday', 'non_working_saturday', 'non_working_sunday', 'work_holidays', 'lp_non_working_monday', 'lp_non_working_tuesday', 'lp_non_working_wednesday', 'lp_non_working_thursday', 'lp_non_working_friday', 'lp_non_working_saturday', 'lp_non_working_sunday', 'lp_work_holidays', 'created_by', 'updated_by', 'isDeleted'], 'integer'],
            [['monday_start', 'monday_end', 'tuesday_start', 'tuesday_end', 'wednesday_start', 'wednesday_end', 'thursday_start', 'thursday_end', 'friday_start', 'friday_end', 'saturday_start', 'saturday_end', 'sunday_start', 'sunday_end', 'break_monday_start', 'break_monday_end', 'break_tuesday_start', 'break_tuesday_end', 'break_wednesday_start', 'break_wednesday_end', 'break_thursday_start', 'break_thursday_end', 'break_friday_start', 'break_friday_end', 'break_saturday_start', 'break_saturday_end', 'break_sunday_start', 'break_sunday_end', 'holidays_time_start', 'holidays_time_end', 'holidays_break_time_start', 'holidays_break_time_end', 'lp_monday_start', 'lp_monday_end', 'lp_tuesday_start', 'lp_tuesday_end', 'lp_wednesday_start', 'lp_wednesday_end', 'lp_thursday_start', 'lp_thursday_end', 'lp_friday_start', 'lp_friday_end', 'lp_saturday_start', 'lp_saturday_end', 'lp_sunday_start', 'lp_sunday_end', 'lp_break_monday_start', 'lp_break_monday_end', 'lp_break_tuesday_start', 'lp_break_tuesday_end', 'lp_break_wednesday_start', 'lp_break_wednesday_end', 'lp_break_thursday_start', 'lp_break_thursday_end', 'lp_break_friday_start', 'lp_break_friday_end', 'lp_break_saturday_start', 'lp_break_saturday_end', 'lp_break_sunday_start', 'lp_break_sunday_end', 'lp_holidays_time_start', 'lp_holidays_time_end', 'lp_holidays_break_time_start', 'lp_holidays_break_time_end', 'created_at', 'updated_at'], 'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => RpManufacturer::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Организация',
            'monday_start' => 'Monday Start',
            'monday_end' => 'Monday End',
            'tuesday_start' => 'Tuesday Start',
            'tuesday_end' => 'Tuesday End',
            'wednesday_start' => 'Wednesday Start',
            'wednesday_end' => 'Wednesday End',
            'thursday_start' => 'Thursday Start',
            'thursday_end' => 'Thursday End',
            'friday_start' => 'Friday Start',
            'friday_end' => 'Friday End',
            'saturday_start' => 'Saturday Start',
            'saturday_end' => 'Saturday End',
            'sunday_start' => 'Sunday Start',
            'sunday_end' => 'Sunday End',
            'break_monday_start' => 'Начало перерыва в понедельник',
            'break_monday_end' => 'Конец перерыва в понедельник',
            'break_tuesday_start' => 'Начало перерыва во вторник',
            'break_tuesday_end' => 'Конец перерыва во вторник',
            'break_wednesday_start' => 'Начало перерыва в среду',
            'break_wednesday_end' => 'Конец перерыва в среду',
            'break_thursday_start' => 'Начало перерыва в четверг',
            'break_thursday_end' => 'Конец перерыва в четверг',
            'break_friday_start' => 'Начало перерыва в пятницу',
            'break_friday_end' => 'Конец перерыва в пятницу',
            'break_saturday_start' => 'Начало перерыва в субботу',
            'break_saturday_end' => 'Конец перерыва в субботу',
            'break_sunday_start' => 'Начало перерыва в воскресенье',
            'break_sunday_end' => 'Конец перерыва в воскресенье',
            'non_working_monday' => 'Нерабочий день. Понедельник.',
            'non_working_tuesday' => 'Нерабочий день. Вторник.',
            'non_working_wednesday' => 'Нерабочий день. Среда.',
            'non_working_thursday' => 'Нерабочий день. Четверг.',
            'non_working_friday' => 'Нерабочий день. Пятница.',
            'non_working_saturday' => 'Нерабочий день. Суббота.',
            'non_working_sunday' => 'Нерабочий день. Воскресенье.',
            'holidays_time_start' => 'Начало работы в нерабочий день',
            'holidays_time_end' => 'Конец работы в нерабочий день',
            'holidays_break_time_start' => 'Начало перерыва в нерабочий день',
            'holidays_break_time_end' => 'Начало перерыва в нерабочий день',
            'work_holidays' => 'Работаем в праздничные дни',
            'lp_monday_start' => 'Lp Monday Start',
            'lp_monday_end' => 'Lp Monday End',
            'lp_tuesday_start' => 'Lp Tuesday Start',
            'lp_tuesday_end' => 'Lp Tuesday End',
            'lp_wednesday_start' => 'Lp Wednesday Start',
            'lp_wednesday_end' => 'Lp Wednesday End',
            'lp_thursday_start' => 'Lp Thursday Start',
            'lp_thursday_end' => 'Lp Thursday End',
            'lp_friday_start' => 'Lp Friday Start',
            'lp_friday_end' => 'Lp Friday End',
            'lp_saturday_start' => 'Lp Saturday Start',
            'lp_saturday_end' => 'Lp Saturday End',
            'lp_sunday_start' => 'Lp Sunday Start',
            'lp_sunday_end' => 'Lp Sunday End',
            'lp_break_monday_start' => 'Начало перерыва в понедельник	',
            'lp_break_monday_end' => 'Конец перерыва в понедельник	',
            'lp_break_tuesday_start' => '	Начало перерыва во вторник',
            'lp_break_tuesday_end' => 'Конец перерыва во вторник	',
            'lp_break_wednesday_start' => 'Начало перерыва в среду	',
            'lp_break_wednesday_end' => 'Конец перерыва в среду',
            'lp_break_thursday_start' => 'Начало перерыва в четверг	',
            'lp_break_thursday_end' => 'Конец перерыва в четверг	',
            'lp_break_friday_start' => 'Начало перерыва в пятницу	',
            'lp_break_friday_end' => 'Конец перерыва в пятницу	',
            'lp_break_saturday_start' => 'Начало перерыва в субботу	',
            'lp_break_saturday_end' => 'Конец перерыва в субботу	',
            'lp_break_sunday_start' => 'Начало перерыва в воскресенье	',
            'lp_break_sunday_end' => 'Конец перерыва в воскресенье	',
            'lp_non_working_monday' => 'Склад. Нерабочий день. Понедельник.',
            'lp_non_working_tuesday' => 'Склад. Нерабочий день. Вторник.',
            'lp_non_working_wednesday' => 'Склад. Нерабочий день. Среда.',
            'lp_non_working_thursday' => 'Склад. Нерабочий день. Четверг.',
            'lp_non_working_friday' => 'Склад. Нерабочий день. Пятница.',
            'lp_non_working_saturday' => 'Склад. Нерабочий день. Суббота.',
            'lp_non_working_sunday' => 'Склад. Нерабочий день. Воскресенье.',
            'lp_holidays_time_start' => 'Склад. Начало работы в нерабочий день',
            'lp_holidays_time_end' => 'Склад. Конец работы в нерабочий день',
            'lp_holidays_break_time_start' => 'Склад. Начало перерыва в нерабочий день',
            'lp_holidays_break_time_end' => 'Склад. Начало перерыва в нерабочий день',
            'lp_work_holidays' => 'Склад. Работаем в праздничные дни',
            'created_by' => 'Кто создал',
            'updated_by' => 'Кто изменил',
            'created_at' => 'Время создания',
            'updated_at' => 'Время изменения',
            'isDeleted' => 'Удалена',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(RpManufacturer::class, ['id' => 'company_id']);
    }
}
