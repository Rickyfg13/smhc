<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Medicalrecord extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $role = $this->session->userdata('role');

        if ($role == 'doctor' || $role == 'cashier') {
            return;
        } else {
            $this->session->set_flashdata('warning', "You Don't Have Access");
            redirect(base_url() . 'auth/login');
            return;
        }
    }

    public function index()
    {
        $data['page_title']          = 'Doctor - Medical Records History';
        $data['nav_title']      = 'medical_records_history';
        $data['detail_title']   = 'cashier';

        $this->medicalrecord->table = 'medical_records';
        $data['patients']       = $this->medicalrecord->select([
            'customer.id', 'customer.name', 'customer.phone', 'customer.address', 'medical_records.id as id', ' customer.birth_date'
        ])
            ->join('customer')
            ->orderBy('medical_records.created_at', 'DESC')
            ->get();
        $data['page']           = 'pages/doctor/medical-records/history/index';
        // var_dump($data['patients']);die;

        if ($this->session->userdata('role') == 'doctor') {
            $this->view_doctor($data);
        } else {
            $this->view_cashier($data);
        }
    }

    public function detail($id_medical_record)
    {
        // ! dispatch browser event
        // $data['patients'] = $this->db->get_where('medical_records', ['id' => $medical_record])
        // ->join('queue')
        // ->join('doctor')
        // ->join('medical_detail_records')
        // ->join('customer');
        
       
        $query = "SELECT `medical_records_detail`.*, `doctor`.`name` AS `doctor_name`,`store`.`name` AS `store_name`

        FROM `medical_records_detail`
        INNER JOIN `doctor` ON `medical_records_detail`.`id_doctor`=`doctor`.`id`    
        INNER JOIN `store` ON `medical_records_detail`.`id_store`=`store`.`id`     
        INNER JOIN `medical_records` ON `medical_records_detail`.`id_medical_records`=`medical_records`.`id`    
        
        WHERE `medical_records`.`id`= $id_medical_record
        ";


        $data['detail'] = $this->db->query($query)->row_array();

        // $data['product'] = $this->Medicalrecord_model->getProduct();

        var_dump($data);
        die;

        $this->load->view('pages/doctor/medical-records/history/detail', $data);
    }

    public function load_data_medical_records_another_clinic($phone, $name, $id_store)
    {
        //ambil nomor hp pasient di store lainnya ex: siteba clinic
        $this->medicalrecord->table = 'customer';
        $data['patient'] = $this->medicalrecord
            ->where('phone', $phone)
            ->where('name', urldecode($name))
            ->where('id_store', $id_store)
            ->first();

        if ($data['patient']) {
            //jika data ada

            //save id customer to variable $id_customer
            $id_customer = $data['patient']->id;

            //ambil data rekam medis patient
            $this->medicalrecord->table = 'medical_records';
            $data['getMedicalRecord']   = $this->medicalrecord->select([
                'medical_records_detail.anamnesa', 'medical_records_detail.diagnosa', 'medical_records_detail.pemeriksaan',
                'medical_records_detail.created_at', 'medical_records_detail.id_therapies', 'medical_records_detail.id_items',
                'medical_records_detail.note'
            ])
                ->join2('medical_records_detail')
                ->where('medical_records.id_customer', $id_customer)
                ->orderBy('medical_records_detail.created_at', 'ASC')
                ->get();

            //cek apakah data ada
            if (count($data['getMedicalRecord']) > 0) {
                //menyimpan data nomor rekam medis
                $data['noRm']               = $this->medicalrecord->select([
                    'id'
                ])->where('id_customer', $id_customer)->first();

                //menyimpan data list data terapi pada rekam medis
                $this->medicalrecord->table = 'therapies_detail';
                foreach ($data['getMedicalRecord'] as $row) {
                    $data['therapies'][$row->id_therapies] = $this->medicalrecord->select([
                        'product.title'
                    ])->join('product')->where('therapies_detail.id_therapies', $row->id_therapies)->get();
                }


                //menyimpan data list data item pada rekam medis
                $this->medicalrecord->table = 'items_detail';
                foreach ($data['getMedicalRecord'] as $row) {
                    $data['items'][$row->id_items] = $this->medicalrecord->select([
                        'product.title'
                    ])->join('product')->where('items_detail.id_items', $row->id_items)->get();
                }

                $data['id_customer']        = $id_customer;
                $this->load->view('pages/doctor/medical-records/history/data/data-medical-records-another-clinic', $data);
            } else {
                echo 'Medical Record Not Found';
            }
        } else {
            //jika data tidak ada
            echo 'Data Not Found';
        }
    }

    public function load_data_medical_records($id_customer)
    {

        $this->medicalrecord->table = 'medical_records_detail';
        $data['getPatients']        = $this->medicalrecord
            ->select([
                'medical_records_detail.anamnesa', 'medical_records_detail.diagnosa', 'medical_records_detail.pemeriksaan',
                'medical_records_detail.created_at', 'medical_records_detail.id_therapies',  'medical_records_detail.id_items',
                'medical_records_detail.note', 'doctor.name AS doctor_name', 'store.name AS store_name',
            ])
            ->join('medical_records')
            ->join('doctor')
            ->join('store')
            ->where('medical_records.id_customer', $id_customer)
            ->orderBy('medical_records_detail.created_at', 'ASC')
            ->get();


        $this->medicalrecord->table = 'medical_records';
        $data['noRm']               = $this->medicalrecord->select([
            'id'
        ])->where('id_customer', $id_customer)->first();


        $this->medicalrecord->table = 'therapies_detail';
        foreach ($data['getPatients'] as $row) {
            $data['therapies'][$row->id_therapies] = $this->medicalrecord->select([
                'product.title'
            ])->join('product')->where('therapies_detail.id_therapies', $row->id_therapies)->get();
        }

        $this->medicalrecord->table = 'items_detail';
        foreach ($data['getPatients'] as $row) {
            $data['items'][$row->id_items] = $this->medicalrecord->select([
                'product.title'
            ])->join('product')->where('items_detail.id_items', $row->id_items)->get();
        }

        $this->medicalrecord->table = 'customer';
        $data['patients']            = $this->medicalrecord->where('id', $id_customer)->first();

        $data['id_customer']        = $id_customer;

        // $data['customers'] = $this->db->get('customer')->result();
        // var_export($data['customers']);
        // die;
        $this->load->view('pages/doctor/medical-records/history/data/data-medical-records', $data);
    }

    public function add_medical_record()
    {
        $digits = 4;

        //to tb medical_records
        $id = $this->medical_record_number();
        $id_doctor = $this->session->userdata('id_doctor');
        $id_queue = $this->input->post('id_queue', true);
        $id_customer = $this->input->post('id_customer', true);
        $id_store = $this->session->userdata('id_store');
        //$rm_number = $this->medical_record_number_check($id_customer);

        //to tb medical_records_detail
        $anamnesa = $this->input->post('anamnesa', true);
        $diagnosa = $this->input->post('diagnosa', true);
        $therapy = $this->input->post('therapy', true);
        $cek_therapy = (array) $therapy;
        $products = $this->session->userdata('products');
        $id_therapies = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $id_items = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $note = $this->input->post('note', true);

        if (!$this->medicalrecord->validate()) {
            $arr = array(
                'error'                 => true,
                'statusCode'            => 400,
                'anamnesa_error'        => form_error('anamnesa'),
                'diagnosa_error'        => form_error('diagnosa'),
                'therapy_error'         => form_error('therapy[]'),
            );

            echo json_encode($arr);
        } else {
            $data = array(
                'id'            => $id,
                'id_doctor'     => $id_doctor,
                'id_customer'   => $id_customer,
                'id_store'      => $id_store

            );

            $data_detail = array(
                'id'                    => rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis'),
                'id_medical_records'    => $id,
                'id_doctor'             => $id_doctor,
                'anamnesa'              => $anamnesa,
                'diagnosa'              => $diagnosa,
                'id_therapies'          => count($cek_therapy) > 0 ? $id_therapies : null,
                'id_items'              => $products ? $id_items : null,
                'id_queue'              => $id_queue,
                'note'                  => $note,
                'id_store'              => $id_store

            );

            $data_therapies = array(
                'id'        => $id_therapies,
                'note'      => $note
            );

            $data_items     = array(
                'id'        => $id_items,
                'note'      => '',
            );


            //add medical record jika pasien baru
            $check_rm = $this->medicalrecord->where('id_customer', $id_customer)->count();
            if ($check_rm == 0) {
                //add to table medical_records
                if ($this->medicalrecord->add($data) == true) {
                    if ($products) {
                        //add to items
                        $this->medicalrecord->table = 'items';
                        if ($this->medicalrecord->add($data_items)) {
                            $data_items_detail = array();

                            foreach ($products as $product) {
                                array_push($data_items_detail, array(
                                    'id'            => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                                    'id_product'    => $product->id_product,
                                    'qty'           => $product->qty,
                                    'id_items'      => $id_items
                                ));
                            }
                            $this->db->insert_batch('items_detail', $data_items_detail);
                        }
                    }


                    //add to table therapies
                    $this->medicalrecord->table = 'therapies';
                    if ($this->medicalrecord->add($data_therapies) == true) {
                        $data_therapies_detail = array();
                        if (count($cek_therapy) > 0) {
                            foreach ($therapy as $row) {

                                array_push($data_therapies_detail, array(
                                    'id'            => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                    'id_product'    => $row,
                                    'id_therapies'  => $id_therapies
                                ));
                            }

                            //add to table therapis_detail
                            $this->db->insert_batch('therapies_detail', $data_therapies_detail);
                        }


                        //add to table medical_records_detail
                        $this->medicalrecord->table = 'medical_records_detail';
                        if ($this->medicalrecord->add($data_detail)) {

                            //update queue to on progress
                            $this->medicalrecord->table = 'queue';
                            $this->medicalrecord->where('queue.id', $id_queue)
                                ->update([
                                    'status'    => 'on_progress'
                                ]);
                            echo json_encode(array(
                                'statusCode'    => 200
                            ));
                        } else {
                            echo json_encode(array(
                                'statusCode'    => 201
                            ));
                        }
                    }
                }
            } else {

                //add medical record jika pasien lama

                //get id medical record based on id_customer
                $this->medicalrecord->table = 'medical_records';
                $id_medical_records = $this->medicalrecord->select(['id'])
                    ->where('id_customer', $id_customer)->first();

                //data medical_records_detail
                $data_detail2 = array(
                    'id'                    => rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis'),
                    'id_medical_records'    => $id_medical_records->id,
                    'id_doctor'             => $id_doctor,
                    'anamnesa'              => $anamnesa,
                    'diagnosa'              => $diagnosa,
                    'id_therapies'          => count($cek_therapy) > 0 ? $id_therapies : null,
                    'id_items'              => $products ? $id_items : null,
                    'id_queue'              => $id_queue,
                    'note'                  => $note,
                    'id_store'              => $id_store
                );

                if ($products) {
                    //add to items
                    $this->medicalrecord->table = 'items';
                    if ($this->medicalrecord->add($data_items)) {
                        $data_items_detail = array();

                        foreach ($products as $product) {
                            array_push($data_items_detail, array(
                                'id'            => date('YmdHis') . rand(pow(10, 4 - 1), pow(10, 4) - 1),
                                'id_product'    => $product->id_product,
                                'qty'           => $product->qty,
                                'id_items'      => $id_items
                            ));
                        }

                        $this->db->insert_batch('items_detail', $data_items_detail);
                    }
                }

                //add to table therapies
                $this->medicalrecord->table = 'therapies';
                if ($this->medicalrecord->add($data_therapies) == true) {
                    $data_therapies_detail = array();
                    if (count($cek_therapy) > 0) {
                        foreach ($therapy as $row) {

                            array_push($data_therapies_detail, array(
                                'id'            => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                'id_product'    => $row,
                                'id_therapies'  => $id_therapies
                            ));
                        }

                        //add to table therapies_detail
                        $this->db->insert_batch('therapies_detail', $data_therapies_detail);
                    }


                    //add to table medical_record_detail
                    $this->medicalrecord->table = 'medical_records_detail';
                    if ($this->medicalrecord->add($data_detail2)) {
                        //update queue on progress
                        $this->medicalrecord->table = 'queue';
                        $this->medicalrecord->where('queue.id', $id_queue)
                            ->update([
                                'status'    => 'on_progress'
                            ]);

                        echo json_encode(array(
                            'statusCode'    => 200
                        ));
                    } else {
                        echo json_encode(array(
                            'statusCode'    => 201
                        ));
                    }
                }
            }

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

            //get name customer
            $this->medicalrecord->table = 'customer';
            $customer_name = $this->medicalrecord->select([
                'name'
            ])->where('id', $id_customer)->first();

            $data_notif['msg']        = 'Medical Record for ' . $customer_name->name . ' has been added!';
            $data_notif['id_store_sess'] = $this->session->userdata('id_store');
            $data_notif['notif']      = 'add_medical_record';
            $pusher->trigger('my-channel', 'my-event', $data_notif);
        }
    }

    public function edit()
    {
        $data['id'] = $this->input->get('id');

        $data['title'] = 'Edit Medical Record Form';

        $this->medicalrecord->table      = 'medical_records';
        $data['dataMedicalRecord'] = $this->medicalrecord->select([
            'medical_records_detail.id',
            'medical_records_detail.id_queue', 'medical_records_detail.anamnesa',
            'medical_records_detail.pemeriksaan', 'medical_records_detail.diagnosa',
            'medical_records_detail.id_therapies', 'medical_records_detail.id_items'
        ])
            ->join2('medical_records_detail')
            ->where('medical_records_detail.id_queue', $data['id'])
            ->first();


        $this->medicalrecord->table = 'therapies';
        $data['dataTherapies'] = $this->medicalrecord->select([
            'therapies.id', 'therapies.note', 'therapies_detail.id_product'
        ])
            ->join2('therapies_detail')
            ->where('therapies.id', $data['dataMedicalRecord']->id_therapies)
            ->get();

        $data['note']         = $this->medicalrecord->select([
            'therapies.note'
        ])->where('therapies.id', $data['dataMedicalRecord']->id_therapies)->first();

        $this->medicalrecord->table      = 'product';
        $data['dataTherapy']    = $this->medicalrecord->where('id_category', '102001')->get();

        $this->medicalrecord->table      = 'items';
        $data['dataProduct']    = $this->medicalrecord->select([
            'items.id', 'items_detail.id_product', 'product.title', 'items_detail.qty'
        ])
            ->join2('items_detail')
            ->join_items_detail_to_product()
            ->where('items.id', $data['dataMedicalRecord']->id_items)
            ->orderBy('items_detail.id_product', 'ASC')
            ->get();

        $data_product_sess = [];

        foreach ($data['dataProduct'] as $product) {
            array_push($data_product_sess, [
                'id_product'        => $product->id_product,
                'qty'               => $product->qty
            ]);
        }






        $object = json_decode(json_encode($data_product_sess), FALSE);
        $this->session->set_userdata('products', $object);
        $getProduct = $this->session->userdata('products');

        $data['product'] = [];
        $this->medicalrecord->table = 'product';
        if ($getProduct) {
            foreach ($getProduct as $product) {
                $get_title_product = $this->medicalrecord->select(['product.id', 'product.title'])
                    ->where('product.id', $product->id_product)
                    ->first();

                array_push($data['product'], $get_title_product);
            }
        }

        //print_r($data_product_sess);
        echo json_encode([
            'html'          => show_my_modal('pages/doctor/modal/modal_edit_medical_record', 'modal-edit-medical-records', $data, 'lg'),
            'dataProduct'   => json_encode($data_product_sess)
        ]);
    }

    public function update_medical_record()
    {
        $this->medicalrecord->table = 'medical_records_detail';
        $id_medical_records = $this->input->post('id_medical_records', true);
        $id_therapies = $this->input->post('id_therapies', true);
        $id_items = $this->input->post('id_items', true);
        $anamnesa = $this->input->post('anamnesa', true);
        $pemeriksaan = $this->input->post('pemeriksaan', true);
        $diagnosa = $this->input->post('diagnosa', true);
        $therapy = $this->input->post('therapy', true);
        $cek_therapy = (array) $therapy;
        $note = $this->input->post('note', true);
        $digits = 4;
        $id_therapies_new = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $id_items_new = date('YmdHis') . rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        if (!$this->medicalrecord->validate()) {
            $arr = array(
                'error'                 => true,
                'statusCode'            => 400,
                'anamnesa_error'        => form_error('anamnesa'),
                'pemeriksaan_error'     => form_error('pemeriksaan'),
                'diagnosa_error'        => form_error('diagnosa'),
                'therapy_error'         => form_error('therapy[]'),
            );

            echo json_encode($arr);
        } else {
            $data = [
                'anamnesa'      => $anamnesa,
                'pemeriksaan'   => $pemeriksaan,
                'diagnosa'      => $diagnosa,
            ];

            $data_therapies = [
                'note'          => $note
            ];
            if ($this->medicalrecord->where('id', $id_medical_records)->update($data)) {

                //therapies
                if ($id_therapies == "") {


                    if (count($cek_therapy) > 0) {
                        $data_table_therapies = [
                            'id'            => $id_therapies_new,
                            'note'          => $note,

                        ];
                        $this->medicalrecord->table = 'therapies';
                        if ($this->medicalrecord->add($data_table_therapies) == true) {

                            $data_table_therapies_detail = array();

                            foreach ($therapy as $row) {
                                array_push($data_table_therapies_detail, [
                                    'id'            => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                    'id_product'    => $row,
                                    'id_therapies'  => $id_therapies_new
                                ]);
                            }

                            //add to table therapies_detail
                            $this->db->insert_batch('therapies_detail', $data_table_therapies_detail);

                            $this->medicalrecord->table = 'medical_records_detail';
                            $this->medicalrecord->where('id', $id_medical_records)->update([
                                'id_therapies'  => $id_therapies_new,
                            ]);
                        }
                    }
                } else {

                    $this->medicalrecord->table = 'therapies';
                    if ($this->medicalrecord->where('id', $id_therapies)->update($data_therapies)) {

                        $this->medicalrecord->table = 'therapies_detail';
                        $getTherapiesDetail = $this->medicalrecord->select(['id_product'])->where('id_therapies', $id_therapies)->orderBy('id_product')->get();


                        //update multiple select data terapi
                        $data_therapies_detail = [];
                        foreach ($getTherapiesDetail as $row) {
                            $data_therapies_detail[] = $row->id_product;
                        }

                        //add
                        if (count($cek_therapy) > 0) {
                            foreach ($therapy as $therapy_val) {
                                if (!in_array($therapy_val, $data_therapies_detail)) {
                                    $this->medicalrecord->add([
                                        'id'                => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                        'id_product'        => $therapy_val,
                                        'id_therapies'      => $id_therapies
                                    ]);
                                }
                            }
                        }


                        //delete
                        if (count($cek_therapy) > 0) {
                            foreach ($data_therapies_detail as $data_therapies_detail_row) {
                                if (!in_array($data_therapies_detail_row, $therapy)) {
                                    $this->medicalrecord->where('id_therapies', $id_therapies)
                                        ->where('id_product', $data_therapies_detail_row)->delete();
                                }
                            }
                        } else {
                            foreach ($data_therapies_detail as $data_table_therapies_detail_row2) {
                                $this->medicalrecord->where('id_therapies', $id_therapies)
                                    ->where('id_product', $data_table_therapies_detail_row2)->delete();
                            }
                        }


                        //if therapies_detail equal to 0 and set null id_therapies in medical_record_detail and delete data in table therapies
                        $cekTherapiesDetail = $this->medicalrecord->where('id_therapies', $id_therapies)->count();
                        if ($cekTherapiesDetail == 0) {
                            $this->medicalrecord->table = 'therapies';
                            $this->medicalrecord->where('id', $id_therapies)->delete();
                        }
                    }
                }

                if ($id_items == "") {


                    $getItem = $this->session->userdata('products');
                    if ($getItem) {
                        $getItemConv = json_decode(json_encode($getItem), TRUE);

                        $data_table_items = [
                            'id'            => $id_items_new,
                            'note'          => '',

                        ];
                        $this->medicalrecord->table = 'items';
                        if ($this->medicalrecord->add($data_table_items) == true) {
                            $data_table_items_detail = array();
                            foreach ($getItemConv as $dataItem) {
                                array_push($data_table_items_detail, [
                                    'id'            => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                    'id_product'    => $dataItem['id_product'],
                                    'qty'           => $dataItem['qty'],
                                    'id_items'      => $id_items_new,
                                ]);
                            }

                            $this->db->insert_batch('items_detail', $data_table_items_detail);

                            $this->medicalrecord->table = 'medical_records_detail';
                            $this->medicalrecord->where('id', $id_medical_records)->update([
                                'id_items'  => $id_items_new,
                            ]);
                        }
                    }
                } else {
                    $this->medicalrecord->table = 'items_detail';
                    $getItemsDetail = $this->medicalrecord->select([
                        'id_product', 'qty'
                    ])->where('id_items', $id_items)->orderBy('id_product')->get();

                    $getItemSess = $this->session->userdata('products');
                    $getItemSessConv = json_decode(json_encode($getItemSess), TRUE);



                    //update product
                    $data_items_detail = [];
                    foreach ($getItemsDetail as $row) {
                        $data_items_detail[] = [
                            'id_product'    => $row->id_product,
                            'qty'           => $row->qty
                        ];
                    }

                    //add
                    foreach ($getItemSessConv as $getItemSessVal) {
                        if (!in_array($getItemSessVal, $data_items_detail)) {
                            $this->medicalrecord->add([
                                'id'                => date('YmdHis') . rand(pow(10, 3 - 1), pow(10, 3) - 1),
                                'id_product'        => $getItemSessVal['id_product'],
                                'qty'               => $getItemSessVal['qty'],
                                'id_items'          => $id_items
                            ]);
                        }
                    }


                    //delete
                    foreach ($data_items_detail as $data_items_detail_row) {
                        if (!in_array($data_items_detail_row, $getItemSessConv)) {
                            $this->medicalrecord->where('id_items', $id_items)
                                ->where('qty', $data_items_detail_row['qty'])
                                ->where('id_product', $data_items_detail_row['id_product'])
                                ->delete();
                        }
                    }

                    $cekItemsDetail = $this->medicalrecord->where('id_items', $id_items)->count();
                    if ($cekItemsDetail == 0) {
                        $this->medicalrecord->table = 'items';
                        $this->medicalrecord->where('id', $id_items)->delete();
                    }
                }

                echo json_encode(array(
                    'statusCode'        => 200,
                    'msg'               => 'Medical Record has been updated!'
                ));
            } else {
                echo json_encode(array(
                    'statusCode'        => 201
                ));
            }
        }
    }

    public function medical_record_number()
    {
        $getMax = $this->medicalrecord->select([
            'MAX(id) AS id'
        ])->first();

        if ($getMax->id) {
            $code_from_db = $getMax->id;

            // Q3004210001
            $temp = (int) substr($code_from_db, 1);
            $temp++;

            $code = '2' . sprintf("%04s", $temp);

            return $code;
        } else {
            $code = '2' . '0001';
            return $code;
        }
    }


    public function medical_record_number_check($id_customer)
    {
        $check = $this->medicalrecord->where('id_customer', $id_customer)->get();
        $getMax = $this->medicalrecord->select([
            'MAX(rm_number) AS rm_number'
        ])->first();

        if (count($check) == 0) {

            $getRm = $getMax->rm_number;
            $temp = (int) substr($getRm, 0);
            $temp++;


            $code = sprintf("%04s", $temp);

            return $code;
        } else {
            $code = $getMax->rm_number;
            return $code;
        }
    }


    public function print($id_customer)
    {

        $this->medicalrecord->table = 'medical_records';
        $data['getPatients']        = $this->medicalrecord
            ->select([
                'medical_records_detail.anamnesa', 'medical_records_detail.diagnosa',
                'medical_records_detail.created_at', 'medical_records_detail.id_therapies', 'medical_records_detail.id_items',
            ])
            ->join2('medical_records_detail')
            ->where('medical_records.id_customer', $id_customer)->get();

        $data['noRm']               = $this->medicalrecord->select([
            'medical_records.id', 'doctor.name'
        ])
            ->join('doctor')
            ->where('medical_records.id_customer', $id_customer)
            ->first();


        $this->medicalrecord->table = 'therapies_detail';
        foreach ($data['getPatients'] as $row) {
            $data['therapies'][$row->id_therapies] = $this->medicalrecord->select([
                'product.title'
            ])->join('product')->where('therapies_detail.id_therapies', $row->id_therapies)->get();
        }

        $this->medicalrecord->table = 'items_detail';
        foreach ($data['getPatients'] as $row) {
            $data['items'][$row->id_items] = $this->medicalrecord->select([
                'product.title'
            ])->join('product')->where('items_detail.id_items', $row->id_items)->get();
        }

        $this->medicalrecord->table = 'customer';
        $data['patient']            = $this->medicalrecord->where('id', $id_customer)->first();
        $this->load->view('pages/doctor/medical-records/history/print/index', $data);
    }



    /**
     * 
     *
     * product section
     */

    public function searchProduct($keyword, $page = null)
    {
        $this->medicalrecord->table = 'product';
        $data['product']            = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->like('product.title', urldecode($keyword))
            ->paginate($page)
            ->get();

        $data['total_product'] = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->like('product.title', urldecode($keyword))
            ->count();

        echo json_encode(array(
            'statusCode'        => 200,
            'html'              => $this->load->view('pages/doctor/data/data_product', $data, true),
            'total_product'     => $data['total_product']
        ));
        //$this->load->view('pages/doctor/data/data_product', $data);
    }
    public function showProduct($page = null)
    {
        $this->medicalrecord->table = 'product';
        $data['product']        = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->paginate($page)
            ->get();
        $data['total_product']  = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->count();

        $this->load->view('pages/doctor/data/data_product', $data);
    }

    public function showProductMore($page = null)
    {
        $this->medicalrecord->table = 'product';
        $data['product']        = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->paginate($page)
            ->get();
        $data['total_product']  = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->count();

        echo json_encode(array(
            'statusCode'        => 200,
            'html'              => $this->load->view('pages/doctor/data/data_product_more', $data, true),
            'total_product'     => $data['total_product']
        ));
    }

    public function searchProductMore($keyword, $page = null)
    {
        $this->medicalrecord->table = 'product';
        $data['product']            = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->like('product.title', urldecode($keyword))
            ->paginate($page)
            ->get();

        $data['total_product'] = $this->medicalrecord->where('product.is_available', 1)
            ->where('product.id_store', $this->session->userdata('id_store'))
            ->where('product.id_category', '102002')
            ->like('product.title', urldecode($keyword))
            ->count();

        echo json_encode(array(
            'statusCode'        => 200,
            'html'              => $this->load->view('pages/doctor/data/data_product_more', $data, true),
            'total_product'     => $data['total_product']
        ));
    }


    public function storeProduct()
    {
        // $products = $this->input->post('products');
        // $qty_products = $this->input->post('qty_products');
        // $data_products = json_decode($products);
        // $data_qty_products = json_decode($qty_products);
        $data_products = $this->session->userdata('products');
        // if(count($data_products) == 0 && count($data_qty_products) == 0) {
        //     // print_r($data_products);
        //     echo 'tidak perlu set session';
        //     // print_r($data_qty_products);
        // } else {
        //     echo 'perlu set session';
        // }

        //$this->session->set_userdata('products', $data_products);
        //$this->session->set_userdata('qty_products', $data_qty_products);

        $this->medicalrecord->table = 'product';
        $title_data_products = [];
        if ($data_products) {
            foreach ($data_products as $product) {
                $get_title_product = $this->medicalrecord->select(['product.id', 'product.title'])
                    ->where('product.id', $product->id_product)
                    ->first();

                array_push($title_data_products, $get_title_product);
            }
            echo json_encode(array(
                'statusCode'        => 200,
                'id_products'       => $data_products,
                'title_products'    => $title_data_products
            ));
        } else {
            $this->session->unset_userdata('products');

            echo json_encode(array(
                'statusCode'        => 200,
                'id_products'       => $data_products,
                'title_products'    => $title_data_products
            ));
        }
    }


    public function selectProduct()
    {
        $products = $this->input->post('products');
        $data_products = json_decode($products);

        $this->session->set_userdata('products', $data_products);
    }



    public function destroyProduct($i)
    {
        $getArrProduct = $this->session->userdata('products');

        //$key = array_search($i, $getArrProduct);

        unset($getArrProduct[$i]);

        $this->session->set_userdata('products', $getArrProduct);
    }

    public function loadProduct()
    {
        $getProduct = $this->session->userdata('products');

        $data['product'] = [];
        $this->medicalrecord->table = 'product';
        if ($getProduct) {
            foreach ($getProduct as $product) {
                $get_title_product = $this->medicalrecord->select(['product.id', 'product.title'])
                    ->where('product.id', $product->id_product)
                    ->first();

                array_push($data['product'], $get_title_product);
            }
        }


        $this->load->view('pages/doctor/data/data_span_product', $data);
    }

    public function tes()
    {
        $get = $this->session->userdata('products');


        $gets = json_decode(json_encode($get), TRUE);

        $this->medicalrecord->table = 'items_detail';
        $getItemsDetail = $this->medicalrecord->select([
            'id_product', 'qty'
        ])
            ->where('id_items', '202106230814533336')->get();


        $data_items_detail = [];
        foreach ($getItemsDetail as $row) {
            $data_items_detail[] = [
                'id_product'    => $row->id_product,
                'qty'           => $row->qty
            ];
        }

        foreach ($gets as $row) {
            if (!in_array($row, $data_items_detail)) {
                echo $row['id_product'] . ' ini yang ditambah' . '<br>';
            }
        }


        foreach ($data_items_detail as $data_items_detail_row) {
            if (!in_array($data_items_detail_row, $gets)) {
                echo $data_items_detail_row['id_product'] . ' ini yang dihapus' . '<br>';
            }
        }
        //print_r($gets);

        // foreach($gets as $row) {
        //     if (!in_array($row, ))
        // }

        // $new_data = [
        //     'id_product'    => '1020020017',
        //     'qty'           => '2'
        // ];
        // if(!in_array($new_data, $gets)) {
        //     print_r($new_data['id_product']);
        // } else {
        //     echo 'tidak ada';
        // }



        //print_r($gets);
    }


    public function unsetSessProduct()
    {
        $this->session->unset_userdata('products');
    }

    // public function update_note_rm()
    // {
    //     $this->medicalrecord->table = 'medical_records';

    //     $rm = $this->medicalrecord->where('id_store',1)->orderBy('id', 'ASC')->get();

    //     $id_rm = 20106;
    //     foreach($rm as $data) {
    //         $this->medicalrecord->where('id', $data->id)->update(['id'  => $id_rm]);
    //         $id_rm++;
    //     }
    // }


}

/* End of file Medicalrecord.php */
