<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\RegisterForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

// Регистрируем CSS файл
$this->registerCssFile('@web/css/register.css');
?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните следующие поля для регистрации:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'register-form',
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Введите имя пользователя') ?>

        <?= $form->field($model, 'email')->textInput()->label('Введите ваш email') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Введите ваш пароль') ?>

        <?= $form->field($model, 'confirmPassword')->passwordInput()->label('Повторите пароль') ?>

        <?= $form->field($model, 'avatarFile')->fileInput()->label('Загрузите аватар') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
