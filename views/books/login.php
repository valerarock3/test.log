<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;

// Регистрируем CSS файл
$this->registerCssFile('@web/css/login.css');
?>

<div class="welcome-container">
    <h1 class="welcome-title">Вход в систему</h1>
    
    <div class="form-container">
        <p class="text-center mb-4">Пожалуйста, заполните следующие поля для входа:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
        ]); ?>

        <?= $form->field($model, 'username', [
            'options' => ['class' => 'form-group'],
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Введите имя пользователя']
        ])->label('Имя пользователя') ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group'],
            'template' => "{label}\n{input}\n{error}",
            'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Введите пароль']
        ])->passwordInput()->label('Пароль') ?>

        <?= $form->field($model, 'rememberMe', [
            'options' => ['class' => 'form-group checkbox-group'],
        ])->checkbox(['label' => 'Запомнить меня']) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Войти', ['class' => 'btn-login', 'name' => 'login-button']) ?>
        </div>

        <div class="text-center mt-3">
            <?= Html::a('Нет аккаунта? Зарегистрируйтесь', ['books/register'], ['class' => 'register-link']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>