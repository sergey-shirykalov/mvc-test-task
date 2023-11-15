<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use Exception;
use Models\PetOwners;
use Models\Users;

/**
 * Контроллер импорта данных из XML файла
 */
class ImportController extends Controller
{
    /**
     * Отображение страницы импорта
     */
    public function actionIndex()
    {

        // если пользователь не авторизован, то на страницу логина отправляем
        if (!Users::is_auth()) {
            header('Location: /user/login');
            die;
        }

        // Рендер страницы импорта
        View::render('importView');
    }

    /**
     * Загрузка файла XML
     */
    public function actionLoad()
    {

        // если пользователь не авторизован, то на страницу логина отправляем
        if (!Users::is_auth()) {
            header('Location: /user/login');
            die;
        }

        // создаем модель владельца питомца
        $model = new PetOwners();
        // пытаемся загрузить из XML в БД
        try {
            $model->loadData();
            // если успешно загрузились, устанавливаем признак успешной загрузки для вывода сообщения и обновляем эту же страницу
            $_SESSION['loaded'] = 1;
            header('Location: /import');

        } catch (Exception $e) { // если ошибка, выводим соответствующую страницу
            View::render('importErrorView', ['error' => $e->getMessage()]);
        }
    }

}