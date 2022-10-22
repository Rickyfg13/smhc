<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $model = strtolower(get_class($this));
        if (file_exists(APPPATH . 'models/' . $model . '_model.php')) {
            $this->load->model($model . '_model', $model, true);
        } else if(file_exists(APPPATH . 'models/admin/' . $model . '_model.php')) {
            $this->load->model('admin/' . $model . '_model', $model, true);
        } else if (file_exists(APPPATH . 'models/doctor/' . $model . '_model.php')) {
            $this->load->model('doctor/' . $model . '_model', $model, true);
        }else {
            $this->load->model('auth/' . $model . '_model', $model, true);
        }
    }

    /**
     * Load view with default layouts
     * 
     * @param [type] $data
     * @return void
     */
    public function view($data)
    {
        $this->load->view('layouts/app', $data);
    }

    /**
     * Load view with default layouts
     * 
     * @param [type] $data
     * @return void
     */
    public function view_cashier($data)
    {
        $this->load->view('layouts/cashier/app', $data);
    }

    /**
     * Load logi view with default layouts
     * 
     * @param [type] $data
     * @return void
     */
    public function view_auth($data)
    {
        $this->load->view('auth/app', $data);
    }

    /**
     * Load logi view with default layouts
     * 
     * @param [type] $data
     * @return void
     */
    public function view_doctor($data)
    {
        $this->load->view('layouts/doctor/app', $data);
    }
}

/* End of file MY_Controller.php */
