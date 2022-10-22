<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Productmove extends MY_Controller
{

    public function insert()
    {
        $id_product = $this->input->post('id_product', true);
        $id_store   = $this->input->post('id_store', true);
        $quantity   = $this->input->post('quantity', true);
        $note = $this->input->post('note', true);

        $this->load->model('admin/productmove_model');
        if (!$this->productmove->validate()) {
            $arr = [
                'error'         => true,
                'statusCode'    => 400,
                'id_store_error' => form_error('id_store'),
                'quantity_error' => form_error('quantity')
            ];

            echo json_encode($arr);
        }
    }
}

/* End of file Productmove.php */
