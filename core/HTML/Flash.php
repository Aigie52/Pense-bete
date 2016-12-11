<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 13/05/2016
 * Time: 13:13
 */

namespace Core\HTML;

class Flash
{
    public function setFlash($type, $message, $class)
    {
        $_SESSION['flash'] = array(
            'type' => $type,
            'message' => $message,
            'class' => $class
        );
    }

    public function flash()
    {
        
        if (isset($_SESSION['flash'])) {
            echo '<div id="alert" role="alert" class="' . $_SESSION['flash']['class'] . ' alert fadeout-message">' . $_SESSION['flash']['message'] . '</div>';
            unset($_SESSION['flash']);
        }
    }
}