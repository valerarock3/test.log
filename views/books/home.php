<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Добро пожаловать';
$this->registerCssFile('@web/css/main.css');

// Добавляем шрифт Roboto
$this->registerCssFile('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');
?>

<div class="welcome-container">
    <h1 class="welcome-title">Добро пожаловать!</h1>
    
    <div class="btn-group">
        <?= Html::a('Войти в свой профиль', ['books/login'], ['class' => 'btn-login']) ?>
        <?= Html::a('Зарегистрироваться', ['books/register'], ['class' => 'btn-register']) ?>
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-left">
            <p>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        </div>
        <div class="footer-right">
            <p>Powered by <?= Html::a('Yii Framework', 'https://www.yiiframework.com/', ['target' => '_blank']) ?></p>
        </div>
    </div>
</footer>
