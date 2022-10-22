<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Therapist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }

    public function index()
    {
        $data['title']               = 'Therapist';
        $data['page_title']          = 'Therapist - Therapist List - Admin';
        $data['nav_title']           = 'data_staff';
        $data['detail_title']        = 'therapist';
        $data['page']                = 'pages/admin/therapist/index';

        $this->view($data);
    }

    public function loadTable()
    {
        $data['content']             = $this->therapist->orderBy('therapist.created_at', 'DESC')->get();
        $this->load->view('pages/admin/therapist/data/table', $data);
    }

    public function insert()
    {
        $id                 = $this->generate_code();
        $name               = $this->input->post('name', true);
        $birth_date         = $this->input->post('birth_date', true);
        $identity_number    = $this->input->post('identity_number', true);
        $phone              = $this->input->post('phone', true);
        $email              = $this->input->post('email', true);
        $address            = $this->input->post('address', true);


        if (!$this->therapist->validate()) {
            $arr = array(
                'error'                           => true,
                'statusCode'                      => 400,
                'name_therapist_error'            => form_error('name'),
                'birth_date_therapist_error'      => form_error('birth_date'),
                'identity_number_therapist_error' => form_error('identity_number'),
                'phone_therapist_error'           => form_error('phone'),
                'email_therapist_error'           => form_error('email'),
                'address_therapist_error'         => form_error('address'),
            );

            echo json_encode($arr);
        } else {
            $data       = array(
                'id'                => $id,
                'name'              => $name,
                'address'           => $address,
                'birth_date'        => DateTime::createFromFormat('d/m/Y', $birth_date)->format('Y-m-d'),
                'identity_number'   => $identity_number,
                'phone'             => $phone,
                'email'             => $email,
            );

            if ($this->therapist->add($data) == true) {
                $this->session->set_flashdata('success', 'Data Has Been added!');

                $data_therapist_to_user = array(
                    'id_therapist'  => $id,
                    'name'          => $name,
                    'username'      => $email,
                    'password'      => hashEncrypt('hersclinic.id'),
                    'role'          => 'therapist',
                    'is_active'     => 1,
                    'id_store'      => $this->session->userdata('id_store')

                );

                //add data to table user
                $this->therapist->table = 'user';
                $this->therapist->add($data_therapist_to_user);

                echo json_encode(array(
                    'statusCode'    => 200
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');

                echo json_encode(array(
                    'statusCode'    => 201
                ));
            }
        }
    }

    public function generate_code()
    {
        $digits = 3;

        $code = 'TRP-' . date('ymdhis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        return $code;
    }

    public function edit($id)
    {
        $data['title']          = 'Edit Therapist Data';
        $data['getTherapist']   = $this->therapist->where('id', $id)->first();

        $this->output->set_output(show_my_modal('pages/admin/therapist/modal/modal_edit_therapist', 'modal-edit-therapist', $data, 'lg'));
    }


    public function update()
    {
        $id                 = $this->input->post('id', true);
        $name               = $this->input->post('name', true);
        $birth_date         = $this->input->post('birth_date', true);
        $identity_number    = $this->input->post('identity_number', true);
        $phone              = $this->input->post('phone', true);
        $email              = $this->input->post('email', true);
        $address            = $this->input->post('address', true);

        if (!$this->therapist->validate()) {
            $arr = [
                'error'                           => true,
                'statusCode'                      => 400,
                'name_therapist_error'            => form_error('name'),
                'birth_date_therapist_error'      => form_error('birth_date'),
                'identity_number_therapist_error' => form_error('identity_number'),
                'phone_therapist_error'           => form_error('phone'),
                'email_therapist_error'           => form_error('email'),
                'address_therapist_error'         => form_error('address'),
            ];

            echo json_encode($arr);
        } else {
            $data   = array(
                'name'              => $name,
                'address'           => $address,
                'birth_date'        => DateTime::createFromFormat('d/m/Y', $birth_date)->format('Y-m-d'),
                'identity_number'   => $identity_number,
                'phone'             => $phone,
                'email'             => $email,
            );

            if ($this->therapist->where('therapist.id', $id)->update($data)) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                echo json_encode(array('statusCode'     => 200));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array('statusCode' => 201));
            }
        }
    }
}

/* End of file Therapist.php */
