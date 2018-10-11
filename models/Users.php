<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use dektrium\user\models\User as BaseUser;
use dektrium\user\traits\EventTrait;
use dektrium\user\traits\ModuleTrait;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int $confirmed_at
 * @property string $unconfirmed_email
 * @property int $blocked_at
 * @property string $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 * @property int $last_login_at
 * @property int $status
 * @property string $password_reset_token
 * @property string $pname คำนำหน้า
 * @property string $name ชื่อ-สกุล
 * @property int $dep_id หน่วงาน
 * @property int $occ_id อาชีพ
 * @property string $occ_no เลขที่ใบประกอบวิชาชีพ
 * @property int $pos_id ตำแหน่ง
 * @property string $pos_no เลขที่ประจำตำแหน่ง
 * @property string $role
 */
class Users extends BaseUser
{
 use ModuleTrait;
    const BEFORE_CREATE   = 'beforeCreate';
    const AFTER_CREATE    = 'afterCreate';
    const BEFORE_REGISTER = 'beforeRegister';
    const AFTER_REGISTER  = 'afterRegister';
    const BEFORE_CONFIRM  = 'beforeConfirm';
    const AFTER_CONFIRM   = 'afterConfirm';
    
    const ROLE_ADMIN = 10;
    const ROLE_DOCTOR = 20;
    const ROLE_NURSE = 30;
    const ROLE_PHAR = 40;
    const ROLE_DENT = 50;
    const ROLE_SASUK = 60;
    
    public static $role =[10=>'admin',20=>'doctor',30=>'nurse',40=>'phar',50=>'dent',60=>'sasuk'];
    
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'dep_id', 'occ_id', 'pos_id'], 'default', 'value' => null],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'last_login_at', 'status', 'dep_id', 'occ_id', 'pos_id'], 'integer'],
            [['username', 'email', 'unconfirmed_email', 'password_reset_token', 'name'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['pname', 'occ_no', 'pos_no'], 'string', 'max' => 20],
            [['role','hospcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'last_login_at' => 'Last Login At',
            'status' => 'Status',
            'password_reset_token' => 'Password Reset Token',
            'pname' => 'คำนำหน้า',
            'name' => 'ชื่อ-สกุล',
            'dep_id' => 'หน่วงาน',
            'occ_id' => 'อาชีพ',
            'occ_no' => 'เลขที่ใบประกอบวิชาชีพ',
            'pos_id' => 'ตำแหน่ง',
            'pos_no' => 'เลขที่ประจำตำแหน่ง',
            'role' => 'Role',
            'hospcode'=>'Hospcode'
        ];
    }
}
