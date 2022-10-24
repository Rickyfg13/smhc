<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Medicalrecord_model extends MY_Model
{

    public $table = 'medical_records';
    public $perPage = 12;

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'anamnesa',
                'label' => 'Anamnesa',
                'rules' => 'required|trim',
            ],
            [
                'field' => 'diagnosa',
                'label' => 'Diganosa',
                'rules' => 'required|trim',
            ],
            // [
            //     'field' => 'therapy[]',
            //     'label' => 'Therapy',
            //     'rules' => 'required|trim',
            // ],


        ];


        return $validationRules;
    }



    public function getProduct(){



        $query = "SELECT `therapies_detail`.*,`therapies_detail`.`id`, `product`.`title`
                FROM `therapies_detail`
                INNER JOIN `product` ON `therapies_detail` . `id_product`=`product`.`id`
        ";

        return $this->db->get_where($query)->row_array();
    }
}

/* End of file Medicalrecord.php */
