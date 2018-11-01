<?php

namespace app\modules\chiefcomplaint\models;

use Yii;

/**
 * This is the model class for table "pcc_service_pi".
 *
 * @property string $id
 * @property string $pcc_vn อ้างอิงตาราง pcc_visit
 * @property array $data_json
 * @property string $date_service
 * @property string $time_service
 * @property string $data1
 * @property string $data2
 * @property string $hospcode
 * @property string $pi_text
 * @property string $sbp
 * @property string $dbp
 * @property string $temp
 * @property string $pp
 * @property string $pr
 * @property string $o2sat
 * @property string $height
 * @property string $weight
 * @property string $cid
 * @property string $vn
 * @property string $hn
 */
class PccServicePi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_service_pi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'pi_text'], 'string'],
            [['data_json', 'date_service', 'time_service'], 'safe'],
            [['sbp', 'dbp', 'temp', 'pp', 'pr', 'o2sat', 'height', 'weight'], 'number'],
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
            'date_service' => 'Date Service',
            'time_service' => 'Time Service',
            'data1' => 'Data1',
            'data2' => 'Data2',
            'hospcode' => 'Hospcode',
            'pi_text' => 'Pi Text',
            'sbp' => 'BP',
            'dbp' => 'Dbp',
            'temp' => 'Temp',
            'pp' => 'Pp',
            'pr' => 'Pr',
            'o2sat' => 'O2sat',
            'height' => 'Height',
            'weight' => 'Weight',
            'cid' => 'Cid',
            'vn' => 'Vn',
            'hn' => 'Hn',
        ];
    }
}
