<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Добро пожаловать';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Добро пожаловать!</h1>

       

        <div class="buttons">
            <!-- переход на страницу с авторизацией -->
        <?= Html::a('Войти в свой профиль', Url::to(['books/login']), ['class' => 'btn btn-primary']) ?>
            <!-- переход на страницу регистрации -->
        <?= Html::a('Зарегистрироваться', Url::to(['books/register']), ['class' => 'btn btn-success']) ?>
    </div>
   
</div>
