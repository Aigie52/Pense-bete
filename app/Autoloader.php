<?php
namespace App;

/**
 * Class Autoloader
 * Permet de charger les classes utilisées
 */
class Autoloader
{
    /**
     * Evite les conflits avec d'autres autoloaders
     */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Autoload des classes
     * @param $class_name
     */
    public static function autoload($class_name)
    {
        if (strpos($class_name, __NAMESPACE__ . '\\') === 0) {
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
            require __DIR__ . '/' . $class_name . '.php';
        }
    }

}