<?php

namespace app\modules\lab\models;

use Yii;

class Preorderlab extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'pre_order_lab';
    }

    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string'],
            [['hos_date_visit', 'request_at', 'result_at', 'data_json'], 'safe'],
            [['cid'], 'string', 'max' => 13],
            [['hos_hn'], 'string', 'max' => 9],
            [['hos_vn'], 'string', 'max' => 15],
            [['lab_code_hos', 'lab_code_moph', 'lab_name_hos', 'lab_name_moph', 'hos_result', 'lab_normal', 'lab_possible', 'lab_range_min', 'lab_range_max', 'lab_range_female_min', 'lab_range_female_max'], 'string', 'max' => 255],
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
            'cid' => 'Cid',
            'hos_hn' => 'Hos Hn',
            'hos_vn' => 'Hos Vn',
            'hos_date_visit' => 'Hos Date Visit',
            'lab_code_hos' => 'Lab Code Hos',
            'lab_code_moph' => 'Lab Code Moph',
            'lab_name_hos' => 'Lab Name Hos',
            'request_at' => 'Request At',
            'result_at' => 'Result At',
            'data_json' => 'Data Json',
            'lab_name_moph' => 'Lab Name Moph',
            'hos_result' => 'Hos Result',
            'lab_normal' => 'Lab Normal',
            'lab_possible' => 'Lab Possible',
            'lab_range_min' => 'Lab Range Min',
            'lab_range_max' => 'Lab Range Max',
            'lab_range_female_min' => 'Lab Range Female Min',
            'lab_range_female_max' => 'Lab Range Female Max',
        ];
    }
}
