<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();



        $is_login   = $this->session->userdata('is_login');
        $role = $this->session->userdata('role');

        if ($is_login) {

            if ($role == 'admin') {
                redirect(base_url() . 'admin');
                return;
            } else if ($role == 'doctor') {
                redirect(base_url() . 'doctor');
            } else if ($role == 'front_officer') {
                redirect(base_url() . 'front-office');
            } else if ($role == 'admin_store') {
                redirect(base_url() . 'admin/inventory');
                return;
            } else if ($role == 'finance') {
                redirect(base_url() . 'admin');
            }else {
                redirect(base_url('cashier'));
            }
        }
    }

    public function index()
    {
        //pengecekan ketika request dilakukan melalui method post atau tidak
        if (!$_POST) {
            $input = (object) $this->login->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        //proses validasi form login
        if (!$this->login->validate()) {

            $data['input'] = $input;
            $data['page']  = 'auth/login';


            $this->view_auth($data);
            return;
        }

        //jika login berhasil maka akan direct ke halaman admin(jika admin) atau ke halaman depan(jika user)
        if ($this->login->run($input)) {
            $this->session->set_flashdata('success', 'Login Has Been Successful');


            // if ($input->remember_me == "on") {
            //     // set cookie ketika berhasil login
            //     set_cookie('login', (string) $input->username, 120);
            // }

            if ($this->session->userdata('role') == 'admin') {
                redirect(base_url() . 'admin');
            } else {
                redirect(base_url('cashier'));
            }


            //echo isset($input->remember_me) ? $input->remember_me : "off";
        } else { //jika proses login gagal maka direct ke halaman login lagi
            $this->session->set_flashdata('error', 'Username and Password is not correct');
            redirect(base_url() . 'auth/login');
        }
    }
}

/* End of file Login.php */
