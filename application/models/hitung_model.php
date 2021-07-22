<?php
class hitung_model extends CI_Model
{
    public function truncate()
    {
        $this->db->query(
            "TRUNCATE tbl_hasil"
        );
    }
    public function hitungPrediksi()
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
        //AMBIL TIAP DATA UJI
        $datauji = $this->db->query(
            "SELECT * FROM data_uji 
            ORDER BY ID"
        );
        foreach ($datauji->result_array() as $row) {
            $id_uji = $row['ID'];

            //aplicantincome
            $numerik_aplicantY = 1 / (sqrt(2 * pi()) * $data1stdev_y * exp(- ((pow($row['ApplicantIncome'] - $data1mean_y, 2)) / (2 * (pow($data1stdev_y, 2))))));
            $numerik_aplicantN = 1 / (sqrt(2 * pi()) * $data1stdev_n * exp(- ((pow($row['ApplicantIncome'] - $data1mean_n, 2)) / (2 * (pow($data1stdev_n, 2))))));

            //coaplicant
            $numerik_coaplicantY = 1 / (sqrt(2 * pi()) * $data2stdev_y * exp(- ((pow($row['CoapplicantIncome'] - $data2mean_y, 2)) / (2 * (pow($data2stdev_y, 2))))));
            $numerik_coaplicantN = 1 / (sqrt(2 * pi()) * $data2stdev_n * exp(- ((pow($row['CoapplicantIncome'] - $data2mean_n, 2)) / (2 * (pow($data2stdev_n, 2))))));

            //loanamount
            $numerik_loanamountY = 1 / (sqrt(2 * pi()) * $data3stdev_y * exp(- ((pow($row['LoanAmount'] - $data3mean_y, 2)) / (2 * (pow($data3stdev_y, 2))))));
            $numerik_loanamountN = 1 / (sqrt(2 * pi()) * $data3stdev_n * exp(- ((pow($row['LoanAmount'] - $data3mean_n, 2)) / (2 * (pow($data3stdev_n, 2))))));

            //loanterm
            $numerik_loantermY = 1 / (sqrt(2 * pi()) * $data4stdev_y * exp(- ((pow($row['Loan_Amount_Term'] - $data4mean_y, 2)) / (2 * (pow($data4stdev_y, 2))))));
            $numerik_loantermN = 1 / (sqrt(2 * pi()) * $data4stdev_n * exp(- ((pow($row['Loan_Amount_Term'] - $data4mean_n, 2)) / (2 * (pow($data4stdev_n, 2))))));

            $insert_numerik = [
                [
                    'id_uji' => $row['ID'],
                    'iterasi' => 'LoanStat_Y',
                    'applicantIncome' => $numerik_aplicantY,
                    'coapplicantIncome' => $numerik_coaplicantY,
                    'loanamount' => $numerik_loanamountY,
                    'loanamount_term' => $numerik_loantermY
                ],
                [
                    'id_uji' => $row['ID'],
                    'iterasi' => 'LoanStat_N',
                    'applicantIncome' => $numerik_aplicantN,
                    'coapplicantIncome' => $numerik_coaplicantN,
                    'loanamount' => $numerik_loanamountN,
                    'loanamount_term' => $numerik_loantermN
                ]
            ];
            $this->db->insert_batch('tbl_gausian', $insert_numerik);

            //data proba
            $data5 = $this->db->get_where('tbl_proba', array('atribut' => $row['Gender']))->result_array();
            foreach ($data5 as $e) {
                $data5Gender_y = $e['prob_Y'];
                $data5Gender_n = $e['prob_N'];
            }
            $data6 = $this->db->get_where('tbl_proba', array('atribut' => $row['Married']))->result_array();
            foreach ($data6 as $f) {
                $data6Married_y = $f['prob_Y'];
                $data6Married_n = $f['prob_N'];
            }
            $data7 = $this->db->get_where('tbl_proba', array('atribut' => $row['Dependents']))->result_array();
            foreach ($data7 as $g) {
                $data7Dependents_y = $g['prob_Y'];
                $data7Dependents_n = $g['prob_N'];
            }
            $data8 = $this->db->get_where('tbl_proba', array('atribut' => $row['Education']))->result_array();
            foreach ($data8 as $h) {
                $data8Education_y = $h['prob_Y'];
                $data8Education_n = $h['prob_N'];
            }
            $data9 = $this->db->get_where('tbl_proba', array('atribut' => $row['Self_Employed']))->result_array();
            foreach ($data9 as $i) {
                $data9Self_Employed_y = $i['prob_Y'];
                $data9Self_Employed_n = $i['prob_N'];
            }
            $data10 = $this->db->get_where('tbl_proba', array('atribut' => $row['Credit_History']))->result_array();
            foreach ($data10 as $j) {
                $data10Credit_y = $j['prob_Y'];
                $data10Credit_n = $j['prob_N'];
            }
            $data11 = $this->db->get_where('tbl_proba', array('atribut' => $row['Property_Area']))->result_array();
            foreach ($data11 as $k) {
                $data11Property_y = $k['prob_Y'];
                $data11Property_n = $k['prob_N'];
            }

            $kelasY = $numerik_aplicantY * $numerik_coaplicantY * $numerik_loanamountY * $numerik_loantermY * $data5Gender_y * $data6Married_y * $data7Dependents_y * $data8Education_y * $data9Self_Employed_y * $data10Credit_y * $data10Credit_y * $data11Property_y * $dataLoan_y;

            $kelasN = $numerik_aplicantN * $numerik_coaplicantN * $numerik_loanamountN * $numerik_loantermN * $data5Gender_n * $data6Married_n * $data7Dependents_n * $data8Education_n * $data9Self_Employed_n * $data10Credit_n * $data10Credit_n * $data11Property_n * $dataLoan_n;

            $kelasY = is_nan($kelasY) ? 0 : $kelasY;
            $kelasN = is_nan($kelasN) ? 0 : $kelasN;

            $insertHasil = [
                'id' => $id_uji,
                'atribut' => 'Uji',
                'Yes' => $kelasY,
                'No' => $kelasN
            ];
            $this->db->insert('tbl_hasil', $insertHasil);
        }

