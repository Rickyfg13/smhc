<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin' || $role == 'finance') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }



    public function index()
    {

        $data['title']            = 'Dashboard';
        $data['page_title']     = 'Dashboard - Admin KasirKu';
        $data['nav_title']      = 'dashboard';
        $data['detail_title']   = 'dashboard';

        //sales total based on month
        foreach (getMonth() as $key => $value) {
            $this->dashboard->table = 'transaction';
            $data['sales_report'][$key]    = $this->dashboard->where('MONTH(created_at)', $key)
                ->where('YEAR(created_at)', date('Y'))
                ->get();


            $this->dashboard->table = 'product_in';
            $data['product_in_report'][$key]        = $this->dashboard->where('MONTH(created_at)', $key)
                ->where('YEAR(created_at)', date('Y'))->get();

            $this->dashboard->table = 'transaction_detail';
            $data['items_sales_report'][$key]    = $this->dashboard
                ->joinTransaction('transaction')
                ->join('product')
                ->where('MONTH(transaction.created_at)', $key)
                ->where('YEAR(transaction.created_at)', date('Y'))
                ->where('product.id_category', '102002')
                ->get();
        }

        foreach (getNameDay() as $key => $value) {
            $this->dashboard->table = 'transaction';
            $data['day'][(int) $key]            = $this->dashboard->select([
                'DAYOFWEEK(created_at) AS dayweek', 'DAYNAME(created_at) AS dayname', 'SUM(subtotal) AS subtotal'
            ])
                ->where('DAYOFWEEK(created_at)', $key)
                ->where('MONTH(created_at)', date('m'))
                ->where('YEAR(created_at)', date('Y'))
                ->groupBy('DAYOFWEEK(transaction.created_at)')
                ->first();
        }

        foreach (getHour() as $hour) {
            $this->dashboard->table = 'transaction';
            $data['hour'][$hour]            = $this->dashboard->select([
                'HOUR(created_at)', 'SUM(subtotal) AS subtotal'
            ])
                ->where('HOUR(created_at)', $hour)
                ->where('MONTH(created_at)', date('m'))
                ->where('YEAR(created_at)', date('Y'))
                ->groupBy('HOUR(transaction.created_at)')
                ->first();
        }

        //sales total
        $this->dashboard->table = 'transaction';
        $data['sumTotal']        = $this->dashboard->select([
            'total', 'purchase_price_total', 'subtotal'
        ])->where('YEAR(created_at)', date('Y'))->get();

        //product_in total
        $this->dashboard->table = 'product_in';
        $data['product_in_total'] = $this->dashboard->select([
            'stock_in'
        ])->where('YEAR(created_at)', date('Y'))->get();



        //items sales total
        $this->dashboard->table = 'transaction_detail';
        $data['items_sales_total'] = $this->dashboard->select([
            'SUM(transaction_detail.qty) AS total'
        ])->joinTransaction('transaction')
            ->join('product')
            ->where('YEAR(transaction.created_at)', date('Y'))
            ->where('product.id_category', '102002')
            ->first();


        $data['best_seller_product_siteba'] = $this->dashboard->select([
            'SUM(transaction_detail.qty) AS qty', 'product.title', 'product.price', 'product.id'
        ])
            ->join('product')
            ->joinTransaction('transaction')
            ->where('YEAR(transaction.created_at)', date('Y'))
            ->where('product.id_category', '102002')
            ->where('product.id_store', '1')
            ->groupBy('product.id')
            ->orderBy('SUM(transaction_detail.qty)', 'DESC')
            ->limit(5)
            ->get();

        $data['best_seller_product_bandar_damar'] = $this->dashboard->select([
            'SUM(transaction_detail.qty) AS qty', 'product.title', 'product.price', 'product.id'
        ])
            ->join('product')
            ->joinTransaction('transaction')
            ->where('YEAR(transaction.created_at)', date('Y'))
            ->where('product.id_category', '102002')
            ->where('product.id_store', '2')
            ->groupBy('product.id')
            ->orderBy('SUM(transaction_detail.qty)', 'DESC')
            ->limit(5)
            ->get();

        $this->dashboard->table = 'transaction';
        $data['salesPerDayBasedMonthYear'] = $this->dashboard->select([
            'transaction.invoice', 'SUM(transaction.subtotal) AS total',
            'transaction.created_at'
        ])
            ->where('MONTH(transaction.created_at)', date('m'))
            ->where('YEAR(transaction.created_at)', date('Y'))
            ->groupBy('DATE(transaction.created_at)')
            ->get();

        $data['totalSalesPerDayBasedMonthYear'] = array_sum(array_column($data['salesPerDayBasedMonthYear'], 'total'));

        $data['page']            = 'pages/admin/dashboard/index';
        $this->view($data);
    }

    public function sales_report($year = '')
    {
        foreach (getMonth() as $key => $value) {
            $data['sales_report'][$key]    = $this->dashboard->where('MONTH(created_at)', $key)
                ->where('YEAR(created_at)', $year == '' ? date('Y') : $year)
                ->get();
        }

        echo json_encode($data['sales_report']);

        //print_r($data['content']['03']);
        //echo array_sum(array_column($data['content']['3'], 'total'));
    }

    public function daily_gross_sales_amount()
    {
        $month = $this->input->get('month', true);
        $year = $this->input->get('year', true);

        $this->dashboard->table = 'transaction';
        $salesPerDayBasedMonthYear = $this->dashboard->select([
            'transaction.invoice', 'SUM(transaction.subtotal) AS total',
            'transaction.created_at'
        ])
            ->where('MONTH(transaction.created_at)', $month)
            ->where('YEAR(transaction.created_at)', $year)
            ->groupBy('DATE(transaction.created_at)')
            ->get();


        $label = [];
        $data = [];

        foreach ($salesPerDayBasedMonthYear as $row) {
            array_push($label, date_format(new DateTime($row->created_at), 'd/m/Y'));
            array_push($data, $row->total);
        }




        echo json_encode([
            'label'         => count($label) > 0 ? $label : [0],
            'data'          => count($data) > 0 ? $data : [0],
            'total'         => array_sum($data),
        ]);
    }

    public function sales_net_report($year = '')
    {
        foreach (getMonth() as $key => $value) {
            $data['sales_net_report'][$key]    = $this->dashboard->where('MONTH(created_at)', $key)
                ->where('YEAR(created_at)', $year == '' ? date('Y') : $year)
                ->get();
        }

        echo json_encode($data['sales_net_report']);
    }

    public function tes()
    {
        $this->dashboard->table = 'transaction';
        $data['hour']            = $this->dashboard->select([
            'HOUR(created_at)', 'SUM(subtotal) AS subtotal'
        ])
            ->where('MONTH(created_at)', date('m'))
            ->where('YEAR(created_at)', date('Y'))

            ->groupBy('HOUR(transaction.created_at)')
            ->get();

        // $data['day']			= $this->dashboard->select([
        // 	'HOUR(created_at)','DAYOFWEEK(created_at) AS dayweek', 'DAYNAME(created_at) AS dayname', 'SUM(subtotal) AS subtotal'
        // ])
        // 	->where('MONTH(created_at)', date('m'))
        // 	->where('YEAR(created_at)', date('Y'))
        // 	->groupBy('DAYOFWEEK(transaction.created_at)')
        // 	->get();

        // $data['day_chart'] = [];
        // foreach (getNameDay() as $key => $value) {
        // 	foreach ($data['day'] as $row) {
        // 		if ($row->dayweek == $key) {
        // 			array_push($data['day_chart'], $row->subtotal);
        // 		} else {
        // 			array_push($data['day_chart'], 0);
        // 		}
        // 	}
        // }

        print_r($data['hour']);
    }

    public function tes_lagi()
    {
        $arr = array();
        foreach (getMonth() as $key => $value) {
            $data['content'][$key]    = $this->dashboard->where('MONTH(created_at)', $key)
                ->where('YEAR(created_at)', date('Y'))
                ->get();
            array_push($arr, array_sum(array_column($data['content'][$key], 'total')));
        }

        echo array_sum($arr);
    }
}
