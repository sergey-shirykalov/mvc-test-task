<?php

namespace Controllers;

use Core\Controller;
use Core\View;

/**
 * Контроллер отвечает за вывод страницы ошибки 404
 */
class Page404Controller extends Controller
{
    public function actionIndex()
    {
        // Рендер страницы импорта
        View::render('page404View');
    }

}