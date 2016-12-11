<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 08/05/2016
 * Time: 22:17
 */

namespace App\Table;


use Core\Table\Table;

class CommentaireTable extends Table
{
    public function selectAllByPost($id)
    {
        return $this->query("
            SELECT *
            FROM commentaires
            LEFT JOIN articles ON commentaires.article_associe = articles.idMsg
            WHERE article_associe = ?
            ORDER BY dateComm DESC
        ", [$id]);
    }

    public function countItemsByPost($idMsg){
        return $this->db->count("
            SELECT COUNT(*) AS nbre
            FROM commentaires
            WHERE article_associe = ?
            ", [$idMsg]);
    }

    public function deleteWithArticle($idMsg){
        return $this->query("DELETE FROM commentaires WHERE article_associe = ?", [$idMsg], true);
    }
    
}