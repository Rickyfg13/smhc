<?php


defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Frontoffice extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    $role = $this->session->userdata('role');

    if ($role == 'admin' || $role == 'front_officer' || $role == 'cashier') {
      return;
    } else {
      $this->session->set_flashdata('warning', "You Don't Have Access");
      redirect(base_url() . 'auth/login');
      return;
    }
  }

  public function index()
  {
    $data['title']          = 'Front Office';
    $data['page_title']     = 'Front Office - KasirKu';
    $data['nav_title']      = 'front_officer';
    $data['detail_title']   = 'front_officer';

    $data['page']           = 'pages/front-office/index';

    $this->view_cashier($data);
  }

  public function add_queue($id_customer)
  {
    $id = $this->code_generator();

    $data = [
      'id'    => $id,
      'id_store'  => $this->session->userdata('id_store'),
      'id_customer'   => $id_customer
    ];

    $this->frontoffice->table = 'queue';
    $cekDoubleData = $this->frontoffice->where('id_customer', $id_customer)->where('DATE(created_at)', date('Y-m-d'))->count();

    if ($cekDoubleData < 1) {
      if ($this->frontoffice->add($data) == true) {

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

        $data['msg']        = 'Queue of Patients has been added!';
        $data['id_store_sess'] = $this->session->userdata('id_store');
        $data['notif']      = 'add_queue';
        $pusher->trigger('my-channel', 'my-event', $data);


        echo json_encode(array(
          'statusCode'    => 200,
          'msg'           => 'Success add to Queue'
        ));
      } else {
        echo json_encode(array(
          'statusCode'    => 201,
          'msg'           => 'Oops! Something went wrong!'
        ));
      }
    } else {
      echo json_encode(array(
        'statusCode'    => 202,
        'msg'           => 'This Customer has been added to Queue!'
      ));
    }
  }

  public function remove_queue($id)
  {
    if ($this->input->is_ajax_request()) {
      $this->frontoffice->table = 'queue';
      if ($this->frontoffice->where('id', $id)->delete()) {
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

        $data['msg'] = 'Queue of Patients has been removed!';
        $data['id_store_sess'] = $this->session->userdata('id_store');
        $data['notif'] = 'remove_queue';
        $pusher->trigger('my-channel', 'my-event', $data);

        echo json_encode(array(
          'statusCode'        => 200,
          'msg'               => 'Queue has been removed!',
          'type'              => 'success',
        ));
      } else {
        echo json_encode(array(
          'statusCode'        => 201,
          'msg'               => 'Oops! Something went wrong!',
          'type'              => 'error',
        ));
      }
    } else {
      echo '<h3>FORBIDDEN</h3>';
    }
  }

  public function insert_patient()
  {
    $id                 = date('Ymdhis') . rand(pow(10, 3 - 1), pow(10, 3) - 1);
    $name               = $this->input->post('name', true);
    $nickname           = $this->input->post('nickname', true);
    $birth_date         = $this->input->post('birth_date', true);
    $identity_number    = $this->input->post('identity_number', true);
    $phone              = $this->input->post('phone', true);
    $email              = $this->input->post('email', true);
    $job                = $this->input->post('job', true);
    $address            = $this->input->post('address', true);
    $previous_skincare  = $this->input->post('previous_skincare', true);

    $birth_date_2       = str_replace('/', '-', $birth_date);

    if (!$this->frontoffice->validate()) {
      $arr = array(
        'error'                     => true,
        'statusCode'                => 400,
        'name_error'                => form_error('name'),
        'birth_date_error'          => form_error('birth_date'),
        'identity_number_error'     => form_error('identity_number'),
        'phone_error'               => form_error('phone'),
        'email_error'               => form_error('email'),
        'job_error'                 => form_error('job'),
        'address_error'             => form_error('address')
      );

      echo json_encode($arr);
    } else {
      $data = array(
        'id'                        => $id,
        'id_store'                  => $this->session->userdata('id_store'),
        'name'                      => ucwords($name),
        'nickname'                  => ucwords($nickname),
        'birth_date'                => date('Y-m-d', strtotime($birth_date_2)),
        'identity_number'           => $identity_number,
        'phone'                     => $phone,
        'email'                     => $email,
        'job'                       => $job,
        'address'                   => $address,
        'previous_skincare'         => $previous_skincare,

      );

      if ($this->frontoffice->add($data) == true) {
        $this->session->set_flashdata('success', 'Data has been added!');


        echo json_encode(array(
          'statusCode' => 200,
          'id_customer' => $id
        ));
      } else {
        $this->session->set_flashdata('error', 'Oops! Something went wrong!');

        echo json_encode(array(
          'statusCode'    => 201
        ));
      }
    }
  }

  public function remove_patient($id_customer)
  {
    if ($this->input->is_ajax_request()) {
      $this->frontoffice->table = 'customer';
      if ($this->frontoffice->where('customer.id', $id_customer)->delete()) {
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
      echo '<h4>FORBIDDEN</h4>';
    }
  }


  public function code_generator()
  {
    $this->frontoffice->table = 'queue';
    $getMax = $this->frontoffice->select([
      'MAX(id) AS id'
    ])->where('DATE(queue.created_at)', date('Y-m-d'))
      ->where('queue.id_store', $this->session->userdata('id_store'))
      ->first();

    if ($getMax->id) {
      $code_from_db = $getMax->id;

      // Q3004210001
      $temp = (int) substr($code_from_db, 9);
      $temp++;

      $code = 'Q' . '0' . $this->session->userdata('id_store') . date('dmy') . sprintf("%04s", $temp);

      return $code;
    } else {
      $code = 'Q' . '0' . $this->session->userdata('id_store') . date('dmy') . '0001';
      return $code;
    }
  }


  public function loadDataPatients()
  {
    $data['patients'] = $this->frontoffice->orderBy('created_at', 'DESC')->get();
    $this->load->view('pages/front-office/data/table_patients', $data);
  }

  public function exportToExcel()
  {
    $patients = $this->frontoffice->select([
      'customer.identity_number', 'customer.name', 'customer.birth_date',
      'customer.phone', 'customer.email',
      'customer.address', 'customer.address', 'customer.job',
      'customer.previous_skincare', 'store.name AS store_name'
    ])
      ->join('store')
      ->orderBy('customer.created_at', 'DESC')
      ->get();

    //print_r($patients);

    $spreadsheet = new Spreadsheet();
    $sheet    = $spreadsheet->getActiveSheet();


    //title
    $sheet->mergeCells('A2:I2');
    $sheet->mergeCells('A3:I3');
    $sheet->setCellValue('A2', 'PATIENTS DATA');
    $sheet->setCellValue('A3', 'hersclinic.id');

    //style title
    $styleArrayTitle = [
      'font'        => [
        'size'      => 18,
        'bold'      => true,
      ],
      'alignment' => [
        'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ]
    ];

    $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

    //header table
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'NIK')
                ->setCellValue('B5', 'Name')
                ->setCellValue('C5', 'Birth Date')
                ->setCellValue('D5', 'Phone')
                ->setCellValue('E5', 'Email')
                ->setCellValue('F5', 'Address')
                ->setCellValue('G5', 'Job')
                ->setCellValue('H5', 'Previous Skincare')
                ->setCellValue('I5', 'Register At');

    //set width column
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);

    //position row
    $row = 6;
    $row2 = 6;
    // foreach($patients as $data_patient) {
    //   $sheet->getStyle('A' . $row2)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
    //   $row2++;
    // }

    //write data to sheet
    foreach($patients as $patient) {
      $sheet->getStyle('A' . $row)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

      if ($patient->identity_number == 0 || $patient->identity_number == '-') {
        $identity_number = "";
      } else {
        $identity_number = "'" . $patient->identity_number;
      }

      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $row, $identity_number)
        ->setCellValue('B' . $row, $patient->name)
        ->setCellValue('C' . $row, date_format(new DateTime($patient->birth_date), 'd/m/Y'))
        ->setCellValue('D' . $row, $patient->phone)
        ->setCellValue('E' . $row, $patient->email)
        ->setCellValue('F' . $row, $patient->address)
        ->setCellValue('G' . $row, $patient->job)
        ->setCellValue('H' . $row, $patient->previous_skincare)
        ->setCellValue('I' . $row, $patient->store_name);
      
        
        $row++;
    }


    //set border
    $styleArray = [
      'borders'   => [
          'allBorders'    => [
              'borderStyle'       => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
              'color'             => ['argb'      => '000'],
          ],
      ],
    ];

    $batas = count($patients) + 5;
    $sheet->getStyle('A5:I' . $batas)->applyFromArray($styleArray);

    //style header table
    $styleHeader = [
      'font'  => [
          'size'  => 14,
          'bold'  => true,
          'color' => ['argb'  => '000']
      ],
      'fill'      => [
          'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
          'color'     => ['argb'  => 'fff9b0'],
      ],
    ];

    $sheet->getStyle('A5:I5')->applyFromArray($styleHeader);

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="PatientsData_hersclinic.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function loadDataQueue()
  {
    $this->frontoffice->table = 'queue';
    $data['queue'] = $this->frontoffice->select([
      'queue.id',
      'customer.name', 'customer.phone', 'queue.created_at'
    ])
      ->where('queue.status', 'waiting')
      ->where('queue.id_store', $this->session->userdata('id_store'))
      ->where('DATE(queue.created_at)', date('Y-m-d'))
      ->orWhere('queue.status', 'on_consult')
      ->where('queue.id_store', $this->session->userdata('id_store'))
      ->where('DATE(queue.created_at)', date('Y-m-d'))
      ->join('customer')
      ->get();

    //print_r($data['queue']);
    $this->load->view('pages/front-office/data/table_queue', $data);
  }

  public function loadDataQueueOnProgress()
  {
    $this->frontoffice->table = 'queue';
    $data['queue']  = $this->frontoffice->select([
      'queue.id',
      'customer.name',
      'customer.phone',
      'queue.created_at',
      'medical_records_detail.id_therapist'
    ])
      ->where('queue.status', 'on_progress')
      ->where('queue.id_store', $this->session->userdata('id_store'))
      ->where('DATE(queue.created_at)', date('Y-m-d'))
      ->where('medical_records_detail.id_therapist', null)
      ->join('customer')
      ->join2('medical_records_detail')
      ->get();

    $this->load->view('pages/front-office/data/table_queue_on_progress', $data);
  }

  public function edit_patient()
  {
    $id_customer = $this->input->get('id_customer', true);
    $data['title']          = 'Edit Patient Data Form';
    $data['getCustomer'] = $this->frontoffice->where('id', $id_customer)->first();

    $this->output->set_output(show_my_modal('pages/front-office/modal/modal_edit_patient', 'modal-edit-patient', $data, 'lg'));
  }



  public function update_patient()
  {
    $id                 = $this->input->post('id', true);
    $name               = $this->input->post('name', true);
    $nickname           = $this->input->post('nickname', true);
    $birth_date         = $this->input->post('birth_date', true);
    $identity_number    = $this->input->post('identity_number', true);
    $phone              = $this->input->post('phone', true);
    $email              = $this->input->post('email', true);
    $job                = $this->input->post('job', true);
    $address            = $this->input->post('address', true);
    $previous_skincare  = $this->input->post('previous_skincare', true);

    $birth_date_2       = str_replace('/', '-', $birth_date);

    if (!$this->frontoffice->validate()) {
      $arr = array(
        'error'                     => true,
        'statusCode'                => 400,
        'name_edit_error'                => form_error('name'),
        'birth_date_edit_error'          => form_error('birth_date'),
        'identity_number_edit_error'     => form_error('identity_number'),
        'phone_edit_error'               => form_error('phone'),
        'email_edit_error'               => form_error('email'),
        'job_edit_error'                 => form_error('job'),
        'address_edit_error'             => form_error('address')
      );

      echo json_encode($arr);
    } else {
      $data = array(
        'id_store'                  => $this->session->userdata('id_store'),
        'name'                      => ucwords($name),
        'nickname'                  => ucwords($nickname),
        'birth_date'                => date('Y-m-d', strtotime($birth_date_2)),
        'identity_number'           => $identity_number,
        'phone'                     => $phone,
        'email'                     => $email,
        'job'                       => $job,
        'address'                   => $address,
        'previous_skincare'         => $previous_skincare,

      );

      if ($this->frontoffice->where('id', $id)->update($data)) {
        echo json_encode(array(
          'statusCode' => 200,
          'id_customer' => $id
        ));
      } else {
        echo json_encode(array(
          'statusCode'    => 201
        ));
      }
    }
  }

  public function add_therapist()
  {
    $id_queue = $this->input->get('id_queue', true);
    $data['title']          = 'Add Therapist';
    $this->frontoffice->table = 'therapist';
    $data['therapist']      = $this->frontoffice->orderBy('created_at', 'DESC')->get();
    $data['id_queue']       = $id_queue;

    $this->output->set_output(show_my_modal('pages/front-office/modal/modal_add_therapist', 'modal-add-therapist', $data, 'lg'));
  }

  public function insert_therapist()
  {
    $id_queue = $this->input->post('id', true);
    $id_therapist = $this->input->post('therapist', true);

    $this->frontoffice->table = 'medical_records_detail';

    //update id_therapist to medical records detail

    if ($id_therapist != "") {
      if ($this->frontoffice->where('id_queue', $id_queue)->update([
        'id_therapist'      => $id_therapist
      ])) {
        echo json_encode(array(
          'statusCode' => 200,
        ));
      } else {
        echo json_encode(array(
          'statusCode' => 201,
        ));
      }
    } else {
      echo json_encode(array(
        'statusCode' => 400,
      ));
    }
  }
}

/* End of file Frontoffice.php */
