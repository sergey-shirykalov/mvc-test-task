<?php

namespace Core;

use ErrorException;

/**
* Главный класс приложения
*
* @return void
*/

class App
{
    /**
     * Запуск приложения
     *
     * @throws ErrorException
     */
     public static function run()
     {

         // инициализируем сессию
         session_start();

         // контроллер и действие по умолчанию
         $controller = 'import';
         $action = 'index';

         // Получаем URL запроса
         $path = $_SERVER['REQUEST_URI'];
         // Разбиваем URL на части
         $pathParts = explode('/', $path);
         // Получаем имя контроллера
         if (!empty($pathParts[1])) {
             $controller = $pathParts[1];
         }
         // Получаем имя действия
         if (!empty($pathParts[2])) {
             $action = $pathParts[2];
         }
         // Формируем пространство имен для контроллера
         $controller = 'Controllers\\' . ucfirst($controller) . 'Controller';
         // Формируем наименование действия
         $action = 'action' . ucfirst($action);

         // Если класса не существует, выбрасываем исключение
         if (!class_exists($controller)) {
             throw new ErrorException('Controller '.$controller.' does not exist');
         }

         // Создаем экземпляр класса контроллера
         $objController = new $controller;

         // Если действия у контроллера не существует, выбрасываем исключение
         if (!method_exists($objController, $action)) {
             throw new ErrorException('action does not exist');
         }

         // Вызываем действие контроллера
         $objController->$action();
     }

    /**
     * Страница ошибки 404
     */
    public static function errorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'page404');
    }

}