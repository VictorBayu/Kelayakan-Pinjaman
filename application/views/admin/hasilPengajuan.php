<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="col-lg-8">
        <?php foreach ($Data_model as $dm) : ?>
            <?php
            if ($dm['Gender'] == '1') {
                $gender = 'Male';
            } elseif ($dm['Gender'] == '0') {
                $gender = 'Female';
            }
            if ($dm['Married'] == '1') {
                $married = 'Yes';
            } elseif ($dm['Married'] == '0') {
                $married = 'No';
            }
            if ($dm['Education'] == '1') {
                $edu = 'Graduate';
            } elseif ($dm['Education'] == '0') {
                $edu = 'Not Graduate';
            }
            if ($dm['Self_Employed'] == '1') {
                $self = 'Yes';
            } elseif ($dm['Self_Employed'] == '0') {
                $self = 'No';
            }
            // if ($dm['Loan_Status'] == '1') {
            //     $stat = 'Y';
            // } elseif ($dm['Loan_Status'] == '0') {
            //     $stat = 'N';
            // }
            ?>
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Untuk melihat hasil pengajuan <b>KLIK tombol Detail</b></p>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $gender; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Married</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $married; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Dependents</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['Dependents']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Education</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $edu; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Self Employed</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $self; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Applicant Income</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['ApplicantIncome']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Coapplicant Income</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['CoapplicantIncome']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Loan Amount</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['LoanAmount']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Loan Amount Term</label>
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['Loan_Amount_Term']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Credit History</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['Credit_History']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Property Area</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?= $dm['Property_Area']; ?>">
                        </div>
                    </div>
                    <a class="btn btn-primary" href="<?= base_url('admin/tes'); ?>">Hasil Prediksi</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div><br>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->