<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\RegisterForm;
use yii\web\Response;

class BooksController extends Controller
{

    // страница с авторизацией
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    // страница с регистрацией

    public function actionRegister()
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('success', 'Registration successful!');
            return $this->redirect(['books/login']);
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
        return $this->goHome();
    }
  
}