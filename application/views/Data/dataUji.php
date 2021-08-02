<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="toolbar">
                <div class="login-social-inner">
                    <a class="btn btn-primary" href="<?= base_url('Data/testing'); ?>" role="button"> <span><i class="fa fa-code"></i></span> Testing</a>
                    <!-- <a class="btn btn-info" href="" data-toggle="modal" data-target="#ModalRandom"> <span><i class="fa fa-cogs"></i></span> Random Sampling</a> -->
                    <a class="btn btn-danger" href="<?= base_url('Data/deleteTesting'); ?>" data-toggle="modal" data-target="#ModalDelete"> <span><i class="fa fa-trash"></i></span> Delete Data Testing</a>
                    <a class="btn btn-warning" href="<?= base_url('Data/uploadExcelTesting'); ?>" data-toggle="modal" data-target="#ModalImportExcel"><span><i class="fa fa-upload"></i></span> Import File Excel</a>

                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div><br />
    </div>
    <div class="row">
        <div>
            <table class="table table-sm table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Loan ID</th>
                        <th scope="col">Married</th>
                        <th scope="col">Dependent</th>
                        <th scope="col">Education</th>
                        <th scope="col">Self Employed</th>
                        <th scope="col">Applicant Income</th>
                        <th scope="col">Loan Amount</th>
                        <th scope="col">Amount Term</th>
                        <th scope="col">Loan Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($da)) : ?>
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger" role="alert"> Data not Found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($da as $dt) : ?>
                        <?php
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
                        ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td class="text-center"><?= $dt['Loan_ID']; ?></td>
                            <td class="text-center"><?= $married; ?></td>
                            <td class="text-center"><?= $dt['Dependents']; ?></td>
                            <td class="text-center"><?= $edu; ?></td>
                            <td class="text-center"><?= $self; ?></td>
                            <td class="text-center"><?= $dt['ApplicantIncome']; ?></td>
                            <td class="text-center"><?= $dt['LoanAmount']; ?></td>
                            <td class="text-center"><?= $dt['Loan_Amount_Term']; ?></td>
                            <td class="text-center"><?= $stat; ?></td>
                            <td>
                                <a href="<?= base_url('data/detailPengajuan/') . $dt['ID']; ?>" class="badge badge-primary" data-toggle="modal" data-target="#Modaldetail<?= $dt['ID']; ?>">
                                    <span><i class="fas fa-fw fa-info"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> <br><br>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<div class="modal fade" id="ModalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Import Data Testing</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Select file Excel for <b>Upload</b> to Data Training</p>
                <div class="form-row">
                    <?= form_open_multipart('data/uploadExcelTesting') ?>
                    <div class="">
                        <input type="file" class="form-control-file" id="importExcel" name="importExcel">
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><span><i class="fa fa-upload"></i></span> Upload</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal Details-->
<?php foreach ($da as $detail) : ?>
    <?php
    if ($detail['Gender'] == '1') {
        $gender = 'Male';
    } elseif ($detail['Gender'] == '0') {
        $gender = 'Female';
    }
    if ($detail['Married'] == '1') {
        $married = 'Yes';
    } elseif ($detail['Married'] == '0') {
        $married = 'No';
    }
    if ($detail['Education'] == '1') {
        $edu = 'Graduate';
    } elseif ($detail['Education'] == '0') {
        $edu = 'Not Graduate';
    }
    if ($detail['Self_Employed'] == '1') {
        $self = 'Yes';
    } elseif ($detail['Self_Employed'] == '0') {
        $self = 'No';
    }
    if ($detail['Loan_Status'] == '1') {
        $stat = 'Y';
    } elseif ($detail['Loan_Status'] == '0') {
        $stat = 'N';
    }
    ?>
    <div class="modal fade bd-example-modal-lg" id="Modaldetail<?= $detail['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Loan ID</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control" disable value="<?= $detail['Loan_ID']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $gender; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Married</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $married; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Dependents</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['Dependents']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Education</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $edu; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Self Employed</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $self; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Applicant Income</label>
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['ApplicantIncome']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Coapplicant Income</label>
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['CoapplicantIncome']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Loan Amount</label>
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['LoanAmount']; ?>">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="inputEmail4">Loan Amount Term</label>
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['Loan_Amount_Term']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-plaintext">Credit History</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['Credit_History']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-plaintext">Property Area</label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $detail['Property_Area']; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-plaintext">Loan Status <small>(aktual)</small></label>
                        <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" value="<?= $stat; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="col-sm-3">Hasil Perhitungan</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Hasil Perhitungan Y</th>
                                        <th scope="col">Hasil Perhitungan N</th>
                                        <th scope="col">Prediksi</th>
                                    </tr>
                                </thead>
                                <?php
                                if ($detail['Prediksi'] == 1) {
                                    $badge = "badge badge-success";
                                    $prediksi = "Diterima";
                                } else {
                                    $badge = "badge badge-danger";
                                    $prediksi = "Ditolak";
                                }
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $detail['hasilY']; ?></td>
                                        <td><?= $detail['hasilN']; ?></td>
                                        <td>
                                            <span class="<?= $badge; ?>"><?= $prediksi; ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>