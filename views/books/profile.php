<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;

// Регистрируем CSS файл
$this->registerCssFile('@web/css/profile.css');
?>

<div class="user-profile">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-3">
            <?php 
            $avatarPath = Yii::getAlias('@webroot/uploads/avatars/') . ($user->avatar ?: 'default.png');
            $avatarUrl = Yii::getAlias('@web/uploads/avatars/') . ($user->avatar ?: 'default.png');
            
            if (file_exists($avatarPath)): ?>
                <img src="<?= $avatarUrl ?>" 
                     class="profile-avatar" 
                     alt="Аватар пользователя">
            <?php else: ?>
                <div class="profile-avatar" style="
                    background-color: #e9ecef;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 48px;
                    color: #6c757d;
                ">
                    <?= strtoupper(substr($user->username, 0, 1)) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-6 profile-info">
            <?= DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'username:text:Имя пользователя',
                    'email:email:Email',
                ],
                'options' => ['class' => 'table detail-view']
            ]) ?>
        </div>
    </div>

    <div class="btn-group">
        <?= Html::a('AI Ассистент', ['books/ai-chat'], [
            'class' => 'btn btn-primary',
        ]) ?>
        
        <?= Html::a('Выйти', ['books/home'], [
            'class' => 'btn btn-danger',
            'data' => [
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div> 