<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_model extends MY_Model {

    public $table = 'discount';


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field'     => 'title_discount',
                'label'     => 'Title of Discount',
                'rules'     => 'required|trim'
            ],

            [
                'field'     => 'value',
                'label'     => 'Value',
                'rules'     => 'required|trim|numeric'
            ],

            [
                'field'     => 'tgl_start',
                'label'     => 'Start From',
                'rules'     => 'required|trim'
            ],

            [
                'field'     => 'tgl_end',
                'label'     => 'End Period',
                'rules'     => 'required|trim'
            ],
        ];

        return $validationRules;
    }
}

/* End of file Discount_model.php */