        $ambilData = $this->db->query(
            "SELECT * FROM tbl_hasil
            WHERE atribut = 'Uji' 
            ORDER BY id"
        );
        foreach ($ambilData->result_array() as $compare) {
            $id_data = $compare['id'];

            if ($compare['Yes'] >= $compare['No']) {
                $hasilPrediksi = '1';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('id', $id_data);
                $this->db->update('data_uji', $data);
            } else {
                $hasilPrediksi = '0';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('id', $id_data);
                $this->db->update('data_uji', $data);
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

        //AMBIL DATA PENGAJUAN
        $datapengajuan = $this->db->query(
            "SELECT * FROM pengajuan
            ORDER BY ID DESC LIMIT 1"
        );
        foreach ($datapengajuan->result_array() as $row) {

            //aplicantincome
            $numerik_aplicantY = 1 / (sqrt(2 * pi()) * $data1stdev_y * exp(- ((pow($row['ApplicantIncome'] - $data1mean_y, 2)) / (2 * (pow($data1stdev_y, 2))))));
            $numerik_aplicantN = 1 / (sqrt(2 * pi()) * $data1stdev_n * exp(- ((pow($row['ApplicantIncome'] - $data1mean_n, 2)) / (2 * (pow($data1stdev_n, 2))))));
            if ($numerik_aplicantY != 0) {
                $appY = 0;
            } else {
                $appY = $numerik_aplicantY;
            }
            if ($numerik_aplicantN != 0) {
                $appN = 0;
            } else {
                $appN = $numerik_aplicantN;
            }
            //coaplicant
            $numerik_coaplicantY = 1 / (sqrt(2 * pi()) * $data2stdev_y * exp(- ((pow($row['CoapplicantIncome'] - $data2mean_y, 2)) / (2 * (pow($data2stdev_y, 2))))));
            $numerik_coaplicantN = 1 / (sqrt(2 * pi()) * $data2stdev_n * exp(- ((pow($row['CoapplicantIncome'] - $data2mean_n, 2)) / (2 * (pow($data2stdev_n, 2))))));
            if ($numerik_coaplicantY != 0) {
                $coappY = 0;
            } else {
                $coappY = $numerik_coaplicantY;
            }
            if ($numerik_coaplicantN != 0) {
                $coappN = 0;
            } else {
                $coappN = $numerik_coaplicantN;
            }
            //loanamount
            $numerik_loanamountY = 1 / (sqrt(2 * pi()) * $data3stdev_y * exp(- ((pow($row['LoanAmount'] - $data3mean_y, 2)) / (2 * (pow($data3stdev_y, 2))))));
            $numerik_loanamountN = 1 / (sqrt(2 * pi()) * $data3stdev_n * exp(- ((pow($row['LoanAmount'] - $data3mean_n, 2)) / (2 * (pow($data3stdev_n, 2))))));
            if ($numerik_loanamountY != 0) {
                $lmY = 0;
            } else {
                $lmY = $numerik_loanamountY;
            }
            if ($numerik_loanamountN != 0) {
                $lmN = 0;
            } else {
                $lmN = $numerik_loanamountN;
            }
            //loanterm
            $numerik_loantermY = 1 / (sqrt(2 * pi()) * $data4stdev_y * exp(- ((pow($row['Loan_Amount_Term'] - $data4mean_y, 2)) / (2 * (pow($data4stdev_y, 2))))));
            $numerik_loantermN = 1 / (sqrt(2 * pi()) * $data4stdev_n * exp(- ((pow($row['Loan_Amount_Term'] - $data4mean_n, 2)) / (2 * (pow($data4stdev_n, 2))))));
            if ($numerik_loantermY != 0) {
                $ltY = 0;
            } else {
                $ltY = $numerik_loantermY;
            }
            if ($numerik_loantermN != 0) {
                $ltN = 0;
            } else {
                $ltN = $numerik_loantermN;
            }
            //data proba
            $data5 = $this->db->get_where('tbl_proba', array('atribut' => $row['Gender']))->result_array();
            foreach ($data5 as $e) {
                $data5Gender_y = $e['prob_Y'];
                $data5Gender_n = $e['prob_N'];
            }
            $data6 = $this->db->get_where('tbl_proba', array('atribut' => $row['Married']))->result_array();
            foreach ($data6 as $f) {
                $data6Married_y = $f['prob_Y'];
                $data6Married_n = $f['prob_N'];
            }
            $data7 = $this->db->get_where('tbl_proba', array('atribut' => $row['Dependents']))->result_array();
            foreach ($data7 as $g) {
                $data7Dependents_y = $g['prob_Y'];
                $data7Dependents_n = $g['prob_N'];
            }
            $data8 = $this->db->get_where('tbl_proba', array('atribut' => $row['Education']))->result_array();
            foreach ($data8 as $h) {
                $data8Education_y = $h['prob_Y'];
                $data8Education_n = $h['prob_N'];
            }
            $data9 = $this->db->get_where('tbl_proba', array('atribut' => $row['Self_Employed']))->result_array();
            foreach ($data9 as $i) {
                $data9Self_Employed_y = $i['prob_Y'];
                $data9Self_Employed_n = $i['prob_N'];
            }
            $data10 = $this->db->get_where('tbl_proba', array('atribut' => $row['Credit_History']))->result_array();
            foreach ($data10 as $j) {
                $data10Credit_y = $j['prob_Y'];
                $data10Credit_n = $j['prob_N'];
            }
            $data11 = $this->db->get_where('tbl_proba', array('atribut' => $row['Property_Area']))->result_array();
            foreach ($data11 as $k) {
                $data11Property_y = $k['prob_Y'];
                $data11Property_n = $k['prob_N'];
            }
            $kelasY = $appY * $coappY * $lmY * $ltY * $data5Gender_y * $data6Married_y * $data7Dependents_y * $data8Education_y * $data9Self_Employed_y * $data10Credit_y * $data10Credit_y * $data11Property_y * $dataLoan_y;

            $kelasN = $appN * $coappN * $lmN * $ltN * $data5Gender_n * $data6Married_n * $data7Dependents_n * $data8Education_n * $data9Self_Employed_n * $data10Credit_n * $data10Credit_n * $data11Property_n * $dataLoan_n;

            // if ($kelasY != 0) {
            //     $kelasY = 0;
            // }
            // $kelasY = ($kelasY != 0) ? ($kelasY) : 0;
            // $kelasN = ($kelasN != 0) ? ($kelasN) : 0;
            // $kelasY = is_nan($kelasY) ? 0 : $kelasY;
            // $kelasN = is_nan($kelasN) ? 0 : $kelasN;
            $id_data = $row['ID'];
            $updatePengajuan = [
                'hasilY' => $kelasY,
                'hasilN' => $kelasN
            ];
            $this->db->where('ID', $id_data);
            $this->db->update('pengajuan', $updatePengajuan);

            if ($row['hasilY'] > $row['hasilN']) {
                $hasilPrediksi = '1';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">
                    Pengajuan Pinjaman Diterima!!
                </div>'
                );
            } elseif ($row['hasilY'] < $row['hasilN']) {
                $hasilPrediksi = '0';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Pengajuan Pinjaman Ditolak!!
                </div>'
                );
            } elseif ($row['hasilY'] == $row['hasilN']) {
                $hasilPrediksi = '0';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Pengajuan Pinjaman Ditolak!!
                </div>'
                );
            } else {
                $hasilPrediksi = '0';
                $data = ['Prediksi' => $hasilPrediksi];
                $this->db->where('ID', $id_data);
                $this->db->update('pengajuan', $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Pengajuan Pinjaman Ditolak!!
                </div>'
                );
            }
        }
    }
}
