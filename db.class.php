<?php 

namespace Systrio;

use PDO;

class Database
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $pdo;

    /**
     * Class constructor.
     */
    public function __construct($db_host = 'localhost', $db_name = 'widget', $db_user = 'widget', $db_pass = '1$9Zyjk0')
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->getPdo();
    }

    /**
     * @return PDO
     */
    private function getPdo()
    {
        if ($this->pdo === null) {
            $pdo = new PDO("mysql:dbname=$this->db_name;host=$this->db_host", "$this->db_user", "$this->db_pass");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $one = false)
    {
        $req = $this->getPdo()->query($statement);

        $req->setFetchMode(PDO::FETCH_OBJ);

        if ($one) {
            $data = $req->fetch();
        }else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    public function save($tableName, $sql, $values, $one = false)
    {
        $req = $this->getPdo()->prepare("INSERT INTO $tableName SET $sql");
        $res = $req->execute($values);

        return $res;
    }

    public function delete($tableName, $sql, $values)
    {
        $req = $this->getPdo()->prepare("DELETE FROM $tableName WHERE $sql");
        $res = $req->execute($values);

        return $res;
    }

    public function lastInsertId()
    {
        return $this->getPdo()->lastInsertId();
    }
}