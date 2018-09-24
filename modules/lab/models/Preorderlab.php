<?php

namespace app\modules\lab\models;

use Yii;

/**
 * This is the model class for table "pcc_service_preorderlab".
 *
 * @property string $id
 * @property string $pcc_vn อ้างอิงตาราง pcc_visit
 * @property array $data_json
 * @property string $pcc_start_service_datetime
 * @property string $pcc_end_service_datetime
 * @property string $data1
 * @property string $data2
 * @property string $hoscode
 * @property string $lab_code
 * @property string $lab_name
 * @property string $lab_standard_result
 * @property string $lab_request_at
 * @property string $lab_result_at
 * @property string $lab_result
 * @property string $lab_code_moph
 */
class Preorderlab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_service_preorderlab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'string'],
            [['data_json', 'pcc_start_service_datetime', 'pcc_end_service_datetime'], 'safe'],
            [['pcc_vn'], 'string', 'max' => 12],
            [['data1', 'data2', 'lab_code', 'lab_name', 'lab_standard_result', 'lab_request_at', 'lab_result_at', 'lab_result', 'lab_code_moph'], 'string', 'max' => 255],
            [['hoscode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pcc_vn' => 'Pcc Vn',
            'data_json' => 'Data Json',
            'pcc_start_service_datetime' => 'Pcc Start Service Datetime',
            'pcc_end_service_datetime' => 'Pcc End Service Datetime',
            'data1' => 'Data1',
            'data2' => 'Data2',
            'hoscode' => 'Hoscode',
            'lab_code' => 'Lab Code',
            'lab_name' => 'Lab Name',
            'lab_standard_result' => 'Lab Standard Result',
            'lab_request_at' => 'Lab Request At',
            'lab_result_at' => 'Lab Result At',
            'lab_result' => 'Lab Result',
            'lab_code_moph' => 'Lab Code Moph',
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
