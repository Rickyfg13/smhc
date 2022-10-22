<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'doctor' || $role == 'cashier') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }

    public function index()
    {
        $data['title']          = 'Doctor';
        $data['page_title']     = 'Doctor - Hers Clinic';
        $data['nav_title']      = 'doctor';
        $data['detail_title']   = 'doctor';

        $id = $this->session->userdata('id_doctor');
        $data['dataDoctor']     = $this->home->where('id', $id)->first();


        $this->home->table      = 'product';
        $data['dataTherapy']    = $this->home->where('id_store', $this->session->userdata('id_store'))
            ->where('id_category', '102001')->get();
        $data['page']           = 'pages/doctor/index';

        $this->view_doctor($data);
    }

    public function loadDataQueue($page = null, $perPage = null)
    {
        if ($perPage != null) {
            $this->home->perPage = $perPage;
        }

        $this->home->table = 'queue';
        $data['queue'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'waiting')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->orWhere('queue.status', 'on_consult')
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'waiting')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->orWhere('queue.status', 'on_consult')
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->count();

        $data['pagination']     = $this->home->makePagination(base_url() . 'doctor/home/loadDataQueue/', 4, $data['total_rows']);


        echo json_encode([
            'html'          => $this->load->view('pages/doctor/data/table_queue', $data, true),
            'pagination'    => $data['pagination']
        ]);

        //print_r($data['queue']);
        //$this->load->view('pages/doctor/data/table_queue', $data);
    }

    public function searchDataQueue($keyword, $page = null)
    {
        $this->home->table = 'queue';
        $data['queue'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'waiting')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->orWhere('queue.status', 'on_consult')
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->like('customer.name', urldecode($keyword))
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'waiting')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->orWhere('queue.status', 'on_consult')
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->like('customer.name', urldecode($keyword))
            ->count();

        $data['pagination'] = $this->home->makePagination(
            base_url() . 'doctor/home/searchDataQueue/' . urldecode($keyword) . '/',
            5,
            $data['total_rows']
        );

        echo json_encode([
            'html'      => $this->load->view('pages/doctor/data/table_queue', $data, true),
            'pagination' => $data['pagination']
        ]);
    }

    public function updateDataQueue()
    {
        $this->home->table = 'queue';
        $data['queue'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'waiting')
            ->orWhere('queue.status', 'on_consult')
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->join('customer')
            ->get();

        $i = 0;
        foreach ($data['queue'] as $row) {
            if ($i == 0) {
                if ($this->home->where('queue.id', $row->id)->update(
                    [
                        'status'    => 'on_consult'
                    ]
                )) {

                    echo json_encode(array(
                        'statusCode'    => 200
                    ));
                } else {
                    echo json_encode(array(
                        'statusCode'    => 201
                    ));
                }
            }

            $i++;
        }
    }

    public function loadDataQueueProgress($page = null, $perPage = null)
    {
        if ($perPage != null) {
            $this->home->perPage = $perPage;
        }


        $this->home->table = 'queue';
        $data['queue'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'on_progress')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->paginate($page)
            ->get();

        $data['total_rows'] = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'on_progress')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->count();

        $data['pagination'] = $this->home->makePagination(base_url() . 'doctor/home/loadDataQueueProgress/', 4, $data['total_rows']);


        echo json_encode([
            'html'      => $this->load->view('pages/doctor/data/table_queue_progress', $data, true),
            'pagination' => $data['pagination']
        ]);
    }

    public function searchDataQueueProgress($keyword, $page = null)
    {
        $this->home->table = 'queue';
        $data['queue']          = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'on_progress')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->like('customer.name', urldecode($keyword))
            ->paginate($page)
            ->get();

        $data['total_rows']     = $this->home->select([
            'queue.id', 'queue.id_customer', 'queue.status',
            'customer.name', 'customer.phone', 'queue.created_at'
        ])
            ->where('DATE(queue.created_at)', date('Y-m-d'))
            ->where('queue.status', 'on_progress')
            ->where('queue.id_store', $this->session->userdata('id_store'))
            ->join('customer')
            ->like('customer.name', urldecode($keyword))
            ->count();

        $data['pagination'] = $this->home->makePagination(
            base_url() . 'doctor/home/searchDataQueueProgress/' . urldecode($keyword) . '/',
            5,
            $data['total_rows']
        );

        echo json_encode([
            'html'      => $this->load->view('pages/doctor/data/table_queue_progress', $data, true),
            'pagination' => $data['pagination']
        ]);
    }

    public function updateToPaid($id_queue)
    {
        $this->home->table = 'queue';
        if ($this->input->is_ajax_request()) {
            $data = [
                'status'    => 'paid'
            ];

            if ($this->home->where('id', $id_queue)->update($data)) {
                $this->output->set_output(json_encode([
                    'statusCode'    => 200,
                    'msg'           => 'Patients has been added to payment!'
                ]));
            } else {
                $this->output->set_output(json_encode([
                    'statusCode'    => 201
                ]));
            }
        } else {
            echo '<h3>FORBIDDEN</h3>';
        }
    }

    public function show_modal_change_password()
    {
        $data['id_doctor'] = $this->session->userdata('id_doctor');
        $data['title']          = 'Change Password';

        $this->output->set_output(show_my_modal('pages/doctor/modal/modal_change_pass_doctor', 'modal-change-pass-doctor', $data, 'lg'));
    }

    public function change_pass_doctor()
    {
        $id_doctor              = $this->input->post('id_doctor', true);
        $old_password           = $this->input->post('old_password', true);
        $new_password           = $this->input->post('new_password', true);
        $confirm_password       = $this->input->post('confirm_password', true);

        if (!$this->home->validate_change_pass()) {
            $arr = array(
                'error'                     => true,
                'statusCode'                => 400,
                'old_password_error'        => form_error('old_password'),
                'new_password_error'        => form_error('new_password'),
                'confirm_password_error'    => form_error('confirm_password'),
            );

            echo json_encode($arr);
        } else {
            //ambil data password
            $this->home->table = 'user';
            $getOldPassDoctor = $this->home->select(['password'])
                ->where('id_doctor', $id_doctor)
                ->first();

            if (!empty($getOldPassDoctor) && hashEncryptVerify($old_password, $getOldPassDoctor->password)) {

                if ($this->home->where('id_doctor', $id_doctor)->update(['password'  => hashEncrypt($confirm_password)])) {
                    $this->session->set_flashdata('success', 'Your Password has been changed!');

                    echo json_encode([
                        'statusCode'        => 200,
                    ]);
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                    echo json_encode([
                        'statusCode'        => 201,
                    ]);
                }
            } else {
                $this->session->set_flashdata('error', 'Old Password is not correct!');
                echo json_encode([
                    'statusCode'        => 201,
                ]);
            }
        }
    }

    public function refresh_form_change_pass_doctor()
    {
        $data['id_doctor'] = $this->input->get('id_doctor', true);
        $this->load->view('pages/doctor/data/alert_notif', $data);
    }

    public function show_modal_profile()
    {
        $id_doctor = $this->input->get('id_doctor', true);
        $data['title']          = 'My Profile';
        $data['getDoctor']      = $this->doctor->where('id', $id_doctor)
            ->first();



        $this->output->set_output(show_my_modal('pages/doctor/modal/modal_profile_doctor', 'modal-profile-doctor', $data, 'lg'));
    }

    public function refresh_data_profile_doctor()
    {
        $id_doctor = $this->input->get('id_doctor', true);
        $data['getDoctor']      = $this->doctor->where('id', $id_doctor)
            ->first();

        $this->load->view('pages/doctor/data/data_profile_doctor', $data);
    }

    public function update_profile_doctor()
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
            $arr    = array(
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
            $data       = array(
                'name'                  => 'dr ' . $name,
                'address'               => $address,
                'birth_date'            => $birth_date,
                'identity_number'       => $identity_number,
                'idi_number'            => $idi_number,
                'sip_number'            => $sip_number,
                'phone'                 => $phone,
                'email'                 => $email,
            );

            if ($this->home->where('doctor.id', $id)->update($data) == true) {

                $this->home->table = 'user';
                $this->home->where('user.id_doctor', $id)->update(['username'   => $email]);
                $this->session->set_flashdata('success', 'Your Profile has been updated!');

                echo json_encode([
                    'statusCode'        => 200
                ]);
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');

                echo json_encode([
                    'statusCode'        => 201
                ]);
            }
        }
    }
}

/* End of file Home.php */
