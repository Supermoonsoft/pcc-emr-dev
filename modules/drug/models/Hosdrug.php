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
}
