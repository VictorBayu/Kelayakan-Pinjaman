<?php
class data_model extends CI_Model
{
    public function getdata_training()
    {
        return $this->db->get('data_training')->result_array();
    }
    public function getPengajuan()
    {
        return $this->db->get('pengajuan')->result_array();
    }
    public function datatrain()
    {
        return $this->db->get('data_training')->result();
    }
    public function getData($limit, $start)
    {
        return $this->db->get('data_training', $limit, $start)->result_array();
    }
    public function getDataUji($limit, $start)
    {
        return $this->db->get('data_uji', $limit, $start)->result_array();
    }
    public function count_all_training()
    {
        return $this->db->get('data_training')->num_rows();
    }
    public function count_all_uji()
    {
        return $this->db->get('data_uji')->num_rows();
    }
    public function count_pengajuan()
    {
        return $this->db->get('pengajuan')->num_rows();
    }
    public function getDataPengajuan($limit, $start)
    {
        return $this->db->get('pengajuan', $limit, $start)->result_array();
    }
    public function sampling($value)
    {
        return $this->db->query(
            "SELECT * FROM data_training 
            ORDER BY rand() LIMIT $value"
        );
    }
    public function importDataTraining($dataImport)
    {
        $jumlah_data = count($dataImport);
        if ($jumlah_data > 0) {
            $this->db->replace('data_training', $dataImport);
        }
    }
    public function importDataTesting($dataImport)
    {
        $jumlah_data = count($dataImport);
        if ($jumlah_data > 0) {
            $this->db->replace('data_uji', $dataImport);
        }
    }
    public function loadPengujian()
    {
        return $this->db->query(
            "SELECT * FROM pengajuan
            ORDER BY ID DESC LIMIT 1"
        )->result_array();
    }
    public function truncate1()
    {
        $this->db->query(
            "TRUNCATE tbl_proba"
        );
    }
    public function truncate2()
    {
        $this->db->query(
            "TRUNCATE tbl_numerik"
        );
    }
    public function truncate3()
    {
        $this->db->query(
            "TRUNCATE tbl_grafik"
        );
    }
    public function hitungdata()
    {
        $qw = $this->db->get_where(
            'data_training',
            ['Loan_Status' => '1']
        )->num_rows();
    }
    public function coba()
    {
        $data1 = $this->db->query("SELECT * FROM `tbl_numerik` WHERE `atribut` = 'ApplicantIncome'")->result_array();
    }
    public function hitung()
    {
        $qw = $this->db->get_where(
            'data_training',
            ['Loan_Status' => '0']
        )->num_rows();
        // hitung jumlah data training
        $hitungTraining = $this->db->get('data_training')->num_rows();

        //hitung jumlah probabilitas tiap loan status
        $jumlahStatusY = $this->db->get_where(
            'data_training',
            array(
                'Loan_Status' => '1'
            )
        )->num_rows();

        $jumlahStatusN = $this->db->get_where(
            'data_training',
            array(
                'Loan_Status' => '0'
            )
        )->num_rows();

        $p_1 = round(($jumlahStatusY / $hitungTraining), 9);
        $p_2 = round(($jumlahStatusN / $hitungTraining), 9);

        $input = "INSERT INTO `tbl_proba` VALUES ('', 1, 'P_Loan', '$p_1','$p_2')";
        $this->db->query($input);

        //HITUNG PROBABILITAS GENDER
        $genderMale_Y = $this->db->get_where(
            'data_training',
            array(
                'Gender' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $genderFemale_Y = $this->db->get_where(
            'data_training',
            array(
                'Gender' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $genderMale_N = $this->db->get_where(
            'data_training',
            array(
                'Gender' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $genderFemale_N = $this->db->get_where(
            'data_training',
            array(
                'Gender' => '0',
                'Loan_Status' => '0'
            )
        )->num_rows();

        $probMale_Y = round(($genderMale_Y / $jumlahStatusY), 9);
        $probMale_N = round(($genderMale_N / $jumlahStatusN), 9);

        $probFemale_Y = round(($genderFemale_Y / $jumlahStatusY), 9);
        $probFemale_N = round(($genderFemale_N / $jumlahStatusN), 9);

        $dataMale = [
            [
                'ID_atribut' => 2,
                'atribut' => 'Male',
                'prob_Y' => $probMale_Y,
                'prob_N' => $probMale_N
            ],
            [
                'ID_atribut' => 2,
                'atribut' => 'Female',
                'prob_Y' => $probFemale_Y,
                'prob_N' => $probFemale_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataMale);

        //HITUNG PROBABILITAS MARRIED
        $MarriedYes_Y = $this->db->get_where(
            'data_training',
            array(
                'Married' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $MarriedYes_N = $this->db->get_where(
            'data_training',
            array(
                'Married' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $MarriedNo_Y = $this->db->get_where(
            'data_training',
            array(
                'Married' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $MarriedNo_N = $this->db->get_where(
            'data_training',
            array(
                'Married' => '0',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $probMarriedYes_Y = round(($MarriedYes_Y / $jumlahStatusY), 9);
        $probMarriedNo_Y = round(($MarriedNo_Y / $jumlahStatusY), 9);
        $probMarriedYes_N = round(($MarriedYes_N / $jumlahStatusN), 9);
        $probMarriedNo_N = round(($MarriedNo_N / $jumlahStatusN), 9);

        $dataMarried = [
            [
                'ID_atribut' => 3,
                'atribut' => 'Yes',
                'prob_Y' => $probMarriedYes_Y,
                'prob_N' => $probMarriedYes_N
            ],
            [
                'ID_atribut' => 3,
                'atribut' => 'No',
                'prob_Y' => $probMarriedNo_Y,
                'prob_N' => $probMarriedNo_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataMarried);

        //HITUNG PROBABILITAS DEPENDENTS
        $Depen0_Y = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Depen0_N = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '0',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $Depen1_Y = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Depen1_N = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $Depen2_Y = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '2',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Depen2_N = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '2',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $Depen3_Y = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '3+',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Depen3_N = $this->db->get_where(
            'data_training',
            array(
                'Dependents' => '3+',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $probDepen0_Y = round(($Depen0_Y / $jumlahStatusY), 9);
        $probDepen0_N = round(($Depen0_N / $jumlahStatusN), 9);
        $probDepen1_Y = round(($Depen1_Y / $jumlahStatusY), 9);
        $probDepen1_N = round(($Depen1_N / $jumlahStatusN), 9);
        $probDepen2_Y = round(($Depen2_Y / $jumlahStatusY), 9);
        $probDepen2_N = round(($Depen2_N / $jumlahStatusN), 9);
        $probDepen3_Y = round(($Depen3_Y / $jumlahStatusY), 9);
        $probDepen3_N = round(($Depen3_N / $jumlahStatusN), 9);

        $dataDepen = [
            [
                'ID_atribut' => 4,
                'atribut' => '0',
                'prob_Y' => $probDepen0_Y,
                'prob_N' => $probDepen0_N
            ],
            [
                'ID_atribut' => 4,
                'atribut' => '1',
                'prob_Y' => $probDepen1_Y,
                'prob_N' => $probDepen1_N
            ],
            [
                'ID_atribut' => 4,
                'atribut' => '2',
                'prob_Y' => $probDepen2_Y,
                'prob_N' => $probDepen2_N
            ],
            [
                'ID_atribut' => 4,
                'atribut' => '3+',
                'prob_Y' => $probDepen3_Y,
                'prob_N' => $probDepen3_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataDepen);

        //HITUNG PROBABILITAS EDUCATION
        $eduGraduateY = $this->db->get_where(
            'data_training',
            array(
                'Education' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $eduNotGraduateY = $this->db->get_where(
            'data_training',
            array(
                'Education' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();

        $eduGraduateN = $this->db->get_where(
            'data_training',
            array(
                'Education' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $eduNotGraduateN = $this->db->get_where(
            'data_training',
            array(
                'Education' => '0',
                'Loan_Status' => '0'
            )
        )->num_rows();

        $probGraduateY = round(($eduGraduateY / $jumlahStatusY), 9);
        $probGraduateN = round(($eduGraduateN / $jumlahStatusN), 9);

        $probNotGraduateY = round(($eduNotGraduateY / $jumlahStatusY), 9);
        $probNotGraduateN = round(($eduNotGraduateN / $jumlahStatusN), 9);

        $dataEdu = [
            [
                'ID_atribut' => 5,
                'atribut' => 'Graduate',
                'prob_Y' => $probGraduateY,
                'prob_N' => $probGraduateN
            ],
            [
                'ID_atribut' => 5,
                'atribut' => 'Not_Graduate',
                'prob_Y' => $probNotGraduateY,
                'prob_N' => $probNotGraduateN
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataEdu);

        //hHITUNG PROBABILITAS SELF_EMPLOYED
        $SelfYes_Y = $this->db->get_where(
            'data_training',
            array(
                'Self_Employed' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $SelfYes_N = $this->db->get_where(
            'data_training',
            array(
                'Self_Employed' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $SelfNo_Y = $this->db->get_where(
            'data_training',
            array(
                'Self_Employed' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $SelfNo_N = $this->db->get_where(
            'data_training',
            array(
                'Self_Employed' => '0',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $probSelfYes_Y = round(($SelfYes_Y / $jumlahStatusY), 9);
        $probSelfNo_Y = round(($SelfNo_Y / $jumlahStatusY), 9);
        $probSelfYes_N = round(($SelfYes_N / $jumlahStatusN), 9);
        $probSelfNo_N = round(($SelfNo_N / $jumlahStatusN), 9);

        $dataSelf = [
            [
                'ID_atribut' => 6,
                'atribut' => 'Yes',
                'prob_Y' => $probSelfYes_Y,
                'prob_N' => $probSelfYes_N
            ],
            [
                'ID_atribut' => 6,
                'atribut' => 'No',
                'prob_Y' => $probSelfNo_Y,
                'prob_N' => $probSelfNo_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataSelf);
        //HITUNG PROBABILITAS CREDIT_HISTORY
        $Credit1_Y = $this->db->get_where(
            'data_training',
            array(
                'Credit_History' => '1',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Credit1_N = $this->db->get_where(
            'data_training',
            array(
                'Credit_History' => '1',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $Credit0_Y = $this->db->get_where(
            'data_training',
            array(
                'Credit_History' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $Credit0_N = $this->db->get_where(
            'data_training',
            array(
                'Credit_History' => '0',
                'Loan_Status' => '1'
            )
        )->num_rows();

        $probCredit1_Y = round(($Credit1_Y / $jumlahStatusY), 9);
        $probCredit1_N = round(($Credit1_N / $jumlahStatusN), 9);
        $probCredit0_Y = round(($Credit0_Y / $jumlahStatusY), 9);
        $probCredit0_N = round(($Credit0_N / $jumlahStatusN), 9);

        $dataCredit = [
            [
                'ID_atribut' => 7,
                'atribut' => '1',
                'prob_Y' => $probCredit1_Y,
                'prob_N' => $probCredit1_N
            ],
            [
                'ID_atribut' => 7,
                'atribut' => '0',
                'prob_Y' => $probCredit0_Y,
                'prob_N' => $probCredit0_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataCredit);

        //HITUNG PROBABILITAS PROPERTY_AREA
        $PropertyRural_Y = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Rural',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $PropertyRural_N = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Rural',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $PropertyUrban_Y = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Urban',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $PropertyUrban_N = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Urban',
                'Loan_Status' => '0'
            )
        )->num_rows();
        $PropertySemiurban_Y = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Semiurban',
                'Loan_Status' => '1'
            )
        )->num_rows();
        $PropertySemiurban_N = $this->db->get_where(
            'data_training',
            array(
                'Property_Area' => 'Semiurban',
                'Loan_Status' => '0'
            )
        )->num_rows();

        $probPropertyUrban_Y = round(($PropertyUrban_Y / $jumlahStatusY), 9);
        $probPropertyUrban_N = round(($PropertyUrban_N / $jumlahStatusN), 9);
        $probPropertyRural_Y = round(($PropertyRural_Y / $jumlahStatusY), 9);
        $probPropertyRural_N = round(($PropertyRural_N / $jumlahStatusN), 9);
        $probPropertySemiurban_Y = round(($PropertySemiurban_Y / $jumlahStatusY), 9);
        $probPropertySemiurban_N = round(($PropertySemiurban_N / $jumlahStatusN), 9);

        $dataProperty = [
            [
                'ID_atribut' => 8,
                'atribut' => 'Urban',
                'prob_Y' => $probPropertyUrban_Y,
                'prob_N' => $probPropertyUrban_N
            ],
            [
                'ID_atribut' => 8,
                'atribut' => 'Rural',
                'prob_Y' => $probPropertyRural_Y,
                'prob_N' => $probPropertyRural_N
            ],
            [
                'ID_atribut' => 8,
                'atribut' => 'Semiurban',
                'prob_Y' => $probPropertySemiurban_Y,
                'prob_N' => $probPropertySemiurban_N
            ]
        ];
        $this->db->insert_batch('tbl_proba', $dataProperty);

        //HITUNG MEAN APPLICANT INCOME
        $applicant_y = $this->db->query(
            "SELECT DISTINCT AVG(ApplicantIncome) as income_y 
            FROM `data_training`
            WHERE `Loan_Status` = '1'"
        )->row();
        $meanApplicant_Y = round($applicant_y->income_y, 15);
        $applicant_n = $this->db->query(
            "SELECT DISTINCT AVG(ApplicantIncome) as income_n 
            FROM `data_training`
            WHERE `Loan_Status` = '0'"
        )->row();
        $meanApplicant_N = round($applicant_n->income_n, 15);

        //HITUNG STDEV APPLICANT INCOME
        $stApplicant_y = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(ApplicantIncome) 
            as stdIncome_y
            FROM `data_training` WHERE `Loan_Status` = '1'"
        )->row();
        $stdevApp_Y = round($stApplicant_y->stdIncome_y, 15);
        $stApplicant_n = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(ApplicantIncome) 
            as stdIncome_n
            FROM `data_training` WHERE `Loan_Status` = '0'"
        )->row();
        $stdevApp_N = round($stApplicant_n->stdIncome_n, 15);


        //HITUNG MEAN COAPPLICANT INCOME
        $coapplicant_y = $this->db->query(
            "SELECT DISTINCT AVG(CoapplicantIncome) as coincome_y 
            FROM `data_training`
            WHERE `Loan_Status` = '1'"
        )->row();
        $meancoApplicant_Y = round($coapplicant_y->coincome_y, 15);
        $coapplicant_n = $this->db->query(
            "SELECT DISTINCT AVG(CoapplicantIncome) as coincome_n 
            FROM `data_training`
            WHERE `Loan_Status` = '0'"
        )->row();
        $meancoApplicant_N = round($coapplicant_n->coincome_n, 15);

        //HITUNG STDEV COAPPLICANT INCOME
        $stcoApplicant_y = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(CoapplicantIncome) 
            as stdcoIncome_y
            FROM `data_training` WHERE `Loan_Status` = '1'"
        )->row();
        $stdevcoApp_Y = round($stcoApplicant_y->stdcoIncome_y, 15);
        $stcoApplicant_n = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(CoapplicantIncome) 
            as stdcoIncome_n
            FROM `data_training` WHERE `Loan_Status` = '0'"
        )->row();
        $stdevcoApp_N = round($stcoApplicant_n->stdcoIncome_n, 15);

        //HITUNG MEAN LOAN AMOUNT
        $loanamount_y = $this->db->query(
            "SELECT DISTINCT AVG(LoanAmount) 
            as loanamount_y 
            FROM `data_training`
            WHERE `Loan_Status` = '1'"
        )->row();
        $meanloanamount_Y = round($loanamount_y->loanamount_y, 15);
        $loanamount_n = $this->db->query(
            "SELECT DISTINCT AVG(LoanAmount) 
            as loanamount_n 
            FROM `data_training`
            WHERE `Loan_Status` = '0'"
        )->row();
        $meanloanamount_N = round($loanamount_n->loanamount_n, 15);

        //HITUNG STDEV LOAN AMOUNT
        $stloanamount_y = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(LoanAmount) 
            as stdloanAmount_y
            FROM `data_training` WHERE `Loan_Status` = '1'"
        )->row();
        $stdevloanamount_Y = round($stloanamount_y->stdloanAmount_y, 15);
        $stloanamount_n = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(LoanAmount) 
            as stdloanAmount_n
            FROM `data_training` WHERE `Loan_Status` = '0'"
        )->row();
        $stdevloanamount_N = round($stloanamount_n->stdloanAmount_n, 15);

        //HITUNG MEAN LOAN AMOUNT TERM
        $loanamountTerm_y = $this->db->query(
            "SELECT DISTINCT AVG(Loan_Amount_Term) 
            as amountTerm_y 
            FROM `data_training`
            WHERE `Loan_Status` = '1'"
        )->row();
        $meanloanamountTerm_Y = round($loanamountTerm_y->amountTerm_y, 15);
        $loanamountTerm_n = $this->db->query(
            "SELECT DISTINCT AVG(Loan_Amount_Term) 
            as amountTerm_n 
            FROM `data_training`
            WHERE `Loan_Status` = '0'"
        )->row();
        $meanloanamountTerm_N = round($loanamountTerm_n->amountTerm_n, 15);

        //HITUNG STDEV LOAN AMOUNT
        $stloanamountTerm_y = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(Loan_Amount_Term) 
            as stdloanAmountTerm_y
            FROM `data_training` WHERE `Loan_Status` = '1'"
        )->row();
        $stdevloanamountTerm_Y = round($stloanamountTerm_y->stdloanAmountTerm_y, 15);
        $stloanamountTerm_n = $this->db->query(
            "SELECT DISTINCT STDDEV_POP(Loan_Amount_Term) 
            as stdloanAmountTerm_n
            FROM `data_training` WHERE `Loan_Status` = '0'"
        )->row();
        $stdevloanamountTerm_N = round($stloanamountTerm_n->stdloanAmountTerm_n, 15);

        $numerik = [
            [
                'atribut' => 'ApplicantIncome',
                'mean_y' => $meanApplicant_Y,
                'mean_n' => $meanApplicant_N,
                'stdev_y' => $stdevApp_Y,
                'stdev_n' => $stdevApp_N
            ],
            [
                'atribut' => 'CoapplicantIncome',
                'mean_y' => $meancoApplicant_Y,
                'mean_n' => $meancoApplicant_N,
                'stdev_y' => $stdevcoApp_Y,
                'stdev_n' => $stdevcoApp_N
            ],
            [
                'atribut' => 'LoanAmount',
                'mean_y' => $meanloanamount_Y,
                'mean_n' => $meanloanamount_N,
                'stdev_y' => $stdevloanamount_Y,
                'stdev_n' => $stdevloanamount_N
            ],
            [
                'atribut' => 'LoanAmountTerm',
                'mean_y' => $meanloanamountTerm_Y,
                'mean_n' => $meanloanamountTerm_N,
                'stdev_y' => $stdevloanamountTerm_Y,
                'stdev_n' => $stdevloanamountTerm_N
            ]
        ];
        $this->db->insert_batch('tbl_numerik', $numerik);

        //data grafik
        $data_grafik = [
            [
                'ID_atribut' => 1,
                'atribut' => 'Male',
                'Yes' => $genderMale_Y,
                'No' => $genderMale_N
            ],
            [
                'ID_atribut' => 1,
                'atribut' => 'Female',
                'Yes' => $genderFemale_Y,
                'No' => $genderFemale_N
            ],
            [
                'ID_atribut' => 2,
                'atribut' => 'Married_Yes',
                'Yes' => $MarriedYes_Y,
                'No' => $MarriedYes_N
            ],
            [
                'ID_atribut' => 2,
                'atribut' => 'Married_No',
                'Yes' => $MarriedNo_Y,
                'No' => $MarriedNo_N
            ],
            [
                'ID_atribut' => 3,
                'atribut' => '0',
                'Yes' => $Depen0_Y,
                'No' => $Depen0_N
            ],
            [
                'ID_atribut' => 3,
                'atribut' => '1',
                'Yes' => $Depen1_Y,
                'No' => $Depen1_N
            ],
            [
                'ID_atribut' => 3,
                'atribut' => '2',
                'Yes' => $Depen2_Y,
                'No' => $Depen2_N
            ],
            [
                'ID_atribut' => 3,
                'atribut' => '3+',
                'Yes' => $Depen3_Y,
                'No' => $Depen3_N
            ],
            [
                'ID_atribut' => 4,
                'atribut' => 'eduGraduate',
                'Yes' => $eduGraduateY,
                'No' => $eduGraduateN
            ],
            [
                'ID_atribut' => 4,
                'atribut' => 'eduNotGraduate',
                'Yes' => $eduNotGraduateY,
                'No' => $eduNotGraduateN
            ],
            [
                'ID_atribut' => 5,
                'atribut' => 'SelfY',
                'Yes' => $SelfYes_Y,
                'No' => $SelfYes_N
            ],
            [
                'ID_atribut' => 5,
                'atribut' => 'SelfN',
                'Yes' => $SelfNo_Y,
                'No' => $SelfNo_N
            ],
            [
                'ID_atribut' => 6,
                'atribut' => 'Credit1',
                'Yes' => $Credit1_Y,
                'No' => $Credit1_N
            ],
            [
                'ID_atribut' => 6,
                'atribut' => 'Credit0',
                'Yes' => $Credit0_Y,
                'No' => $Credit0_N
            ],
            [
                'ID_atribut' => 7,
                'atribut' => 'Urban',
                'Yes' => $PropertyUrban_Y,
                'No' => $PropertyUrban_N
            ],
            [
                'ID_atribut' => 7,
                'atribut' => 'Rural',
                'Yes' => $PropertyRural_Y,
                'No' => $PropertyRural_N
            ],
            [
                'ID_atribut' => 7,
                'atribut' => 'Semiurban',
                'Yes' => $PropertySemiurban_Y,
                'No' => $PropertySemiurban_N
            ]
        ];
        $this->db->insert_batch('tbl_grafik', $data_grafik);
    }
}
