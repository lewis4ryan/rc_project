<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "daily_value".
 *
 * @property string $id
 * @property double $daily_value
 * @property string $measure_unit
 */
class DailyValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daily_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'daily_value'], 'required'],
            [['daily_value'], 'number'],
            [['id', 'measure_unit'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã',
            'daily_value' => 'Nhu cầu dinh dưỡng',
            'measure_unit' => 'Đơn vị',
        ];
    }
}
