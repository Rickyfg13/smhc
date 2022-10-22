<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Store extends MY_Controller
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
        $data['content']            = $this->store->get();
        $data['title']              = 'Store';
        $data['page_title']         = 'Store - Store List - Admin KasirKu';
        $data['nav_title']          = 'data_master';
        $data['detail_title']       = 'store';
        $data['page']               = 'pages/admin/store/index';

        $this->view($data);
    }


    public function loadTable()
    {
        $data['content']            = $this->store->orderBy('created_at', 'DESC')->get();
        $this->load->view('pages/admin/store/data/table', $data);
    }

    public function insert()
    {
        $store_name = $this->input->post('store_name', true);
        $store_phone = $this->input->post('store_phone', true);
        $store_address = $this->input->post('store_address', true);

        if (!$this->store->validate()) {
            $arr = [
                'error'                 => true,
                'statusCode'            => 400,
                'store_name_error'      => form_error('store_name'),
                'store_phone_error'     => form_error('store_phone'),
                'store_address_error'   => form_error('store_address')
            ];

            echo json_encode($arr);
        } else {
            $data = [
                'name'                  => $store_name,
                'phone'                 => $store_phone,
                'address'               => $store_address
            ];

            if ($this->store->add($data) == true) {
                $this->session->set_flashdata('success', 'Data has been added!');

                echo json_encode([
                    'statusCode'        => 200,
                ]);
            } else {

                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode([
                    'statusCode'        => 201,
                ]);
            }
        }
    }

    public function edit($id)
    {
        $data['title']              = 'Edit Store Data';
        $data['getStore']           = $this->store->where('id', $id)->first();


        $this->output->set_output(show_my_modal('pages/admin/store/modal/modal_edit_store', 'modal-edit-store', $data, 'lg'));
    }

    public function update()
    {
        $store_id  = $this->input->post('id', true);
        $store_name = $this->input->post('store_name', true);
        $store_phone = $this->input->post('store_phone', true);
        $store_address = $this->input->post('store_address', true);

        if (!$this->store->validate()) {
            $arr = [
                'error'                 => true,
                'statusCode'            => 400,
                'store_name_error'      => form_error('store_name'),
                'store_phone_error'     => form_error('store_phone'),
                'store_address_error'   => form_error('store_address')
            ];

            echo json_encode($arr);
        } else {

            $data = [
                'name'                  => $store_name,
                'phone'                 => $store_phone,
                'address'               => $store_address
            ];

            if ($this->store->where('id', $store_id)->update($data)) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                echo json_encode([
                    'statusCode'        => 200,
                ]);
            } else {

                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode([
                    'statusCode'        => 201,
                ]);
            }
        }
    }

    public function destroy($id)
    {
        if ($this->input->is_ajax_request()) {
            if ($this->store->where('id', $id)->delete()) {
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


    public function update_sess_store($val)
    {
        $this->session->set_userdata('id_store', $val);

        echo json_encode([
            'statusCode'    => 200
        ]);
    }
}

/* End of file Store.php */
