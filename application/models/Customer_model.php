<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends MY_Model
{

    public $table = 'customer';
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required|numeric|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Customer_model.php */
