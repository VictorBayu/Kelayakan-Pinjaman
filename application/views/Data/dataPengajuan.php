<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
    <p>Kumpulan data hasil pengajuan manual</p>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="toolbar">
                <div class="login-social-inner">
                    <a class="btn btn-warning" href="<?= base_url('Data/exportPengajuan'); ?>"> <span><i class="fa fa-download"></i></span> Export to Excel</a>
                    <a class="btn btn-danger" href="<?= base_url('Data/deletePengajuan'); ?>" data-toggle="modal" data-target="#ModalDelete"> <span><i class="fa fa-trash"></i></span> Delete All</a>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="">
            <table class="table table-sm table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Married</th>
                        <th scope="col">Dependent</th>
                        <th scope="col">Self Employed</th>
                        <th scope="col">Applicant Income</th>
                        <th scope="col">Coapplicant Income</th>
                        <th scope="col">Loan Amount</th>
                        <th scope="col">Amount Term</th>
                        <th scope="col">Hasil Prediksi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($du)) : ?>
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger" role="alert"> Data not Found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($du as $dt) : ?>
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
                        if ($dt['Prediksi'] == '1') {
                            $pre = 'Y';
                        } elseif ($dt['Prediksi'] != '1') {
                            $pre = 'N';
                        }
                        ?>
                        <tr>
                            <th scope="row"><?php echo ++$start; ?></th>
                            <td class="text-center"><?php echo $gender; ?></td>
                            <td class="text-center"><?php echo $married; ?></td>
                            <td class="text-center"><?php echo $dt['Dependents']; ?></td>
                            <td class="text-center"><?php echo $self; ?></td>
                            <td class="text-center"><?php echo $dt['ApplicantIncome']; ?></td>
                            <td class="text-center"><?php echo $dt['CoapplicantIncome']; ?></td>
                            <td class="text-center"><?php echo $dt['LoanAmount']; ?></td>
                            <td class="text-center"><?php echo $dt['Loan_Amount_Term']; ?></td>
                            <td class="text-center"><?php echo $pre; ?></td>
                            <td>
                                <a href="<?= base_url('data/detailPengajuan/') . $dt['ID']; ?>" class="badge badge-primary" data-toggle="modal" data-target="#Modaldetail<?= $dt['ID']; ?>">
                                    <span><i class="fas fa-fw fa-info"></i></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <?php echo $this->pagination->create_links(); ?> -->
        </div>
    </div>
    <!-- Modal Details-->
    <?php foreach ($du as $detail) : ?>
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
                            <label class="col-sm-3 col-form-label">No pengajuan</label>
                            <div class="col-sm-5">
                                <input type="text" readonly class="form-control" disable value="<?= $detail['No']; ?>">
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
    <!-- Modal Delete -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete Data Pengajuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select <b>Delete</b> if you ready to delete all Data Pengajuan</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('Data/deletePengajuan'); ?>"><span><i class="fa fa-trash"></i></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Import -->
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
                    <p>Select file Excel for <b>Upload</b> to Data Pengajuan</p>
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->