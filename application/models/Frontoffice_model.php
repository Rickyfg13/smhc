<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Frontoffice_model extends MY_Model
{

    public $table = 'customer';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|trim',
            ],
            [
                'field' => 'birth_date',
                'label' => 'Birth Date',
                'rules' => 'required|trim'
            ],
            [
                'field' => 'identity_number',
                'label' => 'Identity Number',
                'rules' => 'required|trim',
            ],

            [
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'required|trim|numeric',
            ],

            [
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'valid_email|trim',
            ],


            [
                'field' => 'job',
                'label' => 'Job',
                'rules' => 'required|trim',
            ],

            [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required|trim',
            ],

        ];


        return $validationRules;
    }
}

/* End of file Frontoffice_model.php */
