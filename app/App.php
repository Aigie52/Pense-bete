<?php
use Core\Config;
use Core\Database\MySQLDatabase;

/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 07/05/2016
 * Time: 22:55
 */
//Factory

class App
{
    private static $_instance;
    private $db_instance;
    public $titrePage = 'Pense-bête';

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        session_start();
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();
    }

    /**
     * Récupère le nom de la table
     * @param $name
     * @return mixed
     */
    public function getTable($name)
    {
        $class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDb());
    }

    /**
     * Récupère la connexion à la bdd
     * @return MySQLDatabase
     */
    public function getDb()
    {
        $config = Config::getInstance(ROOT . '/config/config.php');
        if (is_null($this->db_instance)) {
            $this->db_instance = new MySQLDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }

    public static function redirect($redirection){
        header('Location: ?page=' . $redirection);
    }
}