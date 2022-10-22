<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends MY_Controller
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
        $this->schedule->table = 'doctor';
        $data['content']        = $this->schedule->get();
        $data['title']          = 'Schedule';
        $data['page_title']     = 'Doctor Schedule - Doctor Schedule List - Admin';
        $data['nav_title']      = 'schedule';
        $data['detail_title']   = 'schedule';
        $data['page']           = 'pages/admin/schedule/index';

        $this->view($data);
    }

    public function loadTable()
    {
        $this->schedule->table = 'doctor';
        $data['content']        = $this->schedule->orderBy('doctor.created_at', 'DESC')->get();
        $this->load->view('pages/admin/schedule/data/table', $data);
    }

    public function add()
    {
        $data['title']         = 'Add Doctor Schedule';
        $id_doctor = $this->input->get('id_doctor', true);
        $this->schedule->table = 'doctor';
        $data['getDoctor']     = $this->schedule->where('id', $id_doctor)->first();
        $this->schedule->table = 'store';
        $data['store']   = $this->schedule->get();


        $this->output->set_output(show_my_modal('pages/admin/schedule/modal/modal_add_schedule', 'modal-add-schedule', $data, 'lg'));
    }

    public function view_schedule()
    {
        $data['title']         = 'View Doctor Schedule';
        $id_doctor = $this->input->get('id_doctor', true);
        $this->schedule->table = 'doctor';
        $data['getDoctor']     = $this->schedule->where('id', $id_doctor)->first();
        $this->schedule->table = 'schedule';
        $data['schedule']      = $this->schedule->select([
            'schedule.day_name', 'store.name', 'schedule.times_start', 'schedule.times_end',
        ])
        ->join('store')
        ->where('id_doctor', $id_doctor)->orderBy('index_day', 'ASC')->get();

        $this->output->set_output(show_my_modal('pages/admin/schedule/modal/modal_view_schedule', 'modal-view-schedule', $data, 'lg'));
    }

    public function insert()
    {
        $id_doctor = $this->input->post('id', true);
        $store      = $this->input->post('store', true);
        $start_time = $this->input->post('start_time', true);
        $end_time = $this->input->post('end_time', true);
        $day = $this->input->post('day', true);

        if (!$this->schedule->validate()) {
            $arr = [
                'error'     => true,
                'statusCode'    => 400,
                'store_error'   => form_error('store'),
                'start_time_error'    => form_error('start_time'),
                'end_time_error'    => form_error('end_time'),
                'day_error'    => form_error('day[]'),
            ];

            echo json_encode($arr);
        } else {
            $this->schedule->table = 'schedule';
            $data = [];
            foreach ($day as $row) {
                $checkSchedule = $this->schedule->where('id_doctor', $id_doctor)
                    ->where('day_name', $row)->first();

                if (!$checkSchedule) {
                    array_push($data, [
                        'id'            => date('ymdhis') . rand(pow(10, 5 - 1), pow(10, 5) - 1),
                        'id_doctor'     => $id_doctor,
                        'id_store'      => $store,
                        'day_name'      => $row,
                        'times_start'   => $start_time,
                        'times_end'     => $end_time,
                        
                    ]);

                    $this->schedule->add([
                        'id'            => date('ymdhis') . rand(pow(10, 5 - 1), pow(10, 5) - 1),
                        'id_doctor'     => $id_doctor,
                        'id_store'      => $store,
                        'day_name'      => $row,
                        'times_start'   => $start_time,
                        'times_end'     => $end_time,
                        'index_day'     => index_name_day($row)
                    ]);
                }
            }

            if (count($data) > 0) {
                echo json_encode(array(
                    'statusCode'    => 200
                ));
            } else {
                echo json_encode(array(
                    'statusCode'    => 202
                ));
            }
        }
    }
}

/* End of file Schedule.php */
