<?php

namespace app\modules\doctorworkbench\models;

use Yii;

/**
 * This is the model class for table "s_doctordiag".
 *
 * @property string $id
 * @property string $vn
 * @property string $hn
 * @property string $vstdate
 * @property string $vsttime
 * @property string $diagtype
 * @property string $diagcode
 * @property string $icd10
 * @property string $userid_doctor
 * @property array $data_json
 */
class SDoctordiag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 's_doctordiag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'vn', 'hn'], 'required'],
            [['id'], 'string'],
            [['vstdate', 'vsttime', 'data_json'], 'safe'],
            [['vn', 'hn', 'userid_doctor'], 'string', 'max' => 50],
            [['diagtype'], 'string', 'max' => 3],
            [['diagcode', 'icd10'], 'string', 'max' => 7],
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
            'vn' => 'Vn',
            'hn' => 'Hn',
            'vstdate' => 'Vstdate',
            'vsttime' => 'Vsttime',
            'diagtype' => 'Diagtype',
            'diagcode' => 'Diagcode',
            'icd10' => 'Icd10',
            'userid_doctor' => 'Userid Doctor',
            'data_json' => 'Data Json',
        ];
    }
}
