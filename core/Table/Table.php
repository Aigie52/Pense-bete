<?php

namespace Core\Table;

use Core\Database\Database;

class Table
{
    protected $table;
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
        }
    }

    /**
     * Sélectionne tous les éléments d'une table
     * @return mixed
     */
    public function selectAll()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }

    /**
     * Sélectionne un élément d'une table à partir de son id
     * @param $id
     * @return mixed
     */
    public function selectOne($id)
    {
        return $this->query("
            SELECT *
            FROM " . $this->table . "
            WHERE id = ?", [$id], true);
    }

    /**
     * Prépare les requêtes
     * @param $statement
     * @param null $attributes
     * @param bool $one
     * @return mixed
     */
    public function query($statement, $attributes = null, $one = false)
    {
        if ($attributes) {
            return $this->db->prepare(
                $statement,
                $attributes,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        } else {
            return $this->db->query(
                $statement,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        }
    }

    public function update($id, $fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(', ', $sql_parts);
        return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes, true);
    }

    public function insert($fields){
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $k => $v){
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(', ', $sql_parts);
        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }

    public function listElem($key, $value){
        $records = $this->selectAll();
        $return = [];
        foreach($records as $v){
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function delete($id){
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }

    public function countItems(){
        return $this->db->count("SELECT COUNT(*) AS nbre FROM {$this->table}");
    }
}