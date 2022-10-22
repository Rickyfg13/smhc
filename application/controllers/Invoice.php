<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mypdf');

    }

    public function index()
    {
        
    }

    public function print($invoice = '', $pdf = '')
    {
        $this->invoice->table = 'transaction';
        $data['invoice_detail'] = $this->invoice->select([
            'transaction.created_at', 'user.name', 'transaction.total', 'transaction.id_store',
            'transaction.method_payment', 'customer.name AS name_customer'
        ])
            ->where('invoice', $invoice)->join('customer')->join('user')->first();

        $this->invoice->table = 'store';
        $data['store']        = $this->invoice->select([
            'address', 'phone', 'name'
        ])
            ->where('id', $data['invoice_detail']->id_store)
            ->first();

        $this->invoice->table = 'transaction_detail';
        $data['transaction'] = $this->invoice->select([
            'transaction.total', 'transaction.invoice',
            'transaction_detail.qty', 'transaction_detail.subtotal AS subtotal',
            'product.title AS title_product',
            'product.price'
        ])
            ->where('invoice', $invoice)
            ->joinTransaction('transaction')
            ->join('product')
            ->get();

        $this->invoice->table = 'transaction';
        $data['discount'] = $this->invoice->select([
            'transaction.discount_total', 'transaction.subtotal', 'transaction.cash_payment',
            'transaction.money_change'
        ])
            ->where('invoice', $invoice)
            ->first();

        $data['invoice']    = $invoice;
        if ($pdf != '') {
            $this->mypdf->generate('pages/cashier/invoice/invoice_pdf', $data, 'invoice-' . $invoice, 'A4', 'portrait');
        } else {
            $this->load->view('pages/cashier/invoice/invoice', $data);
        }
    }

}

/* End of file Invoice.php */
