<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends MY_Model
{

    public $table   = 'doctor';
    public $perPage = 10;

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
                'field' => 'idi_number',
                'label' => 'IDI Number',
                'rules' => 'required|trim',
            ],

            [
                'field' => 'sip_number',
                'label' => 'SIP Number',
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

    public function getValidationRulesChangePass()
    {
        $validationRules = [
            [
                'field' => 'old_password',
                'label' => 'Old Password',
                'rules' => 'required',
            ],
            [
                'field' => 'new_password',
                'label' => 'New Password',
                'rules' => 'required|min_length[8]'
            ],
            [
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[new_password]',
            ],



        ];


        return $validationRules;
    }
}

/* End of file Home_model.php */
