<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Therapist_model extends MY_Model
{

    public $table = 'therapist';
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
                'rules' => 'required|trim|valid_email',
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

/* End of file Therapist_model.php */
