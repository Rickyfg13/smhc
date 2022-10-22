<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Xendit\Xendit;

class XenditController extends CI_Controller
{

    public function index()
    {
        require 'vendor/autoload.php';

        Xendit::setApiKey(api_key_xendit());


        $data = [
            'external_id'       => '20123123421424',
            'payer_email'       => 'rioandroid1@gmail.com',
            'description'       => 'Testing',
            'amount'            => 100000
        ];
        $createInvoice =  \Xendit\Invoice::create($data);
        print_r($createInvoice);

        // foreach($getVABanks as $row) {
        //     echo $row['name'] . '<br>';
        // }
    }


    public function getAllInvoice()
    {

        require 'vendor/autoload.php';

        Xendit::setApiKey(api_key_xendit());
        $getAllInvoice = \Xendit\Invoice::retrieveAll();

        print_r($getAllInvoice);
    }
}

/* End of file XenditController.php */
