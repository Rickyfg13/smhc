<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Libraries_model extends MY_Model {

    public $table = 'product_in';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'id_product_in',
                'label' => 'Product',
                'rules' => 'required'
            ],

            [
                'field' => 'stock_in',
                'label' => 'Stock In',
                'rules' => 'required|trim|numeric'
            ]

        ];

        return $validationRules;
    }
}

/* End of file Libraries_model.php */
