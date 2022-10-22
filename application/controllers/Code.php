<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Code extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('zend');
        $this->load->library('Ciqrcode');
    }


    public function index()
    {
    }

    public function QRCode($code)
    {
        QRcode::png(
            $code,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }

    public function Barcode($code)
    {
        
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $code), array());
    }
}

/* End of file Code.php */
