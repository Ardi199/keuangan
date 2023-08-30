<?php

namespace app\models;

use Yii;
use yii\base\Security;

/**
 * This is the model class for table "data_pengguna".
 *
 * @property int $ID_PENGGUNA
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $STATUS_USER
 * @property string $JENIS_USER
 */
class DataPengguna  extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_pengguna';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERNAME', 'PASSWORD', 'STATUS_USER', 'JENIS_USER','NAMA_PENGGUNA'], 'required'],
            [['USERNAME', 'PASSWORD', 'STATUS_USER', 'JENIS_USER'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_PENGGUNA' => 'Id Pengguna',
            'USERNAME' => 'Username',
            'PASSWORD' => 'Password',
            'STATUS_USER' => 'Status User',
            'JENIS_USER' => 'Jenis User',
            'NAMA_PENGGUNA' => 'Nama Pengguna'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne($token);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()
            ->where(['USERNAME' => $username])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->PASSWORD;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->PASSWORD === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->ID_PENGGUNA;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->PASSWORD === $password;
    }

    public function encryptPassword($password)
    {
        $security = new Security();
        $passHash = $security->generatePasswordHash($password);
        $validate = $security->validatePassword($password, $passHash);
        return $validate;
    }

    public function getIdPengguna()
    {
        $last = DataPengguna::find()->select('ID_PENGGUNA')->orderBy(['ID_PENGGUNA' => SORT_DESC])->scalar();
        if($last == null):
            $newId = 1;
        else:
            $newId = $last + 1;
        endif;
        print_r($newId);die;
        return $newId;
    }
}
