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
    public function __construct($db_host = 'localhost', $db_name = '', $db_user = 'root', $db_pass = '')
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
        
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }

        $req->setFetchMode(PDO::FETCH_OBJ);

        if ($one) {
            $data = $req->fetch();
        }else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    public function save($statement, $values, $one = false)
    {
        $req = $this->getPdo()->prepare($statement);
        $res = $req->execute($values);

        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }
        $req->setFetchMode(PDO::FETCH_OBJ);

        if ($one) {
            $data = $req->fetch();
        }else {
            $data = $req->fetchAll();
        }

        return $data;
    }

    public function lastInsertId()
    {
        return $this->getPdo()->lastInsertId();
    }
}