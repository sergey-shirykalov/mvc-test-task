<?php

namespace Models;

use Core\DB;
use Core\Model;
use PDOException;

/**
 * Класс модели владельцев домашних питомцев
 */
class PetOwners extends Model
{

    /**
     * Загрузка данных из файла XML в БД
     * @throws \Exception
     */
    public function loadData(){

        if(!empty($_FILES)) {

            $uploadFile = $_FILES['file_to_load'];
            $data_filename = $uploadFile['name'];
            $tmp_name = $uploadFile['tmp_name'];
            if (!is_uploaded_file($tmp_name)) {
                throw new \Exception('Ошибка при загрузке файла ' . $data_filename);
            }

            // получаем объект базы данных
            $db = DB::getInstance();

            // начинаем парсинг XML файла с помощью SimpleXML и загрузку в БД
            $users = simplexml_load_file($tmp_name);
            foreach ($users as $user){
                $db->beginTransaction();
                try {
                    $owner_id = $db->simpleInsert('owners', 'fio', $user['Name']);
                    foreach ($user->Pets->Pet as $pet){
                        $pet_type_id = $db->simpleInsert('pet_types', 'name', $pet['Type']);
                        $breed_id = $db->simpleInsert('breeds', 'name', $pet->Breed['Name']);
                        $db->query("INSERT INTO pets 
                                        (id, type_id, gender, nickname, age, breed_id, owner_id) 
                                        VALUES (?,?,?,?,?,?,?) 
                                        ON DUPLICATE KEY UPDATE nickname = nickname
                                        ", [$pet['Code'], $pet_type_id, $pet['Gender'], $pet->Nickname['Value'], $pet['Age'], $breed_id, $owner_id] );

                        $pet_id = $pet['Code'];
                        foreach ($pet->Parents->Parent as $parent){
                            $db->query("INSERT INTO parents (id_parent, id_child) VALUES (?,?)
                                        ON DUPLICATE KEY UPDATE id_parent = id_parent", [$parent['Code'], $pet_id]);
                        }
                        foreach ($pet->Rewards->Reward as $reward){
                            $db->query("INSERT INTO rewards (pet_id, name) VALUES (?,?)
                                    ON DUPLICATE KEY UPDATE name = name", [$pet_id, $reward['Name']]);
                        }
                    }
                    $db->commit();
                } catch (PDOException $e){
                    $db->rollBack();
                    throw new \Exception('Ошибка при записи в БД.');
                }

            }

        } else {
            throw new \Exception('Ошибка при загрузке файла.');
        }

    }

    /**
     * Возвращает нужные нам данные - массив владельцев, у которых питомцы старше 3 лет
     * @return array|null
     */
    public function getData(){

        $db = DB::getInstance();

        $sql = "SELECT DISTINCT fio FROM owners 
                JOIN pets ON owners.id = pets.owner_id
                WHERE age > 3";
        return $db->query($sql);

    }
}