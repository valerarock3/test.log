<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'AI Ассистент';

// Регистрируем CSS файл
$this->registerCssFile('@web/css/ai-chat.css');
?>

<div class="chat-container">
    <?= Html::a('← Вернуться в профиль', ['books/profile'], ['class' => 'btn-back']) ?>
    
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="chat-messages" id="chatMessages">
        <?php if (isset($response) && $response): ?>
            <div class="message ai-message">
                <?= Html::encode($response) ?>
            </div>
        <?php endif; ?>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['id' => 'chatForm']]); ?>
        <div class="input-group">
            <input type="text" 
                   name="message" 
                   class="message-input" 
                   placeholder="Введите ваше сообщение..."
                   required>
            <?= Html::submitButton('Отправить', ['class' => 'btn-send']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<<JS
    // Прокрутка чата вниз при загрузке
    document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
    
    // Отправка формы через AJAX
    $('#chatForm').on('submit', function(e) {
        e.preventDefault();
        
        var message = $(this).find('input[name="message"]').val();
        var chatMessages = $('#chatMessages');
        
        // Добавляем сообщение пользователя
        chatMessages.append('<div class="message user-message">' + message + '</div>');
        
        // Очищаем поле ввода
        $(this).find('input[name="message"]').val('');
        
        // Прокручиваем чат вниз
        chatMessages.scrollTop(chatMessages[0].scrollHeight);
        
        // Отправляем запрос
        $.post('', {message: message}, function(response) {
            // Добавляем ответ AI
            chatMessages.append('<div class="message ai-message">' + response + '</div>');
            chatMessages.scrollTop(chatMessages[0].scrollHeight);
        });
    });
JS;
$this->registerJs($js);
?> 