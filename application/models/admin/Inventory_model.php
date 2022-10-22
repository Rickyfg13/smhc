<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_model extends MY_Model
{

    public $table = 'product';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            ],

            [
                'field' => 'stock',
                'label' => 'Stock',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'purchase_price',
                'label' => 'Purchase Price',
                'rules' => 'required|trim'
            ],

        ];

        return $validationRules;
    }

    public function getValidationVariantRules()
    {
        $validationRules = [
            [
                'field' => 'title[]',
                'label' => 'Title',
                'rules' => 'required|trim'
            ],

            [
                'field' => 'price[]',
                'label' => 'Price',
                'rules' => 'required|trim'
            ],
        ];

        return $validationRules;
    }

    public function uploadImage($fieldName, $fileName)
    {
        $config = [
            'upload_path'       => './images/product',
            'file_name'         => $fileName,
            'allowed_types'     => 'jpg|gif|png|jpeg|JPG|PNG',
            'max_size'          => 2048,
            'max_width'         => 0,
            'max_height'        => 0,
            'overwrite'         => true,
            'file_ext_tolower'  => true
        ];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data();
        } else {
            $this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
            return false;
        }
    }

    public function deleteImage($fileName)
    {
        if (file_exists("./images/product/$fileName")) {
            unlink("./images/product/$fileName");
        }
    }
}

/* End of file Inventory_model.php */
