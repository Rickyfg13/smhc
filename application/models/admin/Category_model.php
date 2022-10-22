<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends MY_Model
{

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }
}

/* End of file Category_model.php */
