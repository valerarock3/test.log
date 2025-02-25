<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\ContactForm;
use app\models\User;
use yii\web\Response;
use yii\filters\AccessControl;


class BooksController extends Controller
{
    // Добавляем поведения для контроля доступа
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'register', 'contact'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'register', 'contact'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    // страница с авторизацией
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['books/profile']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['books/profile']);
        }

        $model->password = ''; // Очищаем пароль для безопасности
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    // страница с регистрацией

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('success', 'Регистрация успешна!');
            return $this->redirect(['books/profile']);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    // страница с домашней страницей
    public function actionHome()
    {
        return $this->render('home');
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['books/home']);
    }


    // страница с контактами

    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('success', 'Спасибо за ваше сообщение. Мы свяжемся с вами в ближайшее время.');
                    return $this->refresh();
                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Произошла ошибка при отправке сообщения.');
                Yii::error('Ошибка отправки email: ' . $e->getMessage());
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        // Проверяем, авторизован ли пользователь
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['books/login']);
        }

        $user = User::findOne(Yii::$app->user->id);
        
        return $this->render('profile', [
            'user' => $user
        ]);
    }

    public function actionAiChat()
    {
        $message = Yii::$app->request->post('message');
        $response = '';
        
        if ($message) {
            // Здесь будет логика обработки запроса к AI
            // Пока просто заглушка
            $response = "Это тестовый ответ на ваше сообщение: " . $message;
        }

        return $this->render('ai-chat', [
            'response' => $response
        ]);
    }
}