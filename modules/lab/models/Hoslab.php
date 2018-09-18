<?php

namespace app\modules\lab\models;

use Yii;

/**
 * This is the model class for table "hos_lab".
 *
 * @property string $id
 * @property string $cid
 * @property string $hos_hn
 * @property string $hos_vn
 * @property string $hos_date_visit
 * @property string $lab_code_hos
 * @property string $lab_code_moph
 * @property string $lab_name_hos
 * @property string $request_at
 * @property string $result_at
 * @property array $data_json
 * @property string $lab_name_moph
 */
class Hoslab extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hos_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string'],
            [['hos_date_visit', 'request_at', 'result_at', 'data_json'], 'safe'],
            [['cid'], 'string', 'max' => 13],
            [['hos_hn'], 'string', 'max' => 9],
            [['hos_vn'], 'string', 'max' => 15],
            [['lab_code_hos','hos_result', 'lab_code_moph', 'lab_name_hos', 'lab_name_moph'], 'string', 'max' => 255],
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
            'hos_date_visit' => 'วันที่รับบริการแม่ข่าย',
            'lab_code_hos' => 'Lab Code Hos',
            'lab_code_moph' => 'Lab Code Moph',
            'lab_name_hos' => 'ชื่อรายการแล๊ป',
            'request_at' => 'วันที่สั่งแล๊ป',
            'result_at' => 'วันที่รายงานผล',
            'data_json' => 'Data Json',
            'lab_name_moph' => 'ชื่อรายการแล๊ป',
            'hos_result'=>'ผลแล๊ป'
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
