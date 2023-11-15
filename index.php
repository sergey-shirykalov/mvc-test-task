<?php

//require_once __DIR__ . '/Core/App.php';
//require_once __DIR__ . '/Core/View.php';
//require_once __DIR__ . '/Controllers/ImportController.php';
//require_once __DIR__ . '/Controllers/Page404Controller.php';

// Подключаем автозагрузку
require_once __DIR__ . '/Core/autoload.php';

try {
    Core\App::run();
} catch (ErrorException $e) {
    Core\App::errorPage404();
}


