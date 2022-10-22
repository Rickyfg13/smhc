<?php


defined('BASEPATH') or exit('No direct script access allowed');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPSTORM_META\map;

class Report extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mypdf');
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
        $this->sales();
    }

    public function sales()
    {
        $data['title']          = 'Report Sales Based Invoice';
        $data['page_title']     = 'Report Sales Based Invoice';
        $data['nav_title']      = 'report';
        $data['detail_title']   = 'report_sales';
        $data['page']           = 'pages/admin/report/sales/index';

        $this->view($data);
    }

    public function requestSales($selectFilter, $store = '')
    {

        if ($selectFilter == "date") {
            $start_from     = $this->input->post('tgl_start');
            $end_period     = $this->input->post('tgl_end');

            $start = explode("/", $start_from);
            $end   = explode("/", $end_period);

            $tgl_start = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tgl_end = $end[2] . "-" . $end[1] . "-" . $end[0];

            if ($store != '') {
                if ($store == 'all') {
                    $data['content']    = $this->report->where('DATE(created_at) >=', $tgl_start)
                        ->where('DATE(created_at) <=', $tgl_end)
                        ->get();
                } else if ($store == 'siteba') {
                    $data['content']    = $this->report->where('DATE(created_at) >=', $tgl_start)
                        ->where('DATE(created_at) <=', $tgl_end)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $data['content']    = $this->report->where('DATE(created_at) >=', $tgl_start)
                        ->where('DATE(created_at) <=', $tgl_end)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                $data['content']    = $this->report->where('DATE(created_at) >=', $tgl_start)
                    ->where('DATE(created_at) <=', $tgl_end)
                    ->get();
            }


            if (count($data['content']) > 0) {

                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        } else if ($selectFilter == "month") {
            $month = $this->input->post('month', true);
            $year  = $this->input->post('year', true);

            if ($store != '') {
                if ($store == 'all') {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else if ($store == 'siteba') {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                $data['content']    = $this->report->where('MONTH(created_at)', $month)
                    ->where('YEAR(created_at)', $year)
                    ->get();
            }



            if (count($data['content']) > 0) {
                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        } else {
            $year   = $this->input->post('year2', true);


            if ($store != '') {
                if ($store == 'all') {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else if ($store == 'siteba') {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                $data['content']    = $this->report
                    ->where('YEAR(created_at)', $year)
                    ->get();
            }


            if (count($data['content']) > 0) {
                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        }
    }

    public function exportSales($filter, $startFrom = '', $endPeriod = '', $month = '', $year = '', $store = '')
    {
        if ($filter == "date") {
            $start  = explode("-", $startFrom);
            $end    = explode("-", $endPeriod);

            $tglStart = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tglEnd = $end[2] . "-" . $end[1] . "-" . $end[0];

            //data
            $this->report->table = 'transaction';
            if ($store != '') {
                if ($store == 'all') {
                    $content    = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->get();
                } else if ($store == 'siteba') {
                    $content    = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $content    = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $content    = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $content    = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->get();
                }
            }


            //inisialisasi object spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();


            //title
            $sheet->mergeCells('A2:D2');
            $sheet->mergeCells('A3:D3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON INVOICE');
            $sheet->setCellValue('A3', 'Period From ' . $startFrom . ' to ' . $endPeriod);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'  => 18,
                    'bold'  => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);


            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Invoice')
                ->setCellValue('C5', 'Subtotal')
                ->setCellValue('D5', 'Created At');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setWidth(35);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setWidth(35);

            //position column and set number
            $col = 6;
            $no = 1;

            //write data to sheet
            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, (string) $row->invoice)
                    ->setCellValue('C' . $col, $row->total)
                    ->setCellValue('D' . $col, date_format(new DateTime($row->created_at), "d/m/Y H:i"));

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('B' . $col)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                $col++;
                $no++;
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

            $batas = count($content) + 5;
            $sheet->getStyle('A5:D' . $batas)->applyFromArray($styleArray);


            //sum total style
            $styleTotal = [
                'font'  => [
                    'size'  => 18,
                    'bold'  => true,
                    'color' => ['argb'  => '000']
                ],
            ];


            //sum total
            $SUMRANGE = 'C6:C' . $batas;
            $sheet->setCellValue('A' . ($batas + 1), "Subtotal :");
            $sheet->setCellValue('C' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->getStyle('C', ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');

            //change font size total
            $sheet->getStyle('C' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('A' . ($batas + 1))->applyFromArray($styleTotal);


            //style header
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

            $sheet->getStyle('A5:D5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedInvoice.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else if ($filter == "month") {

            if ($store != '') {
                if ($store == 'all') {
                    $content    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else if ($store == 'siteba') {
                    $content    = $this->report->where('MONTH(created_at)', $month)
                        ->where('id_store', 1)
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else {
                    $content    = $this->report->where('MONTH(created_at)', $month)
                        ->where('id_store', 2)
                        ->where('YEAR(created_at)', $year)
                        ->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $content    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $content    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->get();
                }
            }

            foreach (getMonth() as $key => $val) {
                if ($key == $month) {
                    $nameMonth = $val;
                }
            }

            //inisialisasi object spreadsheet
            $spreadsheet    = new Spreadsheet();
            $sheet          = $spreadsheet->getActiveSheet();


            //title
            $sheet->mergeCells('A2:D2');
            $sheet->mergeCells('A3:D3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON INVOICE');
            $sheet->setCellValue('A3', 'Period ' . $nameMonth . ' ' . $year);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'  => 18,
                    'bold'  => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Invoice')
                ->setCellValue('C5', 'Subtotal')
                ->setCellValue('D5', 'Created At');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setWidth(35);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setWidth(35);

            //position column and set number
            $col = 6;
            $no = 1;

            //write data to sheet
            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, (string) $row->invoice)
                    ->setCellValue('C' . $col, $row->total)
                    ->setCellValue('D' . $col, date_format(new DateTime($row->created_at), "d/m/Y H:i"));

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('B' . $col)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                $col++;
                $no++;
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

            $batas = count($content) + 5;
            $sheet->getStyle('A5:D' . $batas)->applyFromArray($styleArray);

            //sum total style
            $styleTotal = [
                'font'  => [
                    'size'  => 18,
                    'bold'  => true,
                    'color' => ['argb'  => '000']
                ],
            ];


            //sum total
            $SUMRANGE = 'C6:C' . $batas;
            $sheet->setCellValue('A' . ($batas + 1), "Subtotal :");
            $sheet->setCellValue('C' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->getStyle('C', ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');

            //change font size total
            $sheet->getStyle('C' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('A' . ($batas + 1))->applyFromArray($styleTotal);

            //style header
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

            $sheet->getStyle('A5:D5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedInvoice.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            if ($store != '') {
                if ($store == 'all') {
                    $content    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else if ($store == 'siteba') {
                    $content    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $content    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $content    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $content    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->get();
                }
            }



            //inisialisasi object spreadsheet
            $spreadsheet    = new Spreadsheet();
            $sheet          = $spreadsheet->getActiveSheet();


            //title
            $sheet->mergeCells('A2:D2');
            $sheet->mergeCells('A3:D3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON INVOICE');
            $sheet->setCellValue('A3', 'Period ' . $year);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'  => 18,
                    'bold'  => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Invoice')
                ->setCellValue('C5', 'Subtotal')
                ->setCellValue('D5', 'Created At');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setWidth(35);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setWidth(35);

            //position column and set number
            $col = 6;
            $no = 1;

            //write data to sheet
            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, (string) $row->invoice)
                    ->setCellValue('C' . $col, $row->total)
                    ->setCellValue('D' . $col, date_format(new DateTime($row->created_at), "d/m/Y H:i"));

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('B' . $col)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
                $col++;
                $no++;
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

            $batas = count($content) + 5;
            $sheet->getStyle('A5:D' . $batas)->applyFromArray($styleArray);

            //sum total style
            $styleTotal = [
                'font'  => [
                    'size'  => 18,
                    'bold'  => true,
                    'color' => ['argb'  => '000']
                ],
            ];

            //sum total
            $SUMRANGE = 'C6:C' . $batas;
            $sheet->setCellValue('A' . ($batas + 1), "Subtotal :");
            $sheet->setCellValue('C' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->getStyle('C', ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');

            //change font size total
            $sheet->getStyle('C' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('A' . ($batas + 1))->applyFromArray($styleTotal);

            //style header
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

            $sheet->getStyle('A5:D5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedInvoice.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }



    public function exportPdfReportSales($filter, $startFrom = '', $endPeriod = '', $month = '', $year = '', $store = '')
    {
        $fileName   = 'SalesReportBasedOnInvoice';
        $title      = 'Sales Report Based On Invoice';
        if ($filter == "date") {
            $start      = explode("-", $startFrom);
            $end        = explode("-", $endPeriod);
            $tglStart = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tglEnd = $end[2] . "-" . $end[1] . "-" . $end[0];

            //data
            $this->report->table    = 'transaction';
            if ($store != '') {
                if ($store == 'all') {
                    $data['content']        = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->get();
                } else if ($store == 'siteba') {
                    $data['content']        = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $data['content']        = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $data['content']        = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $data['content']        = $this->report->where('DATE(created_at) >=', $tglStart)
                        ->where('DATE(created_at) <=', $tglEnd)
                        ->get();
                }
            }


            $data['start_from'] = $tglStart;
            $data['end_period'] = $tglEnd;
            $data['title']      = $title;

            $this->mypdf->generate('pages/admin/report/pdf/index', $data, $fileName, 'A4', 'landscape');
        } else if ($filter == "month") {
            if ($store != '') {
                if ($store == 'all') {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)->get();
                } else if ($store == 'siteba') {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)->where('id_store', 1)->get();
                } else {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)->where('id_store', 2)->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $data['content']    = $this->report->where('MONTH(created_at)', $month)
                        ->where('YEAR(created_at)', $year)->get();
                }
            }


            foreach (getMonth() as $key => $val) {
                if ($key == $month) {
                    $nameMonth = $val;
                }
            }

            $data['month'] = $nameMonth;
            $data['title'] = $title;
            $this->mypdf->generate('pages/admin/report/pdf/index', $data, $fileName, 'A4', 'landscape');
        } else {
            if ($store != '') {
                if ($store == 'all') {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->get();
                } else if ($store == 'siteba') {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 1)
                        ->get();
                } else {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', 2)
                        ->get();
                }
            } else {
                if ($this->session->userdata('role') == 'staf_finance') {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->where('id_store', $this->session->userdata('id_store'))
                        ->get();
                } else {
                    $data['content']    = $this->report
                        ->where('YEAR(created_at)', $year)
                        ->get();
                }
            }


            $data['year']  = $year;
            $data['title'] = $title;
            $this->mypdf->generate('pages/admin/report/pdf/index', $data, $fileName, 'A4', 'landscape');
        }
    }

    public function salesProduct()
    {
        $data['title']          = 'Report Sales Based Products';
        $data['page_title']     = 'Report Sales Based Products';
        $data['nav_title']      = 'report';
        $data['detail_title']   = 'report_sales_product';
        $data['page']           = 'pages/admin/report/sales/product/index';

        $this->view($data);
    }

    public function requestSalesProduct($filter, $store = '')
    {
        if ($filter == "date") {
            $start_from = $this->input->post('tgl_start', true);
            $end_period = $this->input->post('tgl_end', true);

            $start = explode("/", $start_from);
            $end   = explode("/", $end_period);

            $tgl_start = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tgl_end = $end[2] . "-" . $end[1] . "-" . $end[0];

            $this->report->table = 'transaction_detail';
            // if ($store != '') {
            //     if ($store == 'all') {

            //     }
            // }
            $data['content']     = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('DATE(transaction.created_at) >=', $tgl_start)
                ->where('DATE(transaction.created_at) <=', $tgl_end)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $data['total_discount'] = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('DATE(transaction.created_at) >=', $tgl_start)
                ->where('DATE(transaction.created_at) <=', $tgl_end)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($data['total_discount'], 'discount_total'));
            $data['filter']             = $filter;

            if (count($data['content']) > 0) {
                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/product/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        } else if ($filter == "month") {
            $month = $this->input->post('month', true);
            $year  = $this->input->post('year', true);

            $this->report->table = 'transaction_detail';
            $data['content']        = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $data['total_discount'] = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($data['total_discount'], 'discount_total'));

            if (count($data['content']) > 0) {
                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/product/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        } else {
            $year = $this->input->post('year2', true);

            $this->report->table = 'transaction_detail';
            $data['content']     = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $data['total_discount'] = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($data['total_discount'], 'discount_total'));

            if (count($data['content']) > 0) {
                echo json_encode([
                    'statusCode'        => 200,
                    'content'           => $this->load->view('pages/admin/report/sales/product/data/table', $data, true)
                ]);
            } else {
                echo json_encode([
                    'statusCode'        => 201,
                    'content'           => 'Data Not Found'
                ]);
            }
        }
    }

    public function exportSalesProduct($filter, $startFrom = '', $endPeriod = '', $month = '', $year = '')
    {
        if ($filter == "date") {

            $start = explode("-", $startFrom);
            $end   = explode("-", $endPeriod);

            $tglStart = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tglEnd = $end[2] . "-" . $end[1] . "-" . $end[0];

            $this->report->table = 'transaction_detail';
            $content = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('DATE(transaction.created_at) >=', $tglStart)
                ->where('DATE(transaction.created_at) <=', $tglEnd)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('DATE(transaction.created_at) >=', $tglStart)
                ->where('DATE(transaction.created_at) <=', $tglEnd)
                ->get();

            $get_total_discount = array_sum(array_column($total_discount, 'discount_total'));

            //inisialisasi  object spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            //title
            $sheet->mergeCells('A2:E2');
            $sheet->mergeCells('A3:E3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON PRODUCTS');
            $sheet->setCellValue('A3', 'Period From ' . $startFrom . ' to ' . $endPeriod);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'      => 18,
                    'bold'      => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);


            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Title Of Product')
                ->setCellValue('C5', 'Price')
                ->setCellValue('D5', 'Item Sales')
                ->setCellValue('E5', 'Subtotal');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setWidth(35);


            //position column and set number
            $col = 6;
            $no = 1;



            //write data to excel
            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, $row->title)
                    ->setCellValue('C' . $col, $row->price)
                    ->setCellValue('D' . $col, $row->qty)
                    ->setCellValue('E' . $col, $row->subtotal);

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('E' . $col)->getNumberFormat()->setFormatCode('#,##0');

                $col++;
                $no++;
            }

            //set border
            $styleArray = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'         => ['argb'  => '000'],
                    ],
                ],
            ];

            $batas = count($content) + 5;
            $sheet->getStyle('A5:E' . $batas)->applyFromArray($styleArray);


            //sum total
            $SUMRANGE = 'E6:E' . $batas;
            $sheet->setCellValue('E' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->setCellValue('D' . ($batas + 1), "Subtotal :");
            $sheet->getStyle('E' . ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');
            //$sheet->getStyle('A' . ($batas + 1) . ':' . 'E' . ($batas + 1))->applyFromArray($styleArray);

            //discount
            $sheet->setCellValue('D' . ($batas + 2), "Discount Total :");
            $sheet->setCellValue('E' . ($batas + 2), $get_total_discount);
            $sheet->getStyle('E' . ($batas + 2))->getNumberFormat()->setFormatCode("#,##0");

            //grand total
            $sheet->setCellValue('D' . ($batas + 3), "Total :");
            $TOTALRANGE = 'E' . ($batas + 1) . '-' . 'E' . ($batas + 2);
            $sheet->setCellValue('E' . ($batas + 3), "=$TOTALRANGE");
            $sheet->getStyle('E' . ($batas + 3))->getNumberFormat()->setFormatCode("#,##0");

            //style header
            $styleHeader = [
                'font' => [
                    'size'  => 14,
                    'bold'  => true,
                    'color' => ['argb'  => '000'],
                ],
                'fill'  => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color'     => ['argb'  => 'c7ffd8'],
                ],
            ];

            $sheet->getStyle('A5:E5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedProducts.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else if ($filter == "month") {

            $this->report->table = 'transaction_detail';
            $content        = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount      = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $get_total_discount = array_sum(array_column($total_discount, 'discount_total'));

            foreach (getMonth() as $key => $val) {
                if ($key == $month) {
                    $nameMonth = $val;
                }
            }
            //inisialisasi object spreadsheet
            $spreadsheet    = new Spreadsheet();
            $sheet          = $spreadsheet->getActiveSheet();

            //title
            $sheet->mergeCells('A2:E2');
            $sheet->mergeCells('A3:E3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON PRODUCTS');
            $sheet->setCellValue('A3', "Period " . $nameMonth . " " . $year);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'      => 18,
                    'bold'      => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Title Of Product')
                ->setCellValue('C5', 'Price')
                ->setCellValue('D5', 'Item Sales')
                ->setCellValue('E5', 'Subtotal');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setWidth(35);


            //position column and set number
            $col = 6;
            $no = 1;

            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, $row->title)
                    ->setCellValue('C' . $col, $row->price)
                    ->setCellValue('D' . $col, $row->qty)
                    ->setCellValue('E' . $col, $row->subtotal);

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('E' . $col)->getNumberFormat()->setFormatCode('#,##0');

                $col++;
                $no++;
            }

            $styleArray = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'         => ['argb'  => '000'],
                    ],
                ],
            ];

            $batas = count($content) + 5;
            $sheet->getStyle('A5:E' . $batas)->applyFromArray($styleArray);


            //sum total
            $SUMRANGE = 'E6:E' . $batas;
            $sheet->setCellValue('E' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->setCellValue('D' . ($batas + 1), "Subtotal :");
            $sheet->getStyle('E' . ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');
            //$sheet->getStyle('A' . ($batas + 1) . ':' . 'E' . ($batas + 1))->applyFromArray($styleArray);

            //discount
            $sheet->setCellValue('D' . ($batas + 2), "Discount Total :");
            $sheet->setCellValue('E' . ($batas + 2), $get_total_discount);
            $sheet->getStyle('E' . ($batas + 2))->getNumberFormat()->setFormatCode("#,##0");

            //grand total
            $sheet->setCellValue('D' . ($batas + 3), "Total :");
            $TOTALRANGE = 'E' . ($batas + 1) . '-' . 'E' . ($batas + 2);
            $sheet->setCellValue('E' . ($batas + 3), "=$TOTALRANGE");
            $sheet->getStyle('E' . ($batas + 3))->getNumberFormat()->setFormatCode("#,##0");

            //style header
            $styleHeader = [
                'font' => [
                    'size'  => 14,
                    'bold'  => true,
                    'color' => ['argb'  => '000'],
                ],
                'fill'  => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color'     => ['argb'  => 'c7ffd8'],
                ],
            ];

            $sheet->getStyle('A5:E5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedProducts.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            $this->report->table = 'transaction_detail';
            $content        = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount      = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $get_total_discount = array_sum(array_column($total_discount, 'discount_total'));


            //inisialisasi object spreadsheet
            $spreadsheet    = new Spreadsheet();
            $sheet          = $spreadsheet->getActiveSheet();

            //title
            $sheet->mergeCells('A2:E2');
            $sheet->mergeCells('A3:E3');
            $sheet->setCellValue('A2', 'SALES REPORT BASED ON PRODUCTS');
            $sheet->setCellValue('A3', "Period " . $year);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'      => 18,
                    'bold'      => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Title Of Product')
                ->setCellValue('C5', 'Price')
                ->setCellValue('D5', 'Item Sales')
                ->setCellValue('E5', 'Subtotal');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setWidth(35);


            //position column and set number
            $col = 6;
            $no = 1;

            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, $row->title)
                    ->setCellValue('C' . $col, $row->price)
                    ->setCellValue('D' . $col, $row->qty)
                    ->setCellValue('E' . $col, $row->subtotal);

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('E' . $col)->getNumberFormat()->setFormatCode('#,##0');

                $col++;
                $no++;
            }

            $styleArray = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'         => ['argb'  => '000'],
                    ],
                ],
            ];

            $batas = count($content) + 5;
            $sheet->getStyle('A5:E' . $batas)->applyFromArray($styleArray);


            //sum total
            $SUMRANGE = 'E6:E' . $batas;
            $sheet->setCellValue('E' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->setCellValue('D' . ($batas + 1), "Subtotal :");
            $sheet->getStyle('E' . ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');
            //$sheet->getStyle('A' . ($batas + 1) . ':' . 'E' . ($batas + 1))->applyFromArray($styleArray);

            //discount
            $sheet->setCellValue('D' . ($batas + 2), "Discount Total :");
            $sheet->setCellValue('E' . ($batas + 2), $get_total_discount);
            $sheet->getStyle('E' . ($batas + 2))->getNumberFormat()->setFormatCode("#,##0");

            //grand total
            $sheet->setCellValue('D' . ($batas + 3), "Total :");
            $TOTALRANGE = 'E' . ($batas + 1) . '-' . 'E' . ($batas + 2);
            $sheet->setCellValue('E' . ($batas + 3), "=$TOTALRANGE");
            $sheet->getStyle('E' . ($batas + 3))->getNumberFormat()->setFormatCode("#,##0");

            //style header
            $styleHeader = [
                'font' => [
                    'size'  => 14,
                    'bold'  => true,
                    'color' => ['argb'  => '000'],
                ],
                'fill'  => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color'     => ['argb'  => 'c7ffd8'],
                ],
            ];

            $sheet->getStyle('A5:E5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportBasedProducts.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        }
    }

    public function exportPdfReportSalesProduct($filter, $startFrom = '', $endPeriod = '', $month = '', $year = '')
    {
        $fileName   = 'SalesReportProduct';
        $title      = 'Sales Report Based On Product';

        if ($filter == "date") {
            $start          = explode("-", $startFrom);
            $end            = explode("-", $endPeriod);

            $tglStart       = $start[2] . "-" . $start[1] . "-" . $start[0];
            $tglEnd         = $end[2] . "-" . $end[1] . "-" . $end[0];

            $this->report->table = 'transaction_detail';
            $data['content'] = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('DATE(transaction.created_at) >=', $tglStart)
                ->where('DATE(transaction.created_at) <=', $tglEnd)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('DATE(transaction.created_at) >=', $tglStart)
                ->where('DATE(transaction.created_at) <=', $tglEnd)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($total_discount, 'discount_total'));

            $data['start_from'] = $tglStart;
            $data['end_period'] = $tglEnd;
            $data['title']      = $title;

            $this->mypdf->generate('pages/admin/report/pdf/product/index', $data, $fileName, 'A4', 'landscape');
        } else if ($filter == "month") {
            $this->report->table = 'transaction_detail';
            $data['content']        = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount      = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($total_discount, 'discount_total'));

            $data['month']      = $month;
            $data['title']      = $title;
            $this->mypdf->generate('pages/admin/report/pdf/product/index', $data, $fileName, 'A4', 'landscape');
        } else {
            $this->report->table = 'transaction_detail';
            $data['content']        = $this->report->select([
                'product.title', 'product.price', 'SUM(transaction_detail.qty) AS qty', 'SUM(transaction_detail.subtotal) AS subtotal',
                'transaction.discount_total'
            ])
                ->join('product')
                ->joinTransaction('transaction')
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('transaction_detail.id_product')
                ->get();

            $this->report->table = 'transaction';
            $total_discount      = $this->report->select([
                'transaction.discount_total'
            ])
                ->where('YEAR(transaction.created_at)', $year)
                ->get();

            $data['get_total_discount'] = array_sum(array_column($total_discount, 'discount_total'));

            $data['year']  = $year;
            $data['title'] = $title;
            $this->mypdf->generate('pages/admin/report/pdf/product/index', $data, $fileName, 'A4', 'landscape');
        }
    }



    /**
     * 
     * 
     * Tracking Product
     * 
     */
    public function tracking_product()
    {
        $data['title']          = 'Tracking Products Report';
        $data['page_title']     = 'Tracking Products Report';
        $data['nav_title']      = 'report';
        $data['detail_title']   = 'report_tracking_product';
        $data['page']           = 'pages/admin/report/tracking_order/index';

        $this->view($data);
    }

    /**
     * 
     * method to access report tracking product stock
     * 
     */
    public function requestTrackingProduct()
    {
        //get value from input with method post
        $month = $this->input->post('month', true);
        $year  = $this->input->post('year', true);

        //$month = '05';
        //$year = '2021';
        //query to get tracking product
        $this->report->table    = 'product';
        $data['content']        = $this->report->select([
            'product.title', 'product_in.stock_in AS stock_in', 'product_in.created_at', 'product.stock AS stock',
            'SUM(transaction_detail.qty) AS stock_out'
        ])
            ->join2('product_in')
            ->join2('transaction_detail', 'inner')
            ->joinBetweenTransaction()
            ->where('MONTH(transaction.created_at)', $month)
            ->where('YEAR(transaction.created_at)', $year)
            ->where('MONTH(product_in.created_at)', $month)
            ->where('YEAR(product_in.created_at)', $year)
            ->where('product.id_category', '102002')
            ->where('product.id', '1020020005')
            //->groupBy('product.title')
            ->get();

        // print_r($data['content']);



        //condition if query is available and not null
        if (count($data['content']) > 0) {
            echo json_encode([
                'statusCode'        => 200,
                'content'           => $this->load->view('pages/admin/report/tracking_order/data/table', $data, true)
            ]);
        } else {
            echo json_encode([
                'statusCode'        => 201,
                'content'           => 'Data Not Found'
            ]);
        }
    }

    /**
     * method to export to excel requestTrackingProduct
     * 
     * 
     */

    public function exportTrackingProduct($month, $year, $type)
    {
        $fileName = 'TrackingProductReport';
        $title    = 'Tracking Product Report';
        if ($type == 'excel') {
            $this->report->table    = 'product';
            $content        = $this->report->select([
                'product.title', 'product_in.stock_in AS stock_in', 'product_in.created_at', 'product.stock AS stock',
                'SUM(transaction_detail.qty) AS stock_out'
            ])
                ->join2('product_in')
                ->join2('transaction_detail')
                ->joinBetweenTransaction()
                ->where('MONTH(product_in.created_at)', $month)
                ->where('YEAR(product_in.created_at)', $year)
                ->groupBy('product.title')
                ->get();

            foreach (getMonth() as $key  => $val) {
                if ($key == $month) {
                    $nameMonth = $val;
                }
            }

            //inisialisasi object spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet       = $spreadsheet->getActiveSheet();

            //title
            $sheet->mergeCells('A2:E2');
            $sheet->mergeCells('A3:E3');
            $sheet->setCellValue('A2', 'TRACKING PRODUCT REPORT');
            $sheet->setCellValue('A3', "Period " . $nameMonth . " " . $year);

            //style title
            $styleArrayTitle = [
                'font'      => [
                    'size'      => 18,
                    'bold'      => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $sheet->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Title Of Product')
                ->setCellValue('C5', 'Stock In')
                ->setCellValue('D5', 'Current Stock')
                ->setCellValue('E5', 'Stock Out');

            //set width column
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setWidth(38);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setWidth(30);

            //position column and set number
            $col = 6;
            $no = 1;

            //write data to sheet
            foreach ($content as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $col, $no)
                    ->setCellValue('B' . $col, $row->title)
                    ->setCellValue('C' . $col, $row->stock_in)
                    ->setCellValue('D' . $col, $row->stock)
                    ->setCellValue('E' . $col, $row->stock_out);

                $sheet->getStyle('C' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('D' . $col)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('E' . $col)->getNumberFormat()->setFormatCode('#,##0');

                $col++;
                $no++;
            }

            //border
            $styleArray = [
                'borders'   => [
                    'allBorders'    => [
                        'borderStyle'   => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'         => ['argb'  => '000'],
                    ],
                ],
            ];

            $batas = count($content) + 5;
            $sheet->getStyle('A5:E' . $batas)->applyFromArray($styleArray);


            //sum total
            $STOCK_IN = 'C6:C' . $batas;
            $CURR_STOCK = 'D6:D' . $batas;
            $STOCK_OUT = 'E6:E' . $batas;
            $sheet->setCellValue('A' . ($batas + 1), "Total :");
            $sheet->setCellValue('C' . ($batas + 1), "=SUM($STOCK_IN)");
            $sheet->setCellValue('D' . ($batas + 1), "=SUM($CURR_STOCK)");
            $sheet->setCellValue('E' . ($batas + 1), "=SUM($STOCK_OUT)");

            $styleTotal = [
                'font'  => [
                    'size'  => 18,
                    'bold'  => true,
                    'color' => ['argb'  => '000']
                ],
            ];

            $sheet->getStyle('A' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('C' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('D' . ($batas + 1))->applyFromArray($styleTotal);
            $sheet->getStyle('E' . ($batas + 1))->applyFromArray($styleTotal);


            //style header
            $styleHeader = [
                'font' => [
                    'size'  => 14,
                    'bold'  => true,
                    'color' => ['argb'  => '000'],
                ],
                'fill'  => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color'     => ['argb'  => 'c7ffd8'],
                ],
            ];

            $sheet->getStyle('A5:E5')->applyFromArray($styleHeader);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="TrackingProductReport.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            $this->report->table    = 'product';
            $data['content']        = $this->report->select([
                'product.title', 'product_in.stock_in AS stock_in', 'product_in.created_at', 'product.stock AS stock',
                'SUM(transaction_detail.qty) AS stock_out'
            ])
                ->join2('product_in')
                ->join2('transaction_detail')
                ->joinBetweenTransaction()
                ->where('MONTH(product_in.created_at)', $month)
                ->where('YEAR(product_in.created_at)', $year)
                ->groupBy('product.title')
                ->get();

            foreach (getMonth() as $key  => $val) {
                if ($key == $month) {
                    $nameMonth = $val;
                }
            }

            $data['month'] = $nameMonth;
            $data['year2'] = $year;
            $data['title'] = $title;

            $this->mypdf->generate('pages/admin/report/pdf/tracking_product/index', $data, $fileName, 'A4', 'landscape');
        }
    }


    /**
     * 
     * method report sales perday
     * 
     * 
     */

    public function salesPerDays()
    {
        $data['title']              = 'Sales Report Perdays';
        $data['page_title']         = 'Sales Report Perdays';
        $data['nav_title']          = 'report';
        $data['detail_title']       = 'report_sales_perdays';
        $data['page']               = 'pages/admin/report/sales/perdays/index';

        $this->view($data);
    }


    /**
     * 
     * method to access report sales perdays
     *
     *
     */

    public function requestSalesPerDays()
    {
        //get value from input with method post
        $month         = $this->input->post('month', true);
        $year          = $this->input->post('year', true);

        //query to get report sales perdays
        $this->report->table       = 'transaction';
        $data['content']           = $this->report->select([
            'transaction.invoice', 'SUM(transaction.total) AS total',
            'transaction.created_at'
        ])
            ->where('MONTH(transaction.created_at)', $month)
            ->where('YEAR(transaction.created_at)', $year)
            ->groupBy('DATE(transaction.created_at)')
            ->get();

        if (count($data['content']) > 0) {
            echo json_encode([
                'statusCode'       => 200,
                'content'          => $this->load->view('pages/admin/report/sales/perdays/data/table', $data, true)
            ]);
        } else {
            echo json_encode([
                'statusCode'       => 201,
                'content'          => 'Data Not Found'
            ]);
        }
    }

    public function exportSalesPerDays($month, $year, $type)
    {
        if ($type == 'excel') {


            $this->report->table       = 'transaction';
            $data                      = $this->report->select([
                'transaction.invoice', 'SUM(transaction.total) AS total',
                'transaction.created_at'
            ])
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('DATE(transaction.created_at)')
                ->get();

            //check month
            foreach (getMonth() as $key => $val) {
                if ($month == $key) {
                    $nameMonth = $val;
                }
            }

            $spreadsheet = new Spreadsheet();

            //title
            $spreadsheet->getActiveSheet()->mergeCells('A2:C2');
            $spreadsheet->getActiveSheet()->mergeCells('A3:C3');
            $spreadsheet->getActiveSheet()->setCellValue('A2', 'SALES REPORT PERDAY');
            $spreadsheet->getActiveSheet()->setCellValue('A3', $nameMonth . ' ' . $year);

            //style title
            $styleArrayTitle = [
                'font'  => [
                    'size'  => 18,
                    'bold'  => true,
                ],
                'alignment' => [
                    'horizontal'    => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ]
            ];

            $spreadsheet->getActiveSheet()->getStyle('A2:A3')->applyFromArray($styleArrayTitle);

            //header
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A5', 'No')
                ->setCellValue('B5', 'Date')
                ->setCellValue('C5', 'Subtotal');

            //set width column automatically
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);



            //posisi kolom dan nomor
            $kolom = 6;
            $no = 1;




            //get data
            foreach ($data as $row) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $no)
                    ->setCellValue('B' . $kolom, date_format(new DateTime($row->created_at), 'd/m/Y'))
                    ->setCellValue('C' . $kolom, $row->total);

                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom)->getNumberFormat()
                    ->setFormatCode('#,##0');

                $kolom++;
                $no++;
            }



            //style for all borders
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000'],
                    ],
                ],
            ];
            $sheet = $spreadsheet->getActiveSheet();
            $batas = count($data) + 5;
            $sheet->getStyle('A5:C' . $batas)->applyFromArray($styleArray);


            //sum total
            $SUMRANGE = 'C6:C' . $batas;
            $sheet->setCellValue('C' . ($batas + 1), "=SUM($SUMRANGE)");
            $sheet->setCellValue('B' . ($batas + 1), 'Total :');
            $sheet->getStyle('C' . ($batas + 1))->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('A' . ($batas + 1) . ':' . 'C' . ($batas + 1))->applyFromArray($styleArray);

            //style header
            $styleArray2 = [
                'font'  => [
                    'size'  => 14,
                    'bold'  => true,
                    'color' => ['argb'  => '000'],
                ],
                'fill' => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb'   => '44A2C0'],
                ],
            ];

            $sheet->getStyle('A5:C5')->applyFromArray($styleArray2);


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="SalesReportPerDays.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
        } else {
            $fileName = 'SalesReportPerDays';
            $title    = 'Sales Report Per Days';
            $this->report->table       = 'transaction';
            $data['content']           = $this->report->select([
                'transaction.invoice', 'SUM(transaction.total) AS total',
                'transaction.created_at'
            ])
                ->where('MONTH(transaction.created_at)', $month)
                ->where('YEAR(transaction.created_at)', $year)
                ->groupBy('DATE(transaction.created_at)')
                ->get();

            //check month
            foreach (getMonth() as $key => $val) {
                if ($month == $key) {
                    $nameMonth = $val;
                }
            }

            $data['month'] = $nameMonth;
            $data['title'] = $title;
            $this->mypdf->generate('pages/admin/report/pdf/perdays/index', $data, $fileName, 'A4', 'landscape');
        }
    }

    public function tes()
    {
        foreach (getMonth() as $key => $val) {
            echo $val;
        }
    }
}

/* End of file Report.php */
