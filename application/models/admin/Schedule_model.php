<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends MY_Model
{

    public $table = 'schedule';
    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'store',
                'label' => 'Store',
                'rules' => 'required'
            ],
            [
                'field' => 'day[]',
                'label' => 'Day',
                'rules' => 'required'
            ],
            
            [
                'field' => 'start_time',
                'label' => 'Start Time',
                'rules' => 'required'
            ],

            [
                'field' => 'end_time',
                'label' => 'End Time',
                'rules' => 'required'
            ],
            

        ];

        return $validationRules;
    }
}

/* End of file Schedule_model.php */
