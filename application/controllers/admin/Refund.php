<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Refund extends MY_Controller
{

    public function index()
    {

        $data['title']          = 'Refund';
        $data['page_title']     = 'Refund - Refund List - Admin KasirKu';
        $data['nav_title']      = 'refund';
        $data['detail_title']   = 'refund';
        $data['page']           = 'pages/admin/refund/index';

        $this->view($data);
    }

    public function loadTable()
    {
        $data['content']        = $this->refund->select([
            'refund.invoice', 'refund.cash_payment', 'refund.money_change', 'refund.total',
            'refund.created_at', 'customer.name', 'refund.reason'
        ])
            ->join('customer')
            ->where('refund.id_store', $this->session->userdata('id_store'))
            ->orderBy('refund.created_at', 'DESC')
            ->get();
        $this->load->view('pages/admin/refund/data/table', $data);
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

            $data['content']    = $this->refund->select([
                'refund.invoice', 'refund.cash_payment', 'refund.money_change', 'refund.total',
                'refund.created_at', 'customer.name', 'refund.reason'
            ])
                ->join('customer')
                ->where('DATE(refund.created_at) >=', $tgl_start)
                ->where('DATE(refund.created_at) <=', $tgl_end)
                ->where('refund.id_store', $this->session->userdata('id_store'))
                ->orderBy('refund.created_at', 'DESC')
                ->get();

            $this->load->view('pages/admin/refund/data/table', $data);
        } else if ($selectFilter == "month") {
            $month = $this->input->post('month', true);
            $year  = $this->input->post('year', true);

            $data['content']    = $this->refund->select([
                'refund.invoice', 'refund.cash_payment', 'refund.money_change', 'refund.total',
                'refund.created_at', 'customer.name', 'refund.reason'
            ])
                ->join('customer')
                ->where('MONTH(refund.created_at)', $month)
                ->where('YEAR(refund.created_at)', $year)
                ->where('refund.id_store', $this->session->userdata('id_store'))
                ->orderBy('refund.created_at', 'DESC')
                ->get();

            $this->load->view('pages/admin/refund/data/table', $data);
        } else {
            $year   = $this->input->post('year2', true);

            $data['content']    = $this->refund->select([
                'refund.invoice', 'refund.cash_payment', 'refund.money_change', 'refund.total',
                'refund.created_at', 'customer.name', 'refund.reason'
            ])
                ->join('customer')
                ->where('YEAR(refund.created_at)', $year)
                ->where('refund.id_store', $this->session->userdata('id_store'))
                ->orderBy('refund.created_at', 'DESC')
                ->get();
            $this->load->view('pages/admin/refund/data/table', $data);
        }
    }

    public function detail($invoice)
    {
        $data['invoice_detail'] = $this->refund->select([
            'refund.created_at', 'user.name', 'refund.total'
        ])->where('invoice', $invoice)->join('user')->first();

        $this->refund->table = 'refund_detail';
        $data['transaction'] = $this->refund->select([
            'refund.total', 'refund.invoice',
            'refund_detail.qty', 'refund_detail.subtotal AS subtotal',
            'product.title AS title_product',
            'product.price'
        ])
            ->joinRefund('refund')
            ->join('product')
            ->where('refund.invoice', $invoice)
            ->get();

        $this->refund->table = 'refund';
        $data['discount'] = $this->refund->select([
            'refund.discount_total', 'refund.subtotal'
        ])
            ->where('invoice', $invoice)
            ->first();

        $data['invoice']    = $invoice;

        $this->output->set_output(show_my_modal('pages/admin/refund/modal/modal_detail', 'modalDetailRefund', $data, 'lg'));

        //print_r($data['transaction']);
    }
}

/* End of file Refund.php */
