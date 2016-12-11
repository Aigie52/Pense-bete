<?php
namespace Core\Database;

use \PDO;
use \Exception;

/**
 * Class Database
 */
class MySQLDatabase extends Database
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $bdd;

    public function __construct($db_name, $db_host, $db_user, $db_pass)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    /**
     * Connexion à la bdd
     * @return PDO
     */
    private function getPDO()
    {
        if ($this->bdd === null) {
            try {
                $bdd = new PDO('mysql:host=localhost; dbname=pense_beteV2; charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $this->bdd = $bdd;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->bdd;
    }

    /**
     * Méthode query
     * @param $statement
     * @param null $class_name
     * @param bool $one
     * @return array|mixed
     */
    public function query($statement, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->query($statement);

        if (strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }

        if (is_null($class_name)) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    /**
     * Méthode prepare
     * @param $statement
     * @param $attributes
     * @param null $class_name
     * @param bool $one
     * @return array|mixed
     */
    public function prepare($statement, $attributes, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        if (strpos($statement, 'COUNT') === 1) {
            $req->bindParam(':msgDebut', $attributes, PDO::PARAM_INT);
        }
        $res = $req->execute($attributes);
        if (strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }

        if (is_null($class_name)) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
    }

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }

    public function count($statement, $attributes = null)
    {
        if ($attributes) {
            $req = $this->getPDO()->prepare($statement);
            $req->execute($attributes);
            $data = $req->fetch();
        } else {
            $req = $this->getPDO()->query($statement);
            $data = $req->fetch();
        }
        return $data['nbre'];
    }

    public function querySpecial($statement, $attributes, $class_name = null, $one = false)
    {
        $req = $this->getPDO()->prepare($statement);
        $req->bindParam(':msgDebut', $attributes, PDO::PARAM_INT);
        $req->execute();
        if (is_null($class_name)) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }
        return $data;
    }
}