<?php

namespace app\modules\emr\models;

use Yii;

/**
 * This is the model class for table "pcc_diagnosis".
 *
 * @property string $id
 * @property string $hn
 * @property string $vn
 * @property string $provider_code
 * @property string $provider_name
 * @property string $date_service
 * @property string $time_service
 * @property string $icd_code
 * @property string $icd_name
 * @property string $diag_type
 * @property array $data_json
 * @property string $last_update
 */
class PccDiagnosis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pcc_diagnosis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hn', 'vn'], 'required'],
            [['id'], 'string'],
            [['date_service', 'time_service', 'data_json', 'last_update'], 'safe'],
            [['hn'], 'string', 'max' => 9],
            [['vn'], 'string', 'max' => 12],
            [['provider_code'], 'string', 'max' => 5],
            [['provider_name'], 'string', 'max' => 100],
            [['icd_code'], 'string', 'max' => 50],
            [['icd_name'], 'string', 'max' => 255],
            [['diag_type'], 'string', 'max' => 10],
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
            'icd_code' => 'รหัส',
            'icd_name' => 'รายการ',
            'diag_type' => 'Diag Type',
            'data_json' => 'Data Json',
            'last_update' => 'Last Update',
        ];
    }
}
