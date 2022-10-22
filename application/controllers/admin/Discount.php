<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Discount extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin' || $role == 'admin_store') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }

    public function index()
    {
        $data['content']        = $this->category->get();
        $data['title']          = 'Discount';
        $data['page_title']     = 'Discount - Discount List - Admin KasirKu';
        $data['nav_title']      = 'discount';
        $data['detail_title']   = 'discount';
        $data['page']           = 'pages/admin/discount/index';

        $this->view($data);
    }


    public function insert()
    {
        $title_discount = $this->input->post('title_discount', true);
        $value          = $this->input->post('value', true);
        $tgl_start      = $this->input->post('tgl_start', true);
        $tgl_end        = $this->input->post('tgl_end', true);


        //explode
        if ($tgl_start && $tgl_end) {
            $tgl_start_epd = explode("/", $tgl_start);
            $tgl_end_epd   = explode("/", $tgl_end);

            $tgl_start_conv = $tgl_start_epd[2] . "-" . $tgl_start_epd[1] . "-" . $tgl_start_epd[0];
            $tgl_end_conv   = $tgl_end_epd[2] . "-" . $tgl_end_epd[1] . "-" . $tgl_end_epd[0];
        }


        if (!$this->discount->validate()) {
            $array = [
                'error'                     => true,
                'statusCode'                => 400,
                'title_discount_error'      => form_error('title_discount'),
                'value_error'               => form_error('value'),
                'tgl_start_error'           => form_error('tgl_start'),
                'tgl_end_error'             => form_error('tgl_end')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'title_discount'            => $title_discount,
                'value'                     => $value,
                'tgl_start'                 => $tgl_start_conv,
                'tgl_end'                   => $tgl_end_conv
            ];

            if ($this->discount->create($data)) {
                $this->session->set_flashdata('success', 'Data has been added!');

                echo json_encode(array(
                    'statusCode'        => 200
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    'statusCode'        => 201
                ));
            }
        }
    }

    public function loadTable()
    {
        $data['content']        = $this->discount->get();
        $this->load->view('pages/admin/discount/data/table', $data);
    }

    public function edit($id)
    {
        $data['title']          = 'Edit Discount Data';
        $data['getDiscount']    = $this->discount->where('id', $id)->first();

        $this->output->set_output(show_my_modal('pages/admin/discount/modal/modal_edit_discount', 'modal-edit-discount', $data, 'lg'));
    }

    public function update()
    {
        $id             = $this->input->post('id', true);
        $title_discount = $this->input->post('title_discount', true);
        $value          = $this->input->post('value', true);
        $tgl_start      = $this->input->post('tgl_start', true);
        $tgl_end        = $this->input->post('tgl_end', true);


        //explode
        if ($tgl_start && $tgl_end) {
            $tgl_start_epd = explode("/", $tgl_start);
            $tgl_end_epd   = explode("/", $tgl_end);

            $tgl_start_conv = $tgl_start_epd[2] . "-" . $tgl_start_epd[1] . "-" . $tgl_start_epd[0];
            $tgl_end_conv   = $tgl_end_epd[2] . "-" . $tgl_end_epd[1] . "-" . $tgl_end_epd[0];
        }


        if (!$this->discount->validate()) {
            $array = [
                'error'                     => true,
                'statusCode'                => 400,
                'title_discount_error'      => form_error('title_discount'),
                'value_error'               => form_error('value'),
                'tgl_start_error'           => form_error('tgl_start'),
                'tgl_end_error'             => form_error('tgl_end')
            ];

            echo json_encode($array);
        } else {
            $data = [
                'title_discount'            => $title_discount,
                'value'                     => $value,
                'tgl_start'                 => $tgl_start_conv,
                'tgl_end'                   => $tgl_end_conv
            ];

            if ($this->discount->where('id', $id)->update($data) == true) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                echo json_encode(array(
                    'statusCode'        => 200
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    'statusCode'        => 201
                ));
            }
        }
    }

    public function destroy($id)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->discount->where('id', $id)->delete()) {
                $this->session->set_flashdata('success', 'Data has been deleted!');
                echo json_encode(array(
                    'statusCode'        => 200,
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array('statusCode' => 201));
            }
        } else {
            echo '<h3>FORBIDDEN</h3>';
        }
    }
}

/* End of file Discount.php */
