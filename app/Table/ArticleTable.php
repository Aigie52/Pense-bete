<?php
/**
 * Created by PhpStorm.
 * User: Aurore
 * Date: 08/05/2016
 * Time: 14:49
 */

namespace App\Table;


use Core\Table\Table;

class ArticleTable extends Table
{
    /**
     * Sélectionne tous les articles
     * @return mixed
     */
    public function selectAll()
    {
        return $this->query("
            SELECT *
            FROM articles 
            LEFT JOIN categories ON articles.categorie_id = categories.id 
            ORDER BY dateMsg DESC");
    }

    /**
     * Sélectionne un seul article
     * @param $id
     * @return mixed
     */
    public function selectOne($id)
    {
        return $this->query("
            SELECT *
            FROM articles
            LEFT JOIN categories ON articles.categorie_id = categories.id 
            WHERE articles.idMsg = ?
        ", [$id], true);
    }

    /**
     * Sélectionne tous les articles de la catégorie demandée
     * @param $id
     * @return mixed
     */
    public function selectAllByCategorie($id)
    {
        return $this->query("
            SELECT *
            FROM articles
            WHERE categorie_id = ?
            ORDER BY dateMsg DESC
        ", [$id]);
    }

    public function update($id, $fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        return $this->query("UPDATE {$this->table} SET $sql_part WHERE idMsg = ?", $attributes, true);
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE idMsg = ?", [$id], true);
    }

    public function countItemsByCategory($id)
    {
        return $this->db->count("
            SELECT COUNT(*) AS nbre
            FROM articles
            WHERE categorie_id = ?
            ", [$id]);
    }

    public function selectWithPagination($msgDebut)
    {
        return $this->db->querySpecial("
          SELECT * 
          FROM articles 
          LEFT JOIN categories ON articles.categorie_id = categories.id 
          ORDER BY dateMsg 
          DESC LIMIT :msgDebut, 5",
            $msgDebut, str_replace('Table', 'Entity', get_class($this)));
    }
    
    
}