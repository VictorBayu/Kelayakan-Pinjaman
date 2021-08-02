<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party\Spout\Autoloader\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('data_model');
    }

    public function dataTarget()
    {
        $data['title'] = "Data Training";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('data_model', 'dm');

        //load library
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Skripsi/data/dataTarget';
        $config['total_rows'] = $this->dm->count_all_training();
        $config['per_page'] = 12;
        //initialize
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['dm'] = $this->dm->getData($config['per_page'], $data['start']);
        // $data['data'] = $this->db->get('data_training')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/dataTarget', $data);
        $this->load->view('templates/footer');
    }
    public function dataUji()
    {
        $data['title'] = "Data Testing";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('data_model', 'da');
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Skripsi/data/dataUji';
        $config['total_rows'] = $this->da->count_all_uji();
        $config['per_page'] = 10;
        //initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['da'] = $this->da->getDataUji($config['per_page'], $data['start']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/dataUji', $data);
        $this->load->view('templates/footer');
    }
    public function dataPengajuan()
    {
        $data['title'] = "Data Pengajuan Pinjaman";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['data_uji'] = $this->db->get('data_uji')->result_array();
        $this->load->model('data_model', 'du');
        $data['du'] = $this->du->getPengajuan();
        //load library
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Skripsi/data/dataPengajuan';
        $config['total_rows'] = $this->du->count_pengajuan();
        $config['per_page'] = 8;
        //initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['du'] = $this->du->getDataPengajuan($config['per_page'], $data['start']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/dataPengajuan', $data);
        $this->load->view('templates/footer');
    }
    public function naivebayes()
    {
        $this->load->model('data_model', 'du');
        $this->du->truncate1();
        $this->du->truncate2();
        $this->du->truncate3();
        $this->du->hitung();
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Berhasil Melakukan Perhitungan!!
        </div>'
        );
        //$this->du->numberY();
        redirect('data/dataTarget');
    }
    public function testing()
    {
        $this->load->model('data_model', 'du');
        //$this->du->truncateTesting();
        $this->du->testing();
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Berhasil Melakukan Perhitungan Prediksi!!
        </div>'
        );
        redirect('data/dataUji');
    }
    public function deleteTraining()
    {
        $this->db->query("DELETE FROM data_training");
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Success Delete All Data Training!!
        </div>'
        );
        redirect('data/dataTarget');
    }
    public function deletePengajuan()
    {
        $this->db->query("DELETE FROM pengajuan");
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Success Delete All Data!!
        </div>'
        );
        redirect('data/dataPengajuan');
    }
    public function deleteTesting()
    {
        $this->db->query("DELETE FROM data_uji");
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Success Delete All Data!!
        </div>'
        );
        redirect('data/dataUji');
    }
    public function excel()
    {
        $this->load->model('data_model', 'ex');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Loan_ID');
        $sheet->setCellValue('B1', 'Gender');
        $sheet->setCellValue('C1', 'Married');
        $sheet->setCellValue('D1', 'Dependents');
        $sheet->setCellValue('E1', 'Education');
        $sheet->setCellValue('F1', 'Self_Employed');
        $sheet->setCellValue('G1', 'ApplicantIncome');
        $sheet->setCellValue('H1', 'CoapplicantIncome');
        $sheet->setCellValue('I1', 'LoanAmount');
        $sheet->setCellValue('J1', 'Loan_Amount_Term');
        $sheet->setCellValue('K1', 'Credit_History');
        $sheet->setCellValue('L1', 'Property_Area');
        $sheet->setCellValue('M1', 'Loan_Status');

        $data = $this->ex->getdata_training();
        $x = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $x, $row['Loan_ID']);
            $sheet->setCellValue('B' . $x, $row['Gender']);
            $sheet->setCellValue('C' . $x, $row['Married']);
            $sheet->setCellValue('D' . $x, $row['Dependents']);
            $sheet->setCellValue('E' . $x, $row['Education']);
            $sheet->setCellValue('F' . $x, $row['Self_Employed']);
            $sheet->setCellValue('G' . $x, $row['ApplicantIncome']);
            $sheet->setCellValue('H' . $x, $row['CoapplicantIncome']);
            $sheet->setCellValue('I' . $x, $row['LoanAmount']);
            $sheet->setCellValue('J' . $x, $row['Loan_Amount_Term']);
            $sheet->setCellValue('K' . $x, $row['Credit_History']);
            $sheet->setCellValue('L' . $x, $row['Property_Area']);
            $sheet->setCellValue('M' . $x, $row['Loan_Status']);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Training ';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . date('l jS \of F Y h' . ':' . 'i' . ':' . 's A') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    public function exportPengajuan()
    {
        $this->load->model('data_model', 'exp');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No_Loan');
        $sheet->setCellValue('B1', 'Gender');
        $sheet->setCellValue('C1', 'Married');
        $sheet->setCellValue('D1', 'Dependents');
        $sheet->setCellValue('E1', 'Education');
        $sheet->setCellValue('F1', 'Self_Employed');
        $sheet->setCellValue('G1', 'ApplicantIncome');
        $sheet->setCellValue('H1', 'CoapplicantIncome');
        $sheet->setCellValue('I1', 'LoanAmount');
        $sheet->setCellValue('J1', 'Loan_Amount_Term');
        $sheet->setCellValue('K1', 'Credit_History');
        $sheet->setCellValue('L1', 'Property_area');
        $sheet->setCellValue('M1', 'hasilY');
        $sheet->setCellValue('N1', 'hasilN');
        $sheet->setCellValue('O1', 'Prediksi');

        $data = $this->exp->getPengajuan();
        $x = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $x, $row['No']);
            $sheet->setCellValue('B' . $x, $row['Gender']);
            $sheet->setCellValue('C' . $x, $row['Married']);
            $sheet->setCellValue('D' . $x, $row['Dependents']);
            $sheet->setCellValue('E' . $x, $row['Education']);
            $sheet->setCellValue('F' . $x, $row['Self_Employed']);
            $sheet->setCellValue('G' . $x, $row['ApplicantIncome']);
            $sheet->setCellValue('H' . $x, $row['CoapplicantIncome']);
            $sheet->setCellValue('I' . $x, $row['LoanAmount']);
            $sheet->setCellValue('J' . $x, $row['Loan_Amount_Term']);
            $sheet->setCellValue('K' . $x, $row['Credit_History']);
            $sheet->setCellValue('L' . $x, $row['Property_Area']);
            $sheet->setCellValue('M' . $x, $row['hasilY']);
            $sheet->setCellValue('N' . $x, $row['hasilN']);
            $sheet->setCellValue('O' . $x, $row['Prediksi']);
            $x++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data Pengajuan ';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . date('l jS \of F Y h' . ':' . 'i' . ':' . 's A') . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    public function uploadExcelTraining()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importExcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numrow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numrow > 1) {
                        $dataImport = [
                            'Loan_ID'           => $row->getCellAtIndex(0),
                            'Gender'            => $row->getCellAtIndex(1),
                            'Married'           => $row->getCellAtIndex(2),
                            'Dependents'        => $row->getCellAtIndex(3),
                            'Education'         => $row->getCellAtIndex(4),
                            'Self_Employed'     => $row->getCellAtIndex(5),
                            'ApplicantIncome'   => $row->getCellAtIndex(6),
                            'CoapplicantIncome' => $row->getCellAtIndex(7),
                            'LoanAmount'        => $row->getCellAtIndex(8),
                            'Loan_Amount_Term'  => $row->getCellAtIndex(9),
                            'Credit_History'    => $row->getCellAtIndex(10),
                            'Property_Area'     => $row->getCellAtIndex(11),
                            'Loan_Status'       => $row->getCellAtIndex(12),
                        ];
                        $this->data_model->importDataTraining($dataImport);
                    }
                    $numrow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Success Import File!!
                </div>'
                );
                redirect('data/dataTarget');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
    public function sampling()
    {
        $data['title'] = "Data Random Sampling";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        if (isset($_POST['submit'])) {
            $jumlah          = $_POST['jumlah'];
        }
        $data['data_model'] = $this->data_model->sampling($jumlah);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/sampling', $data);
        $this->load->view('templates/footer');
    }
    public function uploadExcelTesting()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importExcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numrow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numrow > 1) {
                        $dataImport = [
                            'Loan_ID'           => $row->getCellAtIndex(0),
                            'Gender'            => $row->getCellAtIndex(1),
                            'Married'           => $row->getCellAtIndex(2),
                            'Dependents'        => $row->getCellAtIndex(3),
                            'Education'         => $row->getCellAtIndex(4),
                            'Self_Employed'     => $row->getCellAtIndex(5),
                            'ApplicantIncome'   => $row->getCellAtIndex(6),
                            'CoapplicantIncome' => $row->getCellAtIndex(7),
                            'LoanAmount'        => $row->getCellAtIndex(8),
                            'Loan_Amount_Term'  => $row->getCellAtIndex(9),
                            'Credit_History'    => $row->getCellAtIndex(10),
                            'Property_Area'     => $row->getCellAtIndex(11),
                            'Loan_Status'       => $row->getCellAtIndex(12),
                        ];
                        $this->data_model->importDataTesting($dataImport);
                    }
                    $numrow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Success Import File!!
                </div>'
                );
                redirect('data/dataUji');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
}
