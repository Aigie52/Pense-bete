<?php
namespace App\Entity;

use \Core\Entity\Entity;

class ArticleEntity extends Entity
{
    public $parts;

    public function getUrl()
    {
        return 'index.php?page=articles.single&id=' . $this->idMsg;
    }

    public function getExtrait()
    {
        if(strlen($this->message)>=300)
        {
            $this->message=substr($this->message,0,300);
            $mot=str_word_count($this->message, 1);
            foreach($mot as $key => $mots)
            {
                if($key<50)
                {
                    $this->parts .= $mots.' ';
                }
            }
        } else {
            $this->parts = $this->message . ' ';
        }
        $html = '<p>' . $this->parts . '...</p>';
        $html .= '<p><a href="' . $this->getUrl() . '">Lire la suite ></a></p>';
        return $html;
    }
}