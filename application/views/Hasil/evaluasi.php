<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= 'Hasil ' . $title; ?></h1>

    <div class="card">
        <div class="card-body">
            <div class="">
                <table class="table table-sm table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Married</th>
                            <th scope="col">Dependent</th>
                            <th scope="col">Education</th>
                            <th scope="col">Self Employed</th>
                            <th scope="col">Applicant Income</th>
                            <th scope="col">Coapplicant Income</th>
                            <th scope="col">Loan Amount</th>
                            <th scope="col">Amount Term</th>
                            <th scope="col">Credit History</th>
                            <th scope="col">Property Area</th>
                            <th scope="col">Loan Status</th>
                            <th scope="col">Prediksi</th>
                            <th scope="col">Ketepatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($de)) : ?>
                            <tr>
                                <td colspan="10">
                                    <div class="alert alert-danger" role="alert"> Data not Found!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($de as $dt) : ?>
                            <?php
                            if ($dt['Gender'] == '1') {
                                $gender = 'Male';
                            } elseif ($dt['Gender'] == '0') {
                                $gender = 'Female';
                            }
                            if ($dt['Married'] == '1') {
                                $married = 'Yes';
                            } elseif ($dt['Married'] == '0') {
                                $married = 'No';
                            }
                            if ($dt['Education'] == '1') {
                                $edu = 'Graduate';
                            } elseif ($dt['Education'] == '0') {
                                $edu = 'Not Graduate';
                            }
                            if ($dt['Self_Employed'] == '1') {
                                $self = 'Yes';
                            } elseif ($dt['Self_Employed'] == '0') {
                                $self = 'No';
                            }
                            if ($dt['Loan_Status'] == '1') {
                                $stat = 'Y';
                            } elseif ($dt['Loan_Status'] == '0') {
                                $stat = 'N';
                            }
                            if ($dt['Prediksi'] == '1') {
                                $pre = 'Y';
                            } elseif ($dt['Prediksi'] == '0') {
                                $pre = 'N';
                            }
                            if ($dt['Loan_Status'] == $dt['Prediksi']) {
                                $tepat = 'Benar';
                            } else {
                                $tepat = 'Salah';
                            }
                            ?>
                            <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td><small><?= $gender; ?></small></td>
                                <td><small><?= $married; ?></small></td>
                                <td><small><?= $dt['Dependents']; ?></small></td>
                                <td><small><?= $edu; ?></small></td>
                                <td><small><?= $self; ?></small></td>
                                <td><small><?= $dt['ApplicantIncome']; ?></small></td>
                                <td><small><?= $dt['CoapplicantIncome']; ?></small></td>
                                <td><small><?= $dt['LoanAmount']; ?></small></td>
                                <td><small><?= $dt['Loan_Amount_Term']; ?></small></td>
                                <td><small><?= $dt['Credit_History']; ?></small></td>
                                <td><small><?= $dt['Property_Area']; ?></small></td>
                                <td><small><?= $stat; ?></small></td>
                                <td><small><?= $pre; ?></small></td>
                                <td><small><?= $tepat == 'Benar' ? "<b>" . $tepat . "</b>" : $tepat ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div><br />

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->