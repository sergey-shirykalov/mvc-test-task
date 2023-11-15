<?php

namespace Models;

use Core\DB;
use Core\Model;

/**
 * Класс модели пользователи
 */
class Users extends Model
{
    /**
     * Проверка пользователя и пароля
     * @param string $user
     * @param string $pass
     * @return bool|int
     */
    public static function check(string $user, string $pass) {
        // проверяем наличие пользователя с указанным именем
        $db = DB::getInstance();
        $res = $db->query("SELECT * FROM `users` WHERE `username` = :username", ['username'=>$user]);
        if (empty($res)) {
            // пользователь не найден
            return false;
        }

        // проверяем пароль, в БД хранится хеш MD5
        if ( md5($pass) == $res[0]['password']){
            // хеши паролей совпадают, возвращаем id пользователя
            return $res[0]['id']; // user id
        }

        return false;
    }

    /**
     * Проверка, зарегистрирован уже пользователь в системе или нет
     * @return bool
     */
    public static function is_auth(): bool {
        return isset($_SESSION['user_id']);
    }

}