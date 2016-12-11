<?php
namespace Core\HTML;
/**
 * Class Form
 * Permet de générer les formulaires
 */

class Form
{

    /**
     * @var array Données utilisées par le formulaire
     */
    private $data;

    /**
     * Form constructor.
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    protected function getValue($index)
    {
        if (is_object($this->data)) {
            return $this->data->$index;
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }

    /**
     * Création des labels
     * @param $name string
     * @param $label string Texte du label, ne pas indiquer si pas de label
     * @return string
     */
    protected function creaLabel($name, $label)
    {
        if (!is_null($label)) {
            $label = '<label for="' . $name . '">' . $label . '</label>';
        }
        return $label;
    }

    /**
     * Création des input
     * @param $name string Nom du champ
     * @param $type string Type d'input
     * @return string
     */
    public function creaInput($name, $type, $label = null)
    {
        if ($type === 'date' && !is_null($this->getValue($name))) {
            $value = date('Y-m-d', strtotime($this->getValue($name)));
        } else {
            $value = $this->getValue($name);
        }
        $label = $this->creaLabel($name, $label);
        return $label . '<input type="' . $type . '" id="' . $name . '" name="' . $name . '" value = "' . $value . '" class="form-control">';
    }

    /**
     * Création des textarea
     * @param $name string Nom du champ
     * @param $rows int Nbre de lignes
     * @return string
     */
    public function creaTextarea($name, $rows, $label = null)
    {
        $label = $this->creaLabel($name, $label);
        return $label . '<textarea id="' . $name . '" name="' . $name . '" class="form-control" rows="' . $rows . '">' . $this->getValue($name) . '</textarea>';
    }

    /**
     * Création des boutons submit
     * @return string
     */
    public function creaSubmit($value)
    {
        return '<input type="Submit" id="submit" value="' . $value . '" class="btn btn-default">';
    }

    /**
     * Création des select
     * @param $name
     * @param $label
     * @param $options
     * @return string
     */
    public function select($name, $label, $options)
    {
        $label = $this->creaLabel($name, $label);
        $input = $label . '<select class="form-control" name=' . $name . '>';

        foreach ($options as $k => $v) {
            $attributes = '';
            if ($v == $this->getValue($name)) {
                $attributes = 'selected';
            }
            $input .= '<option value="' . $k . '"' . $attributes . '>' . $v . '</option>';
        }
        $input .= '</select>';
        return $input;
    }
}