<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class RegisterForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $avatarFile;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'confirmPassword'], 'required', 'message' => 'Это поле обязательно для заполнения'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email', 'message' => 'Неверный формат email'],
            ['password', 'string', 'min' => 6, 'message' => 'Пароль должен содержать минимум 6 символов'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            
            // Проверка на уникальность
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Это имя пользователя уже занято'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Этот email уже зарегистрирован'],
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024*1024*2]
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->confirmPassword = $this->confirmPassword;
        $user->generateAuthKey();

        // Обработка загрузки аватара
        $this->avatarFile = UploadedFile::getInstance($this, 'avatarFile');
        if ($this->avatarFile) {
            $uploadPath = Yii::getAlias('@webroot/uploads/avatars/');
            
            // Создаем директорию, если она не существует
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            
            $fileName = 'avatar_' . time() . '.' . $this->avatarFile->extension;
            $user->avatar = $fileName;
            $this->avatarFile->saveAs($uploadPath . $fileName);
        }
        
        if ($user->save()) {
            // Автоматический вход после регистрации
            Yii::$app->user->login($user);
            return true;
        }
        
        return false;
    }
}
