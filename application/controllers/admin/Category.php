<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
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
        $data['content']        = $this->category->get();
        $data['title']          = 'Category';
        $data['page_title']     = 'Category - Category List - Admin KasirKu';
        $data['nav_title']      = 'data_master';
        $data['detail_title']   = 'category';
        $data['page']           = 'pages/admin/category/index';

        $this->view($data);
    }

    public function insert()
    {
        $title = $this->input->post('title', true);
        $slug  = $this->input->post('slug', true);

        if (!$this->category->validate()) {
            $array = array(
                'error'      => true,
                'statusCode' => 400,
                'title_error' => form_error('title')
            );

            echo json_encode($array);
        } else {
            $data = array(
                'id'        => $this->generate_code(),
                'title'     => ucwords($title),
                'slug'      => $slug
            );

            if ($this->category->add($data) == true) {
                $this->session->set_flashdata('success', 'Data has been added!');

                echo json_encode(array(
                    'statusCode'    => 200,
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    'statusCode'    => 201,
                ));
            }
        }
    }

    public function generate_code()
    {
        $get_code = getCodeCategory();
        $last_code = $get_code->id;

        if ($last_code != "") {
            $urutan = (int) substr($last_code, 3);
        } else {
            $urutan = 0;
        }

        $urutan++;

        $kodeBaru = '102' . sprintf("%03s", $urutan);
        return $kodeBaru;
    }

    public function loadTable()
    {
        $data['content']        = $this->category->orderBy('created_at', 'DESC')->get();
        $this->load->view('pages/admin/category/data/table', $data);
    }

    public function edit($id)
    {
        $data['title']         = 'Edit Category Data';
        $data['getCategory']   = $this->category->where('id', $id)
            ->first();

        $this->output->set_output(show_my_modal('pages/admin/category/modal/modal_edit_category', 'modal-edit-category', $data, 'lg'));
    }

    public function update()
    {
        $id    = $this->input->post('id', true);
        $title = $this->input->post('title', true);
        $slug  = $this->input->post('slug', true);

        if (!$this->category->validate()) {
            $array = array(
                'error'      => true,
                'statusCode' => 400,
                'title_error' => form_error('title')
            );

            echo json_encode($array);
        } else {
            $data = array(
                'title'     => ucwords($title),
                'slug'      => $slug
            );

            if ($this->category->where('category.id', $id)->update($data) == true) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                echo json_encode(array(
                    'statusCode'    => 200,
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    'statusCode'    => 201,
                ));
            }
        }
    }

    public function destroy($id)
    {

        if ($this->input->is_ajax_request()) {
            if ($this->category->where('id', $id)->delete()) {
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

/* End of file Category.php */
