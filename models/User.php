<?php 
 
namespace app\models; 
 
use Yii;
use yii\db\ActiveRecord; 
use yii\web\IdentityInterface; 
use yii\base\NotSupportedException;
 
class User extends ActiveRecord implements IdentityInterface 
{ 
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public static function tableName() 
    { 
        return 'valera.user'; 
    } 

    public function attributes()
    {
        return [
            'id',
            'username',
            'password',
            'auth_key',
            'email',
            'confirmPassword',
            'avatar'
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['username', 'unique'],
            ['email', 'unique'],
            ['confirmPassword', 'safe']
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /** 
     * Finds an identity by the given ID. 
     * 
     * @param string|int $id the ID to be looked for 
     * @return IdentityInterface|null the identity object that matches the given ID. 
     */ 
    public static function findIdentity($id) 
    { 
        return static::findOne($id); 
    } 
 
    /** 
     * Finds an identity by the given token. 
     * 
     * @param string $token the token to be looked for 
     * @return IdentityInterface|null the identity object that matches the given token. 
     */ 
    public static function findIdentityByAccessToken($token, $type = null) 
    { 
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.'); 
    } 
 
    /** 
     * @return int|string current user ID 
     */ 
    public function getId() 
    { 
        return $this->id; 
    } 
 
    /** 
     * @return string current user auth key 
     */ 
    public function getAuthKey() 
    { 
        return $this->auth_key; 
    } 
 
    /** 
     * @param string $authKey 
     * @return bool if auth key is valid for current user 
     */ 
    public function validateAuthKey($authKey) 
    { 
        return $this->auth_key === $authKey; 
    } 

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}