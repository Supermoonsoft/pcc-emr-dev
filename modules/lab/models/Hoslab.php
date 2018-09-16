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
            'hos_date_visit' => 'Hos Date Visit',
            'lab_code_hos' => 'Lab Code Hos',
            'lab_code_moph' => 'Lab Code Moph',
            'lab_name_hos' => 'Lab Name Hos',
            'request_at' => 'Request At',
            'result_at' => 'Result At',
            'data_json' => 'Data Json',
            'lab_name_moph' => 'Lab Name Moph',
            'hos_result'=>'hos_result'
        ];
    }
}
