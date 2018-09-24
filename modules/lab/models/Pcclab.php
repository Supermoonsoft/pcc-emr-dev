<?php

namespace app\modules\lab\models;

use Yii;

/**
 * This is the model class for table "pcc_lab".
 *
 * @property string $id
 * @property string $hn
 * @property string $vn
 * @property string $provider_code
 * @property string $provider_name
 * @property string $date_service
 * @property string $time_service
 * @property string $lab_code
 * @property string $lab_name
 * @property string $standard_result
 * @property string $lab_request_at
 * @property string $lab_result_at
 * @property array $data_json
 * @property string $last_update
 * @property string $lab_result
 */
class Pcclab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hn', 'vn', 'provider_code', 'provider_name', 'date_service'], 'required'],
            [['id'], 'string'],
            [['date_service', 'time_service', 'lab_request_at', 'lab_result_at', 'data_json', 'last_update'], 'safe'],
            [['hn'], 'string', 'max' => 9],
            [['vn'], 'string', 'max' => 12],
            [['provider_code'], 'string', 'max' => 5],
            [['provider_name', 'lab_name'], 'string', 'max' => 255],
            [['lab_code', 'standard_result', 'lab_result'], 'string', 'max' => 100],
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
            'hn' => 'Hn',
            'vn' => 'Vn',
            'provider_code' => 'Provider Code',
            'provider_name' => 'Provider Name',
            'date_service' => 'Date Service',
            'time_service' => 'Time Service',
            'lab_code' => 'Lab Code',
            'lab_name' => 'Lab Name',
            'standard_result' => 'Standard Result',
            'lab_request_at' => 'Lab Request At',
            'lab_result_at' => 'Lab Result At',
            'data_json' => 'Data Json',
            'last_update' => 'Last Update',
            'lab_result' => 'Lab Result',
        ];
    }

    public function afterFind()
    {
        foreach($this->attributes as $column_name => $value){
            if(preg_match('/(\d{4}-\d{2}-\d{2})/', $value)){ //ถ้ามีค่าในรูปแบบ 2016-05-20 13:30:45

                if($value == '0000-00-00'){ //ถ้าไม่มีข้อมูล
                    $this->setAttribute($column_name, null); //กำหนดให้เป็นค่าว่าง
                }else{
                    $date_and_time = explode('.', $value);
                    $date_time = explode(' ', $date_and_time[0]); //แยกวันและเวลา

                    $ymd = explode('-', $date_time[0]);//แยก ปี-เดือน-วัน
                    $year = (int) $ymd[0];//กำหนดให้เป็น int เพื่อการคำนวณ
                    $year = $year + 543;// นำปี +543
                    $result = $ymd[2] . '/' . $ymd[1] . '/' . $year ;//ได้รูปแบบ วัน/เดือน/ปี ชั่วโมง:นาที:วินาทีี
                    $this->setAttribute($column_name, $result);//กำหนดค่าใหม่
                }
            }

        }
        return parent::afterFind();
    }
}
