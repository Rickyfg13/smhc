<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends MY_Model {

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'     => 'store_name',
                'label'     => 'Store Name',
                'rules'     => 'required|trim'
            ],

            [
                'field'     => 'store_phone',
                'label'     => 'Store Name',
                'rules'     => 'required|numeric|trim'
            ],

            [
                'field'     => 'store_address',
                'label'     => 'Store Address',
                'rules'     => 'required|trim'
            ],
        ];

        return $validationRules;
    }

}

/* End of file Store_model.php */
