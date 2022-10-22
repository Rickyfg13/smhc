<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Activity extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'cashier') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }


    public function index()
    {
        $data['title']          = 'Transaction Activity';
        $data['page_title']     = 'Transaction Activity - KasirKu';
        $data['nav_title']      = 'transaction';
        $data['detail_title']   = 'transaction_activity';

        $data['transaction']    = $this->activity->select([
            'transaction.invoice', 'transaction.cash_payment', 'transaction.money_change', 'transaction.total',
            'transaction.created_at', 'customer.name'
        ])
            ->join('customer')
            ->where('DATE(transaction.created_at)', date("Y-m-d"))
            ->where('transaction.id_store', $this->session->userdata('id_store'))
            ->orderBy('transaction.created_at', 'DESC')
            ->get();

        $data['page']           = 'pages/activity/index';
        $this->view_cashier($data);
    }

    public function detail($invoice)
    {
        $data['invoice_detail'] = $this->activity->select([
            'transaction.created_at', 'user.name', 'transaction.total'
        ])->where('invoice', $invoice)->join('user')->first();

        $this->activity->table = 'transaction_detail';
        $data['transaction'] = $this->activity->select([
            'transaction.total', 'transaction.invoice',
            'transaction_detail.qty', 'transaction_detail.subtotal AS subtotal',
            'product.title AS title_product',
            'product.price'
        ])
            ->where('invoice', $invoice)
            ->joinTransaction('transaction')
            ->join('product')
            ->get();

        $this->activity->table = 'transaction';
        $data['discount'] = $this->activity->select([
            'transaction.discount_total', 'transaction.subtotal'
        ])
            ->where('invoice', $invoice)
            ->first();

        $data['invoice']    = $invoice;

        $this->output->set_output(show_my_modal('pages/activity/modal/modal_detail', 'modalDetailInvoice', $data, 'lg'));

        //print_r($data['transaction']);
    }

    public function filter($selectFilter)
    {
        if ($selectFilter == "date") {
            $start_from     = $this->input->post('tgl_start');
            $end_period     = $this->input->post('tgl_end');

            $start          = explode("/", $start_from);
            $end            = explode("/", $end_period);

            $tgl_start = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tgl_end = $end[2] . "-" . $end[1] . "-" . $end[0];

            $data['transaction']    = $this->activity->select([
                'transaction.invoice', 'transaction.cash_payment', 'transaction.money_change', 'transaction.total',
                'transaction.created_at', 'customer.name'
            ])
                ->join('customer')
                ->where('DATE(transaction.created_at) >=', $tgl_start)
                ->where('DATE(transaction.created_at) <=', $tgl_end)
                ->where('transaction.id_store', $this->session->userdata('id_store'))
                ->orderBy('transaction.created_at', 'DESC')
                ->get();

            $this->load->view('pages/activity/data/data_activity', $data);
        } else if ($selectFilter == "month") {
            $month = $this->input->post('month', true);
            $year  = $this->input->post('year', true);

            $data['transaction']    = $this->activity->select([
                'transaction.invoice', 'transaction.cash_payment', 'transaction.money_change', 'transaction.total',
                'transaction.created_at', 'customer.name'
            ])
                ->join('customer')
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->where('transaction.id_store', $this->session->userdata('id_store'))
                ->orderBy('transaction.created_at', 'DESC')
                ->get();

            $this->load->view('pages/activity/data/data_activity', $data);
        } else {
            $year   = $this->input->post('year2', true);

            $data['transaction']    = $this->activity->select([
                'transaction.invoice', 'transaction.cash_payment', 'transaction.money_change', 'transaction.total',
                'transaction.created_at', 'customer.name'
            ])
                ->join('customer')
                ->where('YEAR(transaction.created_at)', $year)
                ->where('transaction.id_store', $this->session->userdata('id_store'))
                ->orderBy('transaction.created_at', 'DESC')
                ->get();
            $this->load->view('pages/activity/data/data_activity', $data);
        }
    }

    public function reset()
    {
        $data['transaction']    = $this->activity->select([
            'transaction.invoice', 'transaction.cash_payment', 'transaction.money_change', 'transaction.total',
            'transaction.created_at', 'customer.name'
        ])
            ->join('customer')
            ->where('DATE(transaction.created_at)', date("Y-m-d"))
            ->where('transaction.id_store', $this->session->userdata('id_store'))
            ->orderBy('transaction.created_at', 'DESC')
            ->get();

        $this->load->view('pages/activity/data/data_reset', $data);
    }

    public function customer_transaction()
    {
        $data['title']          = 'Patient Transaction';
        $data['page_title']     = 'Patient Transaction - KasirKu';
        $data['nav_title']      = 'transaction';
        $data['detail_title']   = 'customer_transaction';
        $this->activity->table = 'customer';
        $data['patients']       = $this->activity->orderBy('created_at', 'DESC')->get();
        $data['page']           = 'pages/activity/customer_transaction';
        $this->view_cashier($data);
    }

    public function get_customer_transaction()
    {
        $id_customer = $this->input->get('id_customer', true);
        

        $this->activity->table = 'customer';
        $data['transaction'] = $this->activity->select([
            'customer.name', 'transaction.invoice', 'transaction.created_at', 'user.name'
        ])
            ->join2('transaction', 'inner')
            ->joinUser()
            ->where('transaction.id_customer', $id_customer)
            ->orderBy('transaction.created_at', 'DESC')
            ->get();

        // $this->activiy->table = 'transaction_detail';
        // $getItem = $this->activity->select([
        //     'transaction_detail.'
        // ]);

        $this->activity->table = 'transaction_detail';
        foreach ($data['transaction'] as $row) {
            $data['transaction_detail'][$row->invoice] = $this->activity->select([
                'transaction.total', 'transaction.invoice',
                'transaction_detail.qty', 'transaction_detail.subtotal AS subtotal',
                'product.title AS title_product',
                'product.price'
            ])
                ->where('invoice', $row->invoice)
                ->joinTransaction('transaction')
                ->join('product')
                ->get();
        }


        $this->activity->table = 'transaction';
        foreach ($data['transaction'] as $row2) {
            $data['discount'][$row2->invoice] = $this->activity->select([
                'transaction.discount_total', 'transaction.subtotal'
            ])
                ->where('invoice', $row2->invoice)
                ->first();
        }

        foreach ($data['transaction'] as $row3) {
            $data['invoice_detail'][$row3->invoice] = $this->activity->select([
                'transaction.created_at', 'user.name', 'transaction.total'
            ])->where('invoice', $row3->invoice)->join('user')->first();
        }


        $this->activity->table = 'customer';
        $data['name_patient'] = $this->activity->select([
            'customer.name'
        ])->where('id', $id_customer)
            ->first();

        $this->output->set_output(show_my_modal('pages/activity/modal/modal_customer_transaction', 'modal-customer-transaction', $data, 'xl'));
        //print_r($data['transaction_detail']);
    }
}

/* End of file Activity.php */
