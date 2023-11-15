<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Models\PetOwners;
use Models\Users;

/**
 * Контроллер вывода результата на экран
 */
class ResultController extends Controller
{
    public function actionIndex()
    {

        // если пользователь не авторизован, то на страницу логина отправляем
        if (!Users::is_auth()) {
            header('Location: /user/login');
            die;
        }

        // создаем модель владельца питомца
        $model = new PetOwners();

        // получаем необходимые данные
        $data = $model->getData();

        // и выводим результирующую страницу
        View::render('importResultView', $data);

    }

}