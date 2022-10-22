<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function index()
    {
        //data yg diperlukan untuk di unset
        $sess_data = [
            'id', 'id_doctor', 'name', 'username', 'role', 'id_store', 'is_login'
        ];

        //unset data sesuai $sess_data
        $this->session->unset_userdata($sess_data);


        //hancurkan session
        $this->session->sess_destroy();

        //hancurkan cookie
        delete_cookie('login');

        //direct ke halama utama
        redirect(base_url() . 'auth/login');
    }
}

/* End of file Logout.php */
