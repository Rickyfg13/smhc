<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Libraries extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'admin' || $role == 'admin_store') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }

    public function index()
    {
    }

    public function incoming_items()
    {
        $data['content']        = $this->libraries->get();

        //list category
        $this->libraries->table = 'product';
        $data['product']        = $this->libraries->where('id_store', $this->session->userdata('id_store'))
            ->where('id_category', '102002') //product
            ->get();
        $data['title']          = 'Incoming Items';
        $data['page_title']     = 'Incoming Items - Incoming Items List - Admin KasirKu';
        $data['nav_title']      = 'library';
        $data['detail_title']   = 'incoming_items';
        $data['page']           = 'pages/admin/libraries/incoming_items/index';

        $this->view($data);
    }

    public function loadTable()
    {
        $this->libraries->table = 'product_in';
        $data['content']        = $this->libraries->select([
            'product_in.id AS id_product_in', 'product_in.id_product AS id_product',
            'product_in.stock_in', 'product_in.note', 'product_in.created_at AS created_at_product_in',
            'product.title', 'product.stock'
        ])
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->join('product')
            ->orderBy('created_at_product_in', 'DESC')
            ->get();

        $this->load->view('pages/admin/libraries/incoming_items/data/table', $data);
    }

    public function insert()
    {
        $id_product_in = $this->input->post('id_product_in', true);
        $stock_in   = $this->input->post('stock_in', true);
        $note       = $this->input->post('note', true);



        if (!$this->libraries->validate()) {
            $array = array(
                'error'               => true,
                'statusCode'          => 400,
                'id_product_in_error' => form_error('id_product_in'),
                'stock_in_error'      => form_error('stock_in'),

            );

            echo json_encode($array);
        } else {
            $this->libraries->table = 'product';
            $purchase_price_product = $this->libraries->select(['product.purchase_price'])->where('id', $id_product_in)->first();
            $curr_stock = $this->libraries->select(['product.stock'])->where('id', $id_product_in)->first();

            $digits     = 4;
            $data = array(
                'id'            => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                'id_product'    => $id_product_in,
                'stock_in'      => $stock_in,
                'curr_stock'    => $curr_stock->stock + $stock_in,
                'total_purchase' => $purchase_price_product->purchase_price * $stock_in,
                'note'          => $note != "" ? $note : "-"
            );

            $this->libraries->table = 'product_in';
            $countProductIn = $this->libraries->where('id_product', $data['id_product'])->where('DATE(created_at)', date('Y-m-d'))->count();
            $productIn = $this->libraries->where('id_product', $data['id_product'])->where('DATE(created_at)', date('Y-m-d'))->first();
            if ($countProductIn <= 0) {
                if ($this->libraries->add($data) == true) {
                    $this->session->set_flashdata('success', 'Data has been added!');

                    //update stock di inventori
                    $this->libraries->table = 'product';
                    $product = $this->libraries->where('id', $data['id_product'])->first();
                    $stock_product = $product->stock;
                    $stock_product_updated = $stock_in + $stock_product;




                    $this->libraries->where('id', $data['id_product'])->update(['stock' => $stock_product_updated]);

                    echo json_encode(array(
                        'statusCode'        => 200
                    ));
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                    echo json_encode(array(
                        'statusCode'    => 201,
                    ));
                }
            } else {


                $data_update = [
                    'stock_in' => $stock_in + $productIn->stock_in,
                    'curr_stock'    => $productIn->curr_stock + $stock_in,
                    'total_purchase'    => ($purchase_price_product->purchase_price * $stock_in) + $productIn->total_purchase,

                ];



                $this->libraries->table = 'product_in';
                if ($this->libraries->where('id_product', $id_product_in)->where('DATE(created_at)', date('Y-m-d'))->update($data_update)) {
                    $this->session->set_flashdata('success', 'Data has been added!');

                    //update stock di inventori
                    $this->libraries->table = 'product';
                    $product = $this->libraries->where('id', $data['id_product'])->first();

                    $stock_product = $product->stock;
                    $stock_product_updated = $stock_in + $stock_product;

                    $this->libraries->where('id', $data['id_product'])->update(['stock' => $stock_product_updated]);

                    echo json_encode(array(
                        'statusCode'        => 200
                    ));
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                    echo json_encode(array(
                        'statusCode'    => 201,
                    ));
                }
            }
        }
    }

    public function edit($id)
    {
        $data['title']          = 'Edit Incoming Items';

        $this->libraries->table = 'product_in';
        $data['getProductIn']   = $this->libraries->select([
            'product_in.id AS id_product_in', 'product_in.id_product AS id_product',
            'product_in.stock_in', 'product_in.note', 'product_in.created_at AS created_at_product_in',
            'product.title'
        ])
            ->join('product')
            ->where('product_in.id', $id)
            ->first();

        $this->libraries->table = 'product';
        $data['product']        = $this->libraries->get();
        $this->output->set_output(show_my_modal('pages/admin/libraries/incoming_items/modal/modal_edit_product_in', 'modal-edit-product-in', $data, 'lg'));
    }

    public function update()
    {
        $id            = $this->input->post('id', true);
        $id_product_in = $this->input->post('id_product_in', true);
        $stock_in   = $this->input->post('stock_in', true);
        $note       = $this->input->post('note', true);



        if (!$this->libraries->validate()) {
            $array = array(
                'error'               => true,
                'statusCode'          => 400,
                'id_product_in_error' => form_error('id_product_in'),
                'stock_in_error'      => form_error('stock_in'),

            );

            echo json_encode($array);
        } else {

            $this->libraries->table = 'product';
            $purchase_price_product = $this->libraries->select(['product.purchase_price'])->where('id', $id_product_in)->first();
            $stock_product          = $this->libraries->select(['product.stock'])->where('id', $id_product_in)->first();


            $digits     = 4;
            $this->libraries->table = 'product_in';

            $stock_in_sebelumnya  = $this->libraries->select([
                'product_in.stock_in'
            ])->where('id', $id)
                ->first();


            $data = array(
                'id'            => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                'id_product'    => $id_product_in,
                'stock_in'      => $stock_in,
                'total_purchase' => $purchase_price_product->purchase_price * $stock_in,
                'note'          => $note != "" ? $note : "-"
            );

            if ($this->libraries->where('id', $id)->update($data)) {
                $this->session->set_flashdata('success', 'Data has been updated!');

                //update stock di inventori
                $this->libraries->table = 'product';
                $product = $this->libraries->where('id', $data['id_product'])->first();

                $stock_product = $product->stock;
                $stock_product_updated = $stock_in + ($stock_product - $stock_in_sebelumnya->stock_in);

                $this->libraries->where('id', $data['id_product'])->update(['stock' => $stock_product_updated]);

                echo json_encode(array(
                    'statusCode'        => 200
                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    'statusCode'    => 201,
                ));
            }
        }
    }

    public function destroy($id, $stock = '')
    {

        if ($this->input->is_ajax_request()) {
            $this->libraries->table = 'product_in';
            $product_in = $this->libraries
                ->join('product')
                ->where('product_in.id', $id)
                ->first();

            $id_product = $product_in->id_product;
            $stock_in   = $product_in->stock_in;



            $this->libraries->table = 'product';
            $this->libraries->where('id', $id_product)->update(
                [
                    'stock'         => $stock - $stock_in < 0 ? 0 : $stock - $stock_in
                ]
            );

            $this->libraries->table = 'product_in';
            if ($this->libraries->where('id', $id)->delete()) {

                $this->session->set_flashdata('success', 'Data has been deleted!');
                echo json_encode(array(
                    "statusCode" => 200,

                ));
            } else {
                $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                echo json_encode(array(
                    "statusCode" => 201,
                ));
            }
        } else {
            echo '<h3>FORBIDDEN</h3>';
        }
    }

    public function items_sales()
    {
        $data['content']            = $this->libraries->get();

        $data['title']              = 'Items Sales';
        $data['page_title']         = 'Items Sales - Items Sales List - Admin KasirKu';
        $data['nav_title']          = 'library';
        $data['detail_title']       = 'items_sales';
        $data['page']               = 'pages/admin/libraries/items_sales/index';

        $this->view($data);
    }

    public function loadTableItemsSales()
    {
        $this->libraries->table = 'transaction_detail';

        $data['content']        = $this->libraries->select([
            'SUM(transaction_detail.qty) AS stock_out', 'transaction.created_at', 'product.title', 'product.stock'
        ])
            ->join('product')
            ->joinTransaction('transaction')
            ->groupBy('product.title')
            //->where('MONTH(transaction.created_at)', date('m'))
            ->where('YEAR(transaction.created_at)', date('Y'))
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->get();


        $this->load->view('pages/admin/libraries/items_sales/data/table', $data);
    }

    public function move_items()
    {

        $data['store']          = $this->store->get();
        $data['title']          = 'Move Items';
        $data['page_title']     = 'Move Items - Move Items List - Admin KasirKu';
        $data['nav_title']      = 'library';
        $data['detail_title']   = 'move_items';
        $data['page']           = 'pages/admin/libraries/move_items/index';

        $this->view($data);
    }

    public function loadDataMoveItems()
    {
        $data['content']        = $this->inventory->select([
            'product.id', 'product.title', 'product.stock', 'product.price', 'product.id_store',
            'product.created_at', 'category.title AS category_title', 'store.name'
        ])
            ->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('id_category', '102002') //product
            ->where('stock >', 0)
            ->join('category')
            ->join('store')
            ->orderBy('product.id', 'DESC')->get();
        $this->load->view('pages/admin/libraries/move_items/data/table', $data);
    }

    public function insert_item_move()
    {
        $id_product = $this->input->post('id_product', true);
        $id_store   = $this->input->post('id_store', true);
        $id_store_asal   = $this->session->userdata('id_store');
        $title      = $this->input->post('title', true);
        $quantity   = $this->input->post('quantity', true);
        $note = $this->input->post('note', true);

        $this->load->model('admin/productmove_model');
        if (!$this->productmove->validate()) {
            $arr = [
                'error'         => true,
                'statusCode'    => 400,
                'id_store_error' => form_error('id_store'),
                'quantity_error' => form_error('quantity')
            ];

            echo json_encode($arr);
        } else {
            $this->libraries->table = 'store';
            $slugStoreFrom = $this->libraries->select(['slug_store'])
                ->where('id', $id_store_asal)->first();
            $slugStoreTo = $this->libraries->select(['slug_store'])
                ->where('id', $id_store)->first();


            //continue
            $this->libraries->table = 'product';
            //cek produk toko tujuan
            $cekProduct = $this->libraries->where('id_category', '102002')
                ->where('title', $title)
                ->where('id_store', $id_store)
                ->first();

            $hitungProduct = $this->libraries->where('id_category', '102002')
                ->where('title', $title)
                ->where('id_store', $id_store)
                ->count();

            //get product asal
            $productAsal = $this->libraries->where('id_category', '102002')
                ->where('title', $title)
                ->where('id_store', $id_store_asal)
                ->first();


            if ($hitungProduct > 0) { //jika ada
                $data = [
                    'stock'     => $cekProduct->stock + $quantity
                ];

                //update data toko tujuan
                $this->libraries->where('id_category', '102002')
                    ->where('title', $title)
                    ->where('id_store', $id_store)
                    ->update($data);

                $data_asal = [
                    'stock'     => $productAsal->stock - $quantity
                ];


                //update data toko asal
                $this->libraries->where('id_category', '102002')
                    ->where('title', $title)
                    ->where('id_store', $id_store_asal)
                    ->update($data_asal);


                //tambahkan ke db product_move
                $digits = 3;
                $data_product_move = [
                    'id'        => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                    'id_product' => $id_product,
                    'stock_move' => $quantity,
                    'curr_stock_from' => $productAsal->stock - $quantity,
                    'curr_stock_to'  => $cekProduct->stock + $quantity,
                    'id_store_form'  => $id_store_asal,
                    'id_store'       => $id_store,
                    'note'           => $note,
                ];

                $this->libraries->table = 'product_move';
                if ($this->libraries->add($data_product_move) == true) {
                    echo json_encode([
                        'statusCode'   => 200,
                    ]);
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                    echo json_encode(array(
                        'statusCode'    => 201,
                    ));
                }
            } else {

                //add data to product store tujuan
                $data_add = [
                    'id'                => $this->generate_code('102002'),
                    'id_category'       => '102002',
                    'id_store'          => $id_store,
                    'slug'              => str_replace($slugStoreFrom, $slugStoreTo, $productAsal->slug),
                    'title'             => $productAsal->title,
                    'stock'             => $quantity,
                    'price'             => $productAsal->price,
                    'purchase_price'    => $productAsal->purchase_price,
                    'is_available'      => 1,
                ];

                $this->libraries->table = 'product';
                $this->libraries->add($data_add);

                $data_update_asal = [
                    'stock'         => $productAsal->stock - $quantity,
                ];

                $this->libraries->where('id_category', '102002')
                    ->where('title', $title)
                    ->where('id_store', $id_store_asal)
                    ->update($data_update_asal);


                //tambahkan ke db product_move
                $digits = 3;
                $data_product_move = [
                    'id'        => date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1),
                    'id_product' => $id_product,
                    'stock_move' => $quantity,
                    'curr_stock_from' => $productAsal->stock - $quantity,
                    'curr_stock_to'  => $quantity,
                    'id_store_form'  => $id_store_asal,
                    'id_store'       => $id_store,
                    'note'           => $note,
                ];

                $this->libraries->table = 'product_move';
                if ($this->libraries->add($data_product_move) == true) {
                    echo json_encode([
                        'statusCode'   => 200,
                    ]);
                } else {
                    $this->session->set_flashdata('error', 'Oops! Something went wrong!');
                    echo json_encode(array(
                        'statusCode'    => 201,
                    ));
                }
            }
        }
    }

    public function tes()
    {
        // $this->libraries->table = 'product';
        // $slugProduct = $this->libraries->select(['product.slug', 'store.slug_store'])
        //     ->join('store')->where('product.id', '1020020063')->first();

        // print_r($slugProduct);
        // $slug = 'acne-serum-1-1';
        // $getIdStore =  substr($slug, -2);

        // echo $getIdStore;
        //echo str_replace($getIdStore, "", $slug);
        // if(strpos($slug, '-2')) {
        //     echo 'true';
        // }

        $slugProduct = 'acne-serum-2-bandar-damar';
        echo str_replace('bandar-damar', 'siteba', $slugProduct);
    }

    public function update_product()
    {
        $this->libraries->table = 'product';
        $product = $this->libraries->where('id_store', 2)->where('id_category', '102002')->get();

        $data = [];
        print_r($product);
        foreach ($product as $row) {
            // $this->libraries->where('id_store', 1)->where('id_category', '102002')
            //     ->update([
            //         'slug'  => $row->slug . '-1'
            //     ]);

            array_push($data, [
                'title'     => $row->title,
                'slug'      => $row->slug,
            ]);
        }

        // foreach ($data as $row) {
        //     $this->libraries->where('id_store', 2)
        //         ->where('id_category', '102002')
        //         ->where('title', $row['title'])
        //         ->update(['slug'    => $row['slug'] . '-bandar-damar']);
        // }

        //print_r($data);
    }

    public function generate_code($id_category)
    {
        $get_code = getCodeProduct($id_category);
        $last_code = isset($get_code->id) ? $get_code->id : "";

        if ($last_code != "") {
            $urutan = (int) substr($last_code, 6);
        } else {
            $urutan = 0;
        }

        $urutan++;

        $kodeBaru = $id_category . sprintf("%04s", $urutan);
        return $kodeBaru;
    }
}

/* End of file Libraries.php */
