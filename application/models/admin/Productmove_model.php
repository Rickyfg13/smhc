<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Productmove_model extends MY_Model
{

    public $table = 'product_move';


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_store',
                'label' => 'Store',
                'rules' => 'required'
            ],

            [
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|trim|numeric'
            ]

        ];

        return $validationRules;
    }
}

/* End of file Productmove_model.php */
