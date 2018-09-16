<?php

namespace app\modules\doctorworkbench\models;

use Yii;

/**
 * This is the model class for table "s_doctorrx".
 *
 * @property string $id
 * @property string $vn
 * @property string $hn
 * @property string $an
 * @property string $vstdate
 * @property string $vsttime
 * @property string $drugcode รหัสรายการ
 * @property string $use_id รหัสวิธีใช้
 * @property string $qty จำนวนจ่าย
 * @property string $unitprice ราคาขาย/หน่วย
 * @property string $costprice ราคาทุน/หน่วย
 * @property string $totalprice รวมราคาขาย
 * @property string $userid_doctor
 * @property array $data_json
 */
class SDoctorrx extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 's_doctorrx';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string'],
            [['vstdate', 'vsttime', 'data_json'], 'safe'],
            [['use_id'], 'default', 'value' => null],
            [['use_id'], 'integer'],
            [['qty', 'unitprice', 'costprice', 'totalprice'], 'number'],
            [['vn', 'hn', 'an', 'userid_doctor'], 'string', 'max' => 50],
            [['drugcode'], 'string', 'max' => 24],
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
            'an' => 'An',
            'vstdate' => 'Vstdate',
            'vsttime' => 'Vsttime',
            'drugcode' => 'รหัสรายการ',
            'use_id' => 'รหัสวิธีใช้',
            'qty' => 'จำนวนจ่าย',
            'unitprice' => 'ราคาขาย/หน่วย',
            'costprice' => 'ราคาทุน/หน่วย',
            'totalprice' => 'รวมราคาขาย',
            'userid_doctor' => 'Userid Doctor',
            'data_json' => 'Data Json',
        ];
    }
}
