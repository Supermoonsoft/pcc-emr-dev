<?php

namespace app\modules\chiefcomplaint\models;

use Yii;

/**
 * This is the model class for table "pcc_service_pe".
 *
 * @property string $id
 * @property string $pcc_vn อ้างอิงตาราง pcc_visit
 * @property array $data_json
 * @property string $data1
 * @property string $data2
 * @property string $hospcode
 * @property string $pe_text
 * @property string $date_service
 * @property string $time_service
 * @property string $cid
 * @property string $vn
 * @property string $hn
 */
class PccServicePe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_service_pe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id'], 'required'],
            [['id', 'pe_text'], 'string'],
            [['data_json', 'date_service', 'time_service'], 'safe'],
            [['pcc_vn'], 'string', 'max' => 12],
            [['data1', 'data2'], 'string', 'max' => 255],
            [['hospcode'], 'string', 'max' => 5],
            [['cid'], 'string', 'max' => 13],
            [['vn'], 'string', 'max' => 15],
            [['hn'], 'string', 'max' => 9],
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
            'pcc_vn' => 'อ้างอิงตาราง pcc_visit',
            'data_json' => 'Data Json',
            'data1' => 'Data1',
            'data2' => 'Data2',
            'hospcode' => 'Hospcode',
            'pe_text' => 'Pe Text',
            'date_service' => 'Date Service',
            'time_service' => 'Time Service',
            'cid' => 'Cid',
            'vn' => 'Vn',
            'hn' => 'Hn',
        ];
    }
}
