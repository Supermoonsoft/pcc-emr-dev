<?php

namespace app\modules\chiefcomplaint\models;

use Yii;

/**
 * This is the model class for table "pcc_service_cc".
 *
 * @property string $id
 * @property string $pcc_vn อ้างอิงตาราง pcc_visit
 * @property array $data_json
 * @property string $date_service
 * @property string $time_service
 * @property string $data1
 * @property string $data2
 * @property string $hospcode
 * @property string $cc_text
 * @property string $cid เลขบัตรประชาชน
 * @property string $hn
 * @property string $vn
 */
class PccServiceCc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_service_cc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['id'], 'required'],
            [['id', 'cc_text'], 'string'],
            [['data_json', 'date_service', 'time_service'], 'safe'],
            [['pcc_vn'], 'string', 'max' => 12],
            [['data1', 'data2'], 'string', 'max' => 255],
            [['hospcode'], 'string', 'max' => 5],
            [['cid'], 'string', 'max' => 13],
            [['hn'], 'string', 'max' => 9],
            [['vn'], 'string', 'max' => 15],
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
            'date_service' => 'วันที่รับบริการ',
            'time_service' => 'Time Service',
            'data1' => 'Data1',
            'data2' => 'Data2',
            'hospcode' => 'Hospcode',
            'cc_text' => 'CC Text',
            'cid' => 'เลขบัตรประชาชน',
            'hn' => 'Hn',
            'vn' => 'Vn',
        ];
    }
}
