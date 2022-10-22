<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends MY_Controller
{


    private $deleted_sess;
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        $this->load->library('mypdf');

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
        $this->cart->destroy();
        $this->session->unset_userdata('edit_transaction');
        $this->session->unset_userdata('id_product');
        $this->session->unset_userdata('quantity');
        $this->session->unset_userdata('invoice_edit');
        $this->session->set_userdata('deleted_data', []);
        $data_sess = [
            'total_db', 'subtotal_db', 'discount_total_db', 'purchase_price_total_db'
        ];

        $this->session->unset_userdata($data_sess);

        $data['title']          = 'Cashier';
        $data['page_title']     = 'Cashier - KasirKu';
        $data['nav_title']      = 'cashier';
        $data['detail_title']   = 'cashier';

        //product
        $this->cashier->table   = 'product';
        $data['product']        = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->limit(8)->get();
        $data['total_product']  = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->count();


        $data['product2']        = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->get();
        foreach ($data['product2'] as $row) {
            $this->session->set_userdata('stock' . $row->id, $row->stock);
        }
        //$this->cashier->table    =;

        //discount
        $tgl_sekarang = date('Y-m-d');


        $this->cashier->table   = 'discount';
        $data['discount']       = $this->cashier
            ->where('tgl_start <=', $tgl_sekarang)
            ->where('tgl_end >=', $tgl_sekarang)
            ->get();
        $data['countDiscount']  = $this->cashier
            ->where('tgl_start <=', $tgl_sekarang)
            ->where('tgl_end >=', $tgl_sekarang)
            ->count();
        //item
        $data['cart']           = $this->cart->contents();
        $data['totalCart']      = $this->cart->total();
        $data['page']           = 'pages/cashier/index';

        //print_r($data['discount']);
        $this->view_cashier($data);
    }

    public function loadDataVariant()
    {
        $id = $this->input->get('id', true);

        $this->cashier->table   = 'variant';
        $data['variant']        = $this->cashier->where('id_product', $id)->orderBy('title', 'ASC')->get();

        $this->load->view('pages/cashier/data_variant', $data);
    }

    public function loadDataTableCart()
    {
        //item
        $data['cart']           = $this->cart->contents();
        $data['totalCart']      = $this->cart->total();

        $data['sub_total']       = array();
        $data['disc_total']      = array();
        $data['purchase_price_total']      = array();
        foreach ($data['cart'] as $row) {
            array_push($data['sub_total'], ($row['option']['price_temp']) * $row['qty']);
            array_push($data['disc_total'], ($row['option']['discount_temp']) * $row['qty']);
            array_push($data['purchase_price_total'], ($row['option']['purchase_price']) * $row['qty']);
        }

        $this->load->view('pages/cashier/table_cart', $data);
    }

    public function loadDataTransaction()
    {
        $data['transaction']    = $this->activity->where('DATE(created_at)', date("Y-m-d"))
            ->where('id_store', $this->session->userdata('id_store'))
            ->orderBy('created_at', 'DESC')
            ->get();

        //$this->load->view('pages/cashier/data_transaction', $data);
        $this->output->set_output(show_my_modal('pages/cashier/data_transaction', 'modal-edit-transaction-cashier', $data, 'lg'));
    }

    public function tes()
    {
        print_r($this->cart->contents());
    }

    public function insert()
    {

        $id = $this->input->get("id");
        $id_category = $this->input->get("id_category");
        $qty = $this->input->get("qty");
        $purchase_price = $this->input->get("purchase_price");
        $price = $this->input->get("price");
        $title = $this->input->get("title");
        $stock = $this->input->get("stock");
        $disc = $this->input->get("discount");
        $price_temp = $this->input->get("price_sebelum");
        $id_variant = $this->input->get("id_variant");
        $stock_userdata = $this->session->userdata('stock' . $id);
        if ($id_category == '102002') {
            if ($stock_userdata <= 0) {
                echo json_encode(
                    array(
                        'statusCode'    => 202,
                        'msg'   => 'Out of Stock'
                    )

                );
            } else {
                $data = array(
                    'id'    => $id,
                    'qty'   => $qty,
                    'price' => $price,
                    'name'  => ucwords($title),
                    'option' => array(
                        'stock'         => $stock_userdata,
                        'price_temp'    => $price_temp,
                        'discount_temp' => $disc,
                        'purchase_price' => $purchase_price,
                        'id_variant'    => $id_variant != "" ? $id_variant : null

                    )
                );

                $add = $this->cart->insert($data);
                if ($add) {
                    $stock = (int) $stock;
                    $quantity = (int) $qty;
                    $sisaStock = $stock - $quantity;
                    $this->session->set_userdata('stock' . $id, $sisaStock);

                    $this->session->set_userdata('discount_total', $disc * $qty);
                    $this->session->set_userdata('price_temp', $price_temp);

                    echo json_encode(array(
                        'statusCode'    => 200,
                        'stock'         => $stock,
                        'sisaStock'     => $this->session->userdata('stock' . $id)
                    ));
                }
            }
        } else {
            $data = array(
                'id'    => $id,
                'qty'   => $qty,
                'price' => $price,
                'name'  => ucwords($title),
                'option' => array(
                    'stock'         => $stock_userdata,
                    'price_temp'    => $price_temp,
                    'discount_temp' => $disc,
                    'purchase_price' => $purchase_price,
                    'id_variant'    => $id_variant != "" ? $id_variant : null

                )
            );

            $add = $this->cart->insert($data);
            if ($add) {
                // $stock = (int) $stock;
                // $quantity = (int) $qty;
                // $sisaStock = $stock - $quantity;
                // $this->session->set_userdata('stock' . $id, $sisaStock);

                $this->session->set_userdata('discount_total', $disc * $qty);
                $this->session->set_userdata('price_temp', $price_temp);
                $this->session->set_userdata('id_product', $id);
                $this->session->set_userdata('quantity', $qty);
                echo json_encode(array(
                    'statusCode'    => 200,
                    'stock'         => $stock,
                    'sisaStock'     => $this->session->userdata('stock' . $id)
                ));
            }
        }
    }

    public function insert_by_itemCode($itemCode, $qty)
    {
        $this->cashier->table = 'product';
        $getProduct = $this->cashier->where('product.id', $itemCode)->where('product.id_store', $this->session->userdata('id_store'))->first();
        $getProductCount = $this->cashier->where('product.id', $itemCode)->where('product.id_store', $this->session->userdata('id_store'))->count();
        $stock_userdata = $this->session->userdata('stock' . $itemCode);


        if ($getProductCount > 0) {
            if ($getProduct->id_category == '102002') {
                if ($stock_userdata <= 0) {
                    echo json_encode(
                        array(
                            'statusCode'    => 202,
                            'msg'   => 'Out of Stock'
                        )

                    );
                } else {
                    $data = array(
                        'id'    => $getProduct->id,
                        'qty'   => $qty,
                        'price' => $getProduct->price,
                        'name'  => ucwords(urldecode($getProduct->title)),
                        'option' => array(
                            'stock' => $stock_userdata,
                            'price_temp'    => $getProduct->price,
                            'discount_temp' => 0,
                            'purchase_price' => $getProduct->purchase_price,
                            'id_variant'    => null,
                        )
                    );

                    $add = $this->cart->insert($data);

                    if ($add) {
                        $stock = (int) $this->session->userdata('stock' . $itemCode);
                        $quantity = (int) $qty;
                        $sisaStock = $stock - $quantity;
                        $this->session->set_userdata('stock' . $itemCode, $sisaStock);
                        $this->session->unset_userdata('discount_total');
                        echo json_encode(array(
                            'statusCode'    => 200,
                            'stock'         => $getProduct->stock,
                            'sisaStock'     => $this->session->userdata('stock' . $itemCode)
                        ));
                    } else {
                        echo json_encode(array(
                            'statusCode' => 201,
                        ));
                    }
                }
            } else {
                $data = array(
                    'id'    => $getProduct->id,
                    'qty'   => $qty,
                    'price' => $getProduct->price,
                    'name'  => ucwords(urldecode($getProduct->title)),
                    'option' => array(
                        'stock' => $stock_userdata,
                        'price_temp'    => $getProduct->price,
                        'discount_temp' => 0,
                        'purchase_price' => $getProduct->purchase_price,
                        'id_variant'    => null
                    )
                );

                $add = $this->cart->insert($data);

                if ($add) {
                    // $stock = (int) $this->session->userdata('stock' . $itemCode);
                    // $quantity = (int) $qty;
                    // $sisaStock = $stock - $quantity;
                    // $this->session->set_userdata('stock' . $itemCode, $sisaStock);
                    $this->session->unset_userdata('discount_total');
                    echo json_encode(array(
                        'statusCode'    => 200,
                        'stock'         => $getProduct->stock,
                        'sisaStock'     => $this->session->userdata('stock' . $itemCode)
                    ));
                } else {
                    echo json_encode(array(
                        'statusCode' => 201,
                    ));
                }
            }
        }
    }

    public function show()
    {
        $items = $this->cart->contents();

        echo '<pre>';
        print_r($items);
        echo '</pre>';
    }

    public function clear_cart()
    {
        if (!$this->cart->destroy()) {
            echo json_encode(array(
                'statusCode' => 200,
                'msg'        => 'Cart has been empty!'
            ));
        } else {
            echo json_encode(array(
                'statusCode' => 201,
                'msg'        => 'Oops! Something went wrong!'
            ));
        }
    }

    public function delete()
    {
        if ($this->input->is_ajax_request()) {
            $rowid = $this->input->post('rowid', true);
            $id_product = $this->input->post('id', true);
            $qty = $this->input->post('qty', true);
            $stock_current = $this->session->userdata('stock' . $id_product);

            $update_stock = $qty + $stock_current;

            $this->session->set_userdata('stock' . $id_product, $update_stock);

            if ($this->cart->remove($rowid) == true) {
                echo json_encode([
                    'statusCode'            => 200,
                    'count'                 => count($this->cart->contents()),
                    'id_product'            => $id_product,
                    'update_stock'          => $update_stock
                ]);
            } else {
                echo json_encode(array(
                    'statusCode' => 201,
                    'msg'        => 'Oops! Something went wrong!',
                    'type'       => 'error'
                ));
            }
        } else {
            echo '<h4>FORBIDDEN</h4>';
        }
    }



    public function loadTotVal()
    {
        if (!$this->session->has_userdata('edit_transaction')) {
            echo $this->cart->total();
        } else {
            $total_in_db = $this->cashier->select([
                'total', 'subtotal', 'discount_total', 'purchase_price_total'
            ])->where('invoice', $this->session->userdata('invoice_edit'))->first();

            echo $total_in_db->total + $this->cart->total();
        }
    }

    public function pay($id_queue = '')
    {
        $invoice = $this->input->post('invoice', true);
        $id_customer = $this->input->post('id_customer', true);
        // $subtotal = $this->session->userdata('price_temp');
        $subtotal = $this->input->post('subtotal', true);
        $discount_total = $this->input->post('discount_total', true);
        $purchase_price_total = $this->input->post('purchase_price_total', true);
        $total = $this->input->post('total', true);
        $money_change = $this->input->post('money_change', true);
        $cash_payment = $this->input->post('cash_payment', true);

        $method_payment = $this->input->post('method_payment', true);
        $bank           = $this->input->post('bank', true);
        $marketplace    = $this->input->post('marketplace', true);



        //$subtotal = array();

        // foreach($this->cart->contents() as $row) {
        //     array_push($subtotal, ['price' => $row['option']['price_temp']]);
        // }
        $data = array(
            'invoice'       => $invoice,
            'id_user'       => $this->session->userdata('id'),
            'id_customer'   => $id_customer == "" ? null : $id_customer,
            'id_store'      => $this->session->userdata('id_store'),
            'subtotal'      => $subtotal,
            'purchase_price_total'  => $purchase_price_total,
            'discount_total' => $discount_total,
            'total'         => $total,
            'cash_payment'  => (int) str_replace(".", "", $cash_payment),
            'money_change'  => (int) str_replace(".", "", $money_change),
            'method_payment' => $method_payment,
            'bank'          => $bank,
            'marketplace'   => $marketplace
        );

        $this->cashier->table = 'transaction';
        if ($this->cashier->add($data) == true) {
            $data_transaction_detail = array();
            foreach ($this->cart->contents() as $row) {
                array_push(
                    $data_transaction_detail,
                    array(
                        'invoice_transaction'   => $invoice,
                        'id_product'    => $row['id'],
                        'id_variant'    => $row['option']['id_variant'],
                        'qty'           => $row['qty'],
                        'subtotal'      => $row['option']['price_temp'] * $row['qty']
                    )
                );
            }

            $this->cashier->table = 'transaction_detail';
            $this->cashier->add_batch($data_transaction_detail);
            $this->update_stock();


            if ($id_queue != '') {
                $this->cashier->table = 'queue';
                if ($this->cashier->where('id', $id_queue)->update([
                    'status'        => 'paid'
                ])) {
                    //notification with pusher to admin
                    require FCPATH . 'vendor/autoload.php';

                    $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                    );
                    $pusher = new Pusher\Pusher(
                        'cc14b125ee722dc1a2ea',
                        '45829a6d33e9dc1191be',
                        '1197860',
                        $options
                    );

                    $data['msg']        = 'The Patient ' . $id_queue . ' has been paid';
                    $data['id_store_sess'] = $this->session->userdata('id_store');
                    $data['paid']           = true;
                    $pusher->trigger('my-channel', 'my-event', $data);
                }
            }
            echo json_encode(
                array(
                    'statusCode'    => 200,
                )
            );
        } else {
            echo json_encode(
                array(
                    'statusCode'    => 201,
                )
            );
        }
    }

    public function pay_detail($invoice_transaction)
    {
        $data = array();
        foreach ($this->cart->contents() as $row) {
            array_push(
                $data,
                array(
                    'invoice_transaction'   => $invoice_transaction,
                    'id_product'    => $row['id'],
                    'id_variant'    => $row['option']['id_variant'],
                    'qty'           => $row['qty'],
                    'subtotal'      => $row['option']['price_temp'] * $row['qty']
                )
            );
        }

        $this->cashier->table = 'transaction_detail';
        if ($this->cashier->add_batch($data) == true) {
            //echo 'berhasil';
        } else {
            //echo 'gagal';
        }
    }

    public function update_stock()
    {
        $data = array();
        foreach ($this->cart->contents() as $row) {
            array_push(
                $data,
                array(
                    'id'       => $row['id'],
                    'stock'    => $this->session->userdata('stock' . $row['id'])
                )
            );
        }

        $this->cashier->table = 'product';
        if ($this->cashier->update_batch($data, 'id')) {
            // berhasil
        } else {
            // gagal
        }
    }

    public function filter($jenisItem = '')
    {
        if ($jenisItem != '') {
            $this->cashier->table = 'product';
            $data['product']      = $this->cashier->where('product.is_available', 1)
                ->where('product.id_store', $this->session->userdata('id_store'))
                ->where('product.id_category', $jenisItem)->limit(8)->get();

            $totalProduct = $this->cashier->where('product.is_available', 1)
                ->where('product.id_store', $this->session->userdata('id_store'))
                ->where('product.id_category', $jenisItem)->count();

            $data['category'] = $jenisItem;

            // foreach ($data['product'] as $row) {
            //     $this->session->set_userdata('stock' . $row->id, $row->stock);
            // }
        } else {
            $this->cashier->table = 'product';
            $data['product']      = $this->cashier->where('list of patientproduct.is_available', 1)
                ->where('product.id_store', $this->session->userdata('id_store'))
                ->limit(8)
                ->get();

            $totalProduct = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->count();

            $data['category'] = '';

            // foreach ($data['product'] as $row) {
            //     $this->session->set_userdata('stock' . $row->id, $row->stock);
            // }
        }


        if (count($data['product']) > 0) {
            echo json_encode(
                [
                    'statusCode'        => 200,
                    'html'              => $this->load->view('pages/cashier/item', $data, true),
                    'total'             => $totalProduct
                ]
            );
        } else {
            echo json_encode(
                [
                    'statusCode'        => 201,
                    'html'              => '<h4>Item Not Found</h4>'
                ]
            );
        }
    }

    public function search($keyword, $page = null)
    {
        $this->cashier->table   = 'product';
        $data['product']        = $this->cashier->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->like('product.title', urldecode($keyword))
            ->limit(8)->get();
        $totalProduct           = $this->cashier->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->like('product.title', urldecode($keyword))
            ->count();
        $data['category'] = '';

        // foreach ($data['product'] as $row) {
        //     $this->session->set_userdata('stock' . $row->id, $row->stock);
        // }

        echo json_encode(
            [
                'statusCode'        => 200,
                'html'              => $this->load->view('pages/cashier/item', $data, true),
                'total'             => $totalProduct
            ]
        );
    }

    public function loadMoreData()
    {
        $this->cashier->table = 'product';


        //print_r($data['total_product']);
        if (!empty($this->input->get("page"))) {
            $start = $this->input->get("page") * 2;

            if ($this->input->get("category")) {
                $data['product']        = $this->cashier->where('product.is_available', 1)
                    ->where('product.id_category', $this->input->get("category"))
                    ->where('product.id_store', $this->session->userdata('id_store'))
                    ->limit_data($start, $this->cashier->perPage)
                    ->get();

                $data['total_product']  = $this->cashier->where('product.is_available', 1)->where('product.id_category', $this->input->get("category"))->where('product.id_store', $this->session->userdata('id_store'))->count();
                // foreach ($data['product'] as $row) {
                //     $this->session->set_userdata('stock' . $row->id, $row->stock);
                // }

                $data['category']      = $this->input->get("category");
            } else {

                if ($this->input->get("search")) {
                    $data['product']        = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->like('product.title', urldecode($this->input->get("search")))->limit_data($start, $this->cashier->perPage)->get();
                    $data['total_product']  = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->like('product.title', urldecode($this->input->get("search")))->count();
                    foreach ($data['product'] as $row) {
                        $this->session->set_userdata('stock' . $row->id, $row->stock);
                    }
                } else {
                    $data['product']        = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->limit_data($start, $this->cashier->perPage)->get();
                    $data['total_product']  = $this->cashier->where('product.is_available', 1)->where('product.id_store', $this->session->userdata('id_store'))->count();
                    // foreach ($data['product'] as $row) {
                    //     $this->session->set_userdata('stock' . $row->id, $row->stock);
                    // }
                }

                $data['category']      = '';
            }

            echo json_encode(
                [
                    'statusCode'    => 200,
                    'html'          => $this->load->view('pages/cashier/load_more_item', $data, true),
                    'total_product' => $data['total_product']
                ]
            );
        } else {
            $data['product']        = $this->cashier->where('product.is_available', 1)
                ->where('product.id_store', $this->session->userdata('id_store'))
                ->limit_data($this->cashier->perPage, 0)->get();

            $data['category']      = '';

            echo json_encode(
                [
                    'statusCode'    => 200,
                    'html'          => $this->load->view('pages/cashier/load_more_item', $data, true),
                    'total_product' => $data['total_product']
                ]
            );
        }
    }

    public function struk($invoice)
    {
        $this->cashier->table = 'transaction';
        $data['invoice_detail'] = $this->cashier->select([
            'transaction.created_at', 'user.name', 'transaction.total'
        ])
            ->where('invoice', $invoice)->join('user')->first();

        $this->cashier->table = 'transaction_detail';
        $data['transaction'] = $this->cashier->select([
            'transaction.total', 'transaction.invoice',
            'transaction_detail.qty', 'transaction_detail.subtotal AS subtotal',
            'product.title AS title_product',
            'product.price'
        ])
            ->where('invoice', $invoice)
            ->joinTransaction('transaction')
            ->join('product')
            ->get();

        $this->cashier->table = 'transaction';
        $data['discount'] = $this->cashier->select([
            'transaction.discount_total', 'transaction.subtotal'
        ])
            ->where('invoice', $invoice)
            ->first();

        $data['invoice']    = $invoice;
        $this->load->view('pages/cashier/invoice/struk', $data);
    }

    public function invoice($invoice = '', $pdf = '')
    {
        $this->cashier->table = 'transaction';
        $data['invoice_detail'] = $this->cashier->select([
            'transaction.created_at', 'user.name', 'transaction.total', 'transaction.id_store',
            'transaction.method_payment', 'customer.name AS name_customer'
        ])
            ->where('invoice', $invoice)->join('customer')->join('user')->first();

        $this->cashier->table = 'store';
        $data['store']        = $this->cashier->select([
            'address', 'phone', 'name'
        ])
            ->where('id', $data['invoice_detail']->id_store)
            ->first();

        $this->cashier->table = 'transaction_detail';
        $data['transaction'] = $this->cashier->select([
            'transaction.total', 'transaction.invoice',
            'transaction_detail.qty', 'transaction_detail.subtotal AS subtotal',
            'product.title AS title_product',
            'product.price'
        ])
            ->where('invoice', $invoice)
            ->joinTransaction('transaction')
            ->join('product')
            ->get();

        $this->cashier->table = 'transaction';
        $data['discount'] = $this->cashier->select([
            'transaction.discount_total', 'transaction.subtotal', 'transaction.cash_payment',
            'transaction.money_change'
        ])
            ->where('invoice', $invoice)
            ->first();

        $data['invoice']    = $invoice;
        if ($pdf != '') {
            $this->mypdf->generate('pages/cashier/invoice/invoice_pdf', $data, 'invoice-' . $invoice, 'A4', 'portrait');
        } else {
            $this->load->view('pages/cashier/invoice/struk', $data);
        }
    }

    public function tes_struk()
    {
        $this->load->view('pages/cashier/invoice/struk');
    }

    public function clearCartQueue()
    {
        $items = $this->session->userdata('item_from_db');
        $carts = $this->cart->contents();

        if ($this->input->is_ajax_request()) {
            foreach ($carts as $cart) {
                foreach ($items as $item) {
                    if ($item['id'] == $cart['id']) {
                        $this->cart->remove($cart['rowid']);
                    }
                }
            }
        } else {
            echo '<h4>FORBIDDEN</h4>';
        }


        //print_r($carts);
    }

    public function showDataEditTransaction()
    {
        $invoice_number = $this->input->get('invoice', true);
        $sess           = $this->input->get('sess', true);
        $this->cashier->table = 'transaction_detail';
        $data['transaction'] = $this->cashier->select([
            'transaction.total', 'transaction.discount_total', 'transaction.subtotal', 'transaction.invoice',
            'transaction_detail.id_product', 'transaction_detail.qty', 'variant.price AS price_variant',
            'product.title', 'product.price'
        ])

            ->join('product')
            ->join('variant')
            ->joinTransaction('transaction')
            ->where('transaction.invoice', $invoice_number)
            ->get();


        $this->cashier->table = 'transaction';
        $data['customer'] = $this->cashier->select([
            'customer.name', 'customer.id'
        ])
            ->join('customer')
            ->where('transaction.invoice', $invoice_number)
            ->first();

        $data['total_in_db'] = $this->cashier->select([
            'total', 'subtotal', 'discount_total', 'purchase_price_total'
        ])->where('invoice', $invoice_number)->first();


        if ($sess != "" || $sess != null) {
            //set sess
            $data_sess = [
                'total_db'                  => $data['total_in_db']->total,
                'subtotal_db'               => $data['total_in_db']->subtotal,
                'discount_total_db'         => $data['total_in_db']->discount_total,
                'purchase_price_total_db'   => $data['total_in_db']->purchase_price_total,
            ];

            $this->session->set_userdata($data_sess);
        }


        //item
        $data['cart']           = $this->cart->contents();
        $data['totalCart']      = $this->cart->total();

        $data['sub_total']       = array();
        $data['disc_total']      = array();
        $data['purchase_price_total']      = array();
        foreach ($data['cart'] as $row) {
            array_push($data['sub_total'], ($row['option']['price_temp']) * $row['qty']);
            array_push($data['disc_total'], ($row['option']['discount_temp']) * $row['qty']);
            array_push($data['purchase_price_total'], ($row['option']['purchase_price']) * $row['qty']);
        }

        $this->session->set_userdata('edit_transaction', 1);
        $this->session->set_userdata('invoice_edit', $invoice_number);
        $this->load->view('pages/cashier/table_cart', $data);
        //print_r($data['transaction']);
    }

    function loadDataSessEditTrasaction()
    {
        $invoice_number = $this->input->get('invoice', true);

        $this->cashier->table = 'transaction';
        $data['total_in_db'] = $this->cashier->select([
            'total', 'subtotal', 'discount_total', 'purchase_price_total'
        ])->where('invoice', $invoice_number)->first();


        //set sess
        $data_sess = [
            'total_db'                  => $data['total_in_db']->total,
            'subtotal_db'               => $data['total_in_db']->subtotal,
            'discount_total_db'         => $data['total_in_db']->discount_total,
            'purchase_price_total_db'   => $data['total_in_db']->purchase_price_total,
        ];

        $this->session->set_userdata($data_sess);
    }


    public function save_deleted_data_edit_transaction()
    {
        $id_product = $this->input->get('id_product', true);
        $invoice_number = $this->input->get('invoice', true);
        $arr = $this->session->userdata('deleted_data');
        array_push($arr, [
            'id_product'       => $id_product,
            'invoice_number'    => $invoice_number,
        ]);

        $this->session->set_userdata('deleted_data', $arr);



        //print_r($this->deleted_sess);
    }

    /**
     * 
     * method for refund transaction
     */
    public function refund()
    {
        if ($this->input->is_ajax_request()) {
            $invoice = $this->input->get('invoice', true);
            $reason = $this->input->get('reason', true);
            $another_reason = $this->input->get('another_reason', true);

            $this->cashier->table = 'transaction';
            //get data transaction first
            $getTrans = $this->cashier->where('invoice', $invoice)->first();
            $data_to_refund = [
                'invoice'                   => $getTrans->invoice,
                'id_user'                   => $getTrans->id_user,
                'id_customer'               => $getTrans->id_customer == "" || $getTrans->id_customer == null ? null : $getTrans->id_customer,
                'id_store'                  => $getTrans->id_store,
                'subtotal'                  => $getTrans->subtotal,
                'purchase_price_total'      => $getTrans->purchase_price_total,
                'discount_total'            => $getTrans->discount_total,
                'total'                     => $getTrans->total,
                'cash_payment'              => $getTrans->cash_payment,
                'money_change'              => $getTrans->money_change,
                'method_payment'            => $getTrans->method_payment,
                'bank'                      => $getTrans->bank == "" || $getTrans->bank == null ? null : $getTrans->bank,
                'reason'                    => $another_reason == "" || $another_reason == null ? $reason : $another_reason
            ];




            $this->cashier->table = 'refund';
            if ($this->cashier->add($data_to_refund)) {

                $this->cashier->table = 'transaction_detail';
                $get_transaction_detail = $this->cashier->where('invoice_transaction', $invoice)->get();


                $id_product_refund = [];
                foreach ($get_transaction_detail as $transaction_detail) {
                    $this->cashier->table = 'refund_detail';
                    $data_refund_detail = [
                        'invoice_refund'        => $transaction_detail->invoice_transaction,
                        'id_product'            => $transaction_detail->id_product,
                        'id_variant'            => $transaction_detail->id_variant,
                        'qty'                   => $transaction_detail->qty,
                        'subtotal'              => $transaction_detail->subtotal,
                    ];
                    if ($this->cashier->add($data_refund_detail) == true) {
                        $this->cashier->table = 'product';
                        $stok_product = $this->cashier->select(['stock', 'id_category'])->where('id', $transaction_detail->id_product)->first();
                        if ($stok_product->id_category == '102002') {
                            $data_update_stock = [
                                'stock'             => $transaction_detail->qty + $stok_product->stock
                            ];
                            if ($this->cashier->where('id', $transaction_detail->id_product)->update($data_update_stock)) {
                                $this->session->set_userdata('stock' . $transaction_detail->id_product, $data_update_stock['stock']);
                                array_push($id_product_refund, [
                                    'id_product'            => $transaction_detail->id_product,
                                    'curr_stock'            => $data_update_stock['stock']
                                ]);
                            }
                        }
                    }
                }

                $this->cashier->table = 'transaction';
                $this->cashier->where('invoice', $invoice)->delete();



                $this->cashier->table = 'transaction_detail';
                $this->cashier->where('invoice_transaction', $invoice)->delete();
                echo json_encode([
                    'statusCode'        => 200,
                    'title'             => 'Success!',
                    'msg'               => 'Data has been refunded',
                    'type'              => 'success',
                    'id_product_refund' => json_encode($id_product_refund),
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'title'             => 'Oops!',
                    'msg'               => 'Something went wrong',
                    'type'              => 'error'
                ]);
            }
        } else {
            echo '<h4>FORBIDDEN</h4>';
        }
    }

    public function show_cart()
    {
        print_r($this->session->userdata('deleted_data'));
    }
}

/* End of file Cashier.php */
