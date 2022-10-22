<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends MY_Model
{

    public $table = 'user';

    public function getDefaultValues()
    {
        return [
            'username'     =>  '',
            'password'     =>  '',
            'remember_me'  =>  '',
        ];
    }

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
        ];

        return $validationRules;
    }

    public function run($input)
    {
        $query  = $this->where('username', strtolower($input->username))
            ->where('is_active', 1)
            ->first();

        if (!$query) {
            $this->session->set_flashdata('warning', 'Account not found, please contact admin.');
        }

        if (!empty($query) && hashEncryptVerify($input->password, $query->password)) {
            if ($query->id_doctor != null) {
                $id_doctor = $query->id_doctor;
                $this->table = 'schedule';
                $id_store_doctor = $this->select(['id_store'])->where('id_doctor', $id_doctor)->where('day_name', date('l'))->first();

                $sess_data = [
                    'id'           => $query->id,
                    'id_doctor'    => $query->id_doctor,
                    'name'         => $query->name,
                    'username'     => $query->username,
                    'role'         => $query->role,
                    'id_store'     => $id_store_doctor->id_store == '' ? $query->id_store : $id_store_doctor->id_store,
                    'is_login'     => true,
                ];
            } else {
                $sess_data = [
                    'id'           => $query->id,
                    'id_doctor'    => $query->id_doctor,
                    'name'         => $query->name,
                    'username'     => $query->username,
                    'role'         => $query->role,
                    'id_store'     => $query->id_store,
                    'is_login'     => true,
                ];
            }
            // if ($query->id_doctor == 'DOC-210824112140406') {
            //     $sess_data = [
            //         'id'           => $query->id,
            //         'id_doctor'    => $query->id_doctor,
            //         'name'         => $query->name,
            //         'username'     => $query->username,
            //         'role'         => $query->role,
            //         'id_store'     => date('l') == 'Tuesday' ? 2 : 1,
            //         'is_login'     => true,
            //     ];
            // } else {
            //     $sess_data = [
            //         'id'           => $query->id,
            //         'id_doctor'    => $query->id_doctor,
            //         'name'         => $query->name,
            //         'username'     => $query->username,
            //         'role'         => $query->role,
            //         'id_store'     => $query->id_store,
            //         'is_login'     => true,
            //     ];
            // }





            $this->session->set_userdata($sess_data);

            return true;
        }
        return false;
    }
}

/* End of file Login_model.php */
