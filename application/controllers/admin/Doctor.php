<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Doctor extends MY_Controller
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
        $data['content']        = $this->doctor->get();
        $data['title']          = 'Doctor';
        $data['page_title']     = 'Doctor - Doctor List - Admin';
        $data['nav_title']      = 'data_staff';
        $data['detail_title']   = 'doctor';
        $data['page']           = 'pages/admin/doctor/index';

        $this->view($data);
    }

    public function loadTable()
    {
        $data['content']        = $this->doctor->orderBy('doctor.created_at', 'DESC')->get();
        $this->load->view('pages/admin/doctor/data/table', $data);
    }

    public function insert()
    {
        $id                 = $this->generate_code();
        $name               = $this->input->post('name', true);
        $birth_date         = $this->input->post('birth_date', true);
        $identity_number    = $this->input->post('identity_number', true);
        $idi_number         = $this->input->post('idi_number', true);
        $sip_number         = $this->input->post('sip_number', true);
        $phone              = $this->input->post('phone', true);
        $email              = $this->input->post('email', true);
        $address            = $this->input->post('address', true);

        if (!$this->doctor->validate()) {
            $arr = array(
                'error'                 => true,
                'statusCode'            => 400,
                'name_error'            => form_error('name'),
                'birth_date_error'      => form_error('birth_date'),
                'identity_number_error' => form_error('identity_number'),
                'idi_number_error'      => form_error('idi_number'),
                'sip_number_error'      => form_error('sip_number'),
                'phone_error'           => form_error('phone'),
                'email_error'           => form_error('email'),
                'address_error'         => form_error('address'),
            );

            echo json_encode($arr);
        } else {
            $data = array(
                'id'    => $id,
                'name'  => 'dr ' . $name,
                'address'   => $address,
                'birth_date' => DateTime::createFromFormat('d/m/Y', $birth_date)->format('Y-m-d'),
                'identity_number'   => $identity_number,
                'idi_number'        => $idi_number,
                'sip_number'        => $sip_number,
                'phone'            => $phone,
                'email'             => $email,
            );

            if ($this->doctor->add($data) == true) {
                $this->session->set_flashdata('success', 'Data has been added!');

                $data_doctor_to_user = array(
                    'id_doctor'     => $id,
                    'name'          => $name,
                    'username'      => $email,
                    'password'      => hashEncrypt('hersclinic.id'),
                    'role'          => 'doctor',
                    'is_active'     => 1,
                    'id_store'      => $this->session->userdata('id_store')

                );

                //add data to table user
                $this->doctor->table = 'user';
                $this->doctor->add($data_doctor_to_user);

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

        $code = 'DOC-' . date('ymdhis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        return $code;
    }

    public function date_format()
    {

        $delimiter = "/";

        $birth_date = $this->input->post('birth_date');



        if ($birth_date) {
            if (strpos($birth_date, $delimiter) == false && substr_count($birth_date, $delimiter) != 2) {
                $this->load->library('form_validation');
                $this->form_validation->set_message('date_format', '%s does not fit the format');
                return false;
            } else {
                return true;
            }
        }

        return true;
    }

    public function edit($id)
    {
        $data['title']       = 'Edit Doctor Data';
        $data['getDoctor']   = $this->doctor->where('id', $id)->first();

        $this->output->set_output(show_my_modal('pages/admin/doctor/modal/modal_edit_doctor', 'modal-edit-doctor', $data, 'lg'));
    }

    public function update()
    {
        $id                 = $this->input->post('id', true);
        $name               = $this->input->post('name', true);
        $birth_date         = $this->input->post('birth_date', true);
        $identity_number    = $this->input->post('identity_number', true);
        $idi_number         = $this->input->post('idi_number', true);
        $sip_number         = $this->input->post('sip_number', true);
        $phone              = $this->input->post('phone', true);
        $email              = $this->input->post('email', true);
        $address            = $this->input->post('address', true);

        if (!$this->doctor->validate()) {
            $arr = array(
                'error'                 => true,
                'statusCode'            => 400,
                'name_error'            => form_error('name'),
                'birth_date_error'      => form_error('birth_date'),
                'identity_number_error' => form_error('identity_number'),
                'idi_number_error'      => form_error('idi_number'),
                'sip_number_error'      => form_error('sip_number'),
                'phone_error'           => form_error('phone'),
                'email_error'           => form_error('email'),
                'address_error'         => form_error('address'),
            );

            echo json_encode($arr);
        } else {
            $data = array(
                'name'  => $name,
                'address'   => $address,
                'birth_date' => DateTime::createFromFormat('d/m/Y', $birth_date)->format('Y-m-d'),
                'identity_number'   => $identity_number,
                'idi_number'        => $idi_number,
                'sip_number'        => $sip_number,
                'phone'            => $phone,
                'email'             => $email,
            );

            if ($this->doctor->where('doctor.id', $id)->update($data) == true) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                echo json_encode(array('statusCode' => 200));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array('statusCode' => 201));
            }
        }
    }

    public function destroy($id)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->doctor->where('id', $id)->delete()) {
                $this->session->set_flashdata('success', 'Data has been deleted!');
                echo json_encode(array(
                    "statusCode" => 200,

                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        } else {
            echo '<h3>FORBIDDEN</h3>';
        }
    }

    
}

/* End of file Doctor.php */
