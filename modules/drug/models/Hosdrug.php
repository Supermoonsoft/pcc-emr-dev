<?php

namespace app\modules\drug\models;

use Yii;

/**
 * This is the model class for table "hos_drug".
 *
 * @property string $id
 * @property string $cid
 * @property string $hos_hn
 * @property string $hos_vn
 * @property string $hos_date_visit
 * @property string $drug_code_hos
 * @property string $drug_name_hos
 * @property string $drug_pay_amount
 * @property string $drug_pay_unit
 * @property array $data_json
 * @property string $drug_code_moph
 * @property string $drug_name_moph
 */
class Hosdrug extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hos_drug';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string'],
            [['hos_date_visit', 'data_json'], 'safe'],
            [['drug_pay_amount', 'drug_pay_unit'], 'number'],
            [['cid'], 'string', 'max' => 13],
            [['hos_hn'], 'string', 'max' => 9],
            [['hos_vn'], 'string', 'max' => 15],
            [['drug_code_hos', 'drug_name_hos', 'drug_code_moph', 'drug_name_moph'], 'string', 'max' => 255],
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
            'drug_code_hos' => 'Drug Code Hos',
            'drug_name_hos' => 'Drug Name Hos',
            'drug_pay_amount' => 'Drug Pay Amount',
            'drug_pay_unit' => 'Drug Pay Unit',
            'data_json' => 'Data Json',
            'drug_code_moph' => 'Drug Code Moph',
            'drug_name_moph' => 'Drug Name Moph',
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
