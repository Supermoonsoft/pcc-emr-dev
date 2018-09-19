<?php

namespace app\modules\doctorworkbench\models;

use Yii;

class SDoctordiag extends \yii\db\ActiveRecord
{

    public $items;
    
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
