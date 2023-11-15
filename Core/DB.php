<?php

namespace Core;

class DB
{
    private static $instance;

    /** @var \PDO */
    private $pdo;

    private function __construct()
    {
        $dbOptions = include __DIR__ . '/config.php';

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['db_host'] . ';dbname=' . $dbOptions['db_name'],
            $dbOptions['db_user'],
            $dbOptions['db_pass']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, array $params = []): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Возвращает id заданного значения из заданной таблицы, если такого значения нет, то вставляет его в таблицу
     * @param string $table_name
     * @param string $field
     * @param $value
     * @return mixed
     */
    public function simpleInsert(string $table_name, string $field, $value)
    {

        $sql = "SELECT id FROM " . $table_name . " WHERE `" . $field . "` = :value LIMIT 1";
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute(['value' => $value]);

        if (false === $result) {
            return null;
        }

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            $this->query("INSERT INTO " . $table_name . " VALUES (NULL, '" . $value . "')");
            return $this->lastInsertId();
        } else {
            return $result[0]['id'];
        }
    }


    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}