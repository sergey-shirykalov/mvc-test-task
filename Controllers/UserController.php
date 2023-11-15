<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Models\Users;


/**
 * Контроллер работы с пользователями, с входом и выходом в систему
 */
class UserController extends Controller
{
    /**
     * Отображение страницы входа в систему
     */
    public function actionLogin()
    {
        // если уже авторизовали пользователя, то на страницу логина не заходим
        if (Users::is_auth()) {
            header('Location: /');
            die;
        }

        // Рендер страницы входа
        View::render('loginView');
    }

    /**
     * Проверка имени и пароля пользователя
     */
    public function actionCheck()
    {
        // если уже авторизовали пользователя, то на страницу логина не заходим
        if (Users::is_auth()) {
            header('Location: /');
            die;
        }

        // проверяем имя и пароль пользователя
        $res = Users::check($_POST['username'], $_POST['password']);
        if (false === $res) {
            $_SESSION['message'] = 'Неверное имя пользователя или пароль';
            header('Location: /user/login');
            die;
        } else {
            $_SESSION['user_id'] = $res;
            header('Location: /');
            die;
        }
    }

    /**
     * Выход из системы
     * @return void
     */
    public function actionLogout()
    {
        $_SESSION['user_id'] = null;
        header('Location: /');
    }

}