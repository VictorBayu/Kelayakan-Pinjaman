<?php
class hitung_model extends CI_Model
{
    public function truncate()
    {
        $this->db->query(
            "TRUNCATE tbl_hasil"
        );
    }
    public function updatePrediksi()
    {
        $data = $this->db->query(
            "SELECT * FROM pengajuan
            ORDER BY ID DESC LIMIT 1"
        );
        foreach ($data->result_array() as $dt) {
            $id_data = $dt['ID'];
            if ($dt['hasilY'] > $dt['hasilN']) {
                $hasilPrediksi = '1';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
            } elseif ($dt['hasilY'] < $dt['hasilN'] || $dt['hasilY'] == $dt['hasilN']) {
                $hasilPrediksi = '0';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
            }
        }
    }
    public function alert()
    {
        $data_alert = $this->db->query(
            "SELECT * FROM pengajuan
            ORDER BY ID DESC LIMIT 1"
        );
        foreach ($data_alert->result_array() as $alert) {
            if ($alert['Prediksi'] == '1') {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Pengajuan Pinjaman Diterima!!
                </div>'
                );
            } elseif ($alert['Prediksi'] == '0') {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Pengajuan Pinjaman Ditolak!!
                </div>'
                );
            } elseif ($alert['Prediksi'] == '-1') {
                echo " ";
            }
        }
    }
    public function pengajuan()
    {
        $data1 = $this->db->get_where('tbl_numerik', array('atribut' => 'ApplicantIncome'))->result_array();
        foreach ($data1 as $a) {
            $data1mean_y = $a['mean_y'];
            $data1mean_n = $a['mean_n'];
            $data1stdev_y = $a['stdev_y'];
            $data1stdev_n = $a['stdev_n'];
        }
        $data2 = $this->db->get_where('tbl_numerik', array('atribut' => 'CoapplicantIncome'))->result_array();
        foreach ($data2 as $b) {
            $data2mean_y = $b['mean_y'];
            $data2mean_n = $b['mean_n'];
            $data2stdev_y = $b['stdev_y'];
            $data2stdev_n = $b['stdev_n'];
        }
        $data3 = $this->db->get_where('tbl_numerik', array('atribut' => 'LoanAmount'))->result_array();
        foreach ($data3 as $c) {
            $data3mean_y = $c['mean_y'];
            $data3mean_n = $c['mean_n'];
            $data3stdev_y = $c['stdev_y'];
            $data3stdev_n = $c['stdev_n'];
        }
        $data4 = $this->db->get_where('tbl_numerik', array('atribut' => 'LoanAmountTerm'))->result_array();
        foreach ($data4 as $d) {
            $data4mean_y = $d['mean_y'];
            $data4mean_n = $d['mean_n'];
            $data4stdev_y = $d['stdev_y'];
            $data4stdev_n = $d['stdev_n'];
        }
        $dataLoan = $this->db->get_where('tbl_proba', array('atribut' => 'P_Loan'))->result_array();
        foreach ($dataLoan as $loan) {
            $dataLoan_y = $loan['prob_Y'];
            $dataLoan_n = $loan['prob_N'];
        }
        $pi = 3.141592654;
        //AMBIL DATA PENGAJUAN
        $datapengajuan = $this->db->query(
            "SELECT * FROM pengajuan
            ORDER BY ID DESC LIMIT 1"
        );
        foreach ($datapengajuan->result_array() as $row) {

            //aplicantincome
            $appY = @(1 / (sqrt(2 * $pi) * $data1stdev_y) * exp(- (round((pow($row['ApplicantIncome'] - $data1mean_y, 2)), 4) / (2 * round((pow($data1stdev_y, 2)), 2)))));
            $appN = @round(1 / (sqrt(2 * $pi) * $data1stdev_n) * exp(- (round((pow($row['ApplicantIncome'] - $data1mean_n, 2)), 4) / (2 * round((pow($data1stdev_n, 2)), 2)))), 4);
            //coaplicant
            $coappY = @round(1 / (sqrt(2 * $pi) * $data2stdev_y) * exp(- (round((pow($row['CoapplicantIncome'] - $data2mean_y, 2)), 4) / (2 * round((pow($data2stdev_y, 2)), 2)))), 4);
            $coappN = @round(1 / (sqrt(2 * $pi) * $data2stdev_n) * exp(- (round((pow($row['CoapplicantIncome'] - $data2mean_n, 2)), 4) / (2 * round((pow($data2stdev_n, 2)), 2)))), 4);
            //loanamount
            $lmY = @round(1 / (sqrt(2 * $pi) * $data3stdev_y) * exp(- (round((pow($row['LoanAmount'] - $data3mean_y, 2)), 4) / (2 * round((pow($data3stdev_y, 2)), 4)))), 4);
            $lmN = @round(1 / (sqrt(2 * $pi) * $data3stdev_n) * exp(- (round((pow($row['LoanAmount'] - $data3mean_n, 2)), 4) / (2 * round((pow($data3stdev_n, 2)), 4)))), 4);
            //loanterm
            $ltY = @round(1 / (sqrt(2 * $pi) * $data4stdev_y) * exp(- (round((pow($row['Loan_Amount_Term'] - $data4mean_y, 2)), 4) / (2 * round((pow($data4stdev_y, 2)), 4)))), 4);
            $ltN = @round(1 / (sqrt(2 * $pi) * $data4stdev_n) * exp(- (round((pow($row['Loan_Amount_Term'] - $data4mean_n, 2)), 4) / (2 * round((pow($data4stdev_n, 2)), 4)))), 4);
            $data6 = $this->db->get_where('tbl_proba', array('atribut' => $row['Married'], 'ID_atribut' => 2))->result_array();
            foreach ($data6 as $f) {
                $data6Married_y = $f['prob_Y'];
                $data6Married_n = $f['prob_N'];
            }
            $data7 = $this->db->get_where('tbl_proba', array('atribut' => $row['Dependents'], 'ID_atribut' => 3))->result_array();
            foreach ($data7 as $g) {
                $data7Dependents_y = $g['prob_Y'];
                $data7Dependents_n = $g['prob_N'];
            }
            $data8 = $this->db->get_where('tbl_proba', array('atribut' => $row['Education'], 'ID_atribut' => 4))->result_array();
            foreach ($data8 as $h) {
                $data8Education_y = $h['prob_Y'];
                $data8Education_n = $h['prob_N'];
            }
            $data9 = $this->db->get_where('tbl_proba', array('atribut' => $row['Self_Employed'], 'ID_atribut' => 5))->result_array();
            foreach ($data9 as $i) {
                $data9Self_Employed_y = $i['prob_Y'];
                $data9Self_Employed_n = $i['prob_N'];
            }
            $data10 = $this->db->get_where('tbl_proba', array('atribut' => $row['Credit_History'], 'ID_atribut' => 6))->result_array();
            foreach ($data10 as $j) {
                $data10Credit_y = $j['prob_Y'];
                $data10Credit_n = $j['prob_N'];
            }
            $data11 = $this->db->get_where('tbl_proba', array('atribut' => $row['Property_Area'], 'ID_atribut' => 7))->result_array();
            foreach ($data11 as $k) {
                $data11Property_y = $k['prob_Y'];
                $data11Property_n = $k['prob_N'];
            }
            $kelasY = round($appY, 4) * round($coappY, 4) * round($lmY, 4) * round($ltY, 4) * round($data6Married_y, 4) * round($data7Dependents_y, 4) * round($data8Education_y, 4) * round($data9Self_Employed_y, 4) * round($data10Credit_y, 4) * round($data11Property_y, 4) * round($dataLoan_y, 4);

            $kelasN = round($appN, 4) * round($coappN, 4) * round($lmN, 4) * round($ltN, 4) * round($data6Married_n, 4) * round($data7Dependents_n, 4) * round($data8Education_n, 4) * round($data9Self_Employed_n, 4) * round($data10Credit_n, 4) * round($data11Property_n, 4) * round($dataLoan_n, 4);

            $kelasY = is_infinite($kelasY) ? 0 : $kelasY;
            $kelasN = is_infinite($kelasN) ? 0 : $kelasN;
            $id_data = $row['ID'];
            $updatePengajuan = [
                'hasilY' => $kelasY,
                'hasilN' => $kelasN
            ];
            $this->db->where('ID', $id_data);
            $this->db->update('pengajuan', $updatePengajuan);
        }
    }
}
