<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-1000"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="toolbar">
                <div class="login-social-inner">
                    <a class="btn btn-primary" href="<?= base_url('Data/naivebayes'); ?>" role="button"> <span><i class="fa fa-code"></i></span> Naive Bayes</a>
                    <!-- <a class="btn btn-info" href="" data-toggle="modal" data-target="#ModalRandom"> <span><i class="fa fa-cogs"></i></span> Random Sampling</a> -->
                    <a class="btn btn-danger" href="<?= base_url('Data/delete'); ?>" data-toggle="modal" data-target="#ModalDelete"> <span><i class="fa fa-trash"></i></span> Delete</a>
                    <a class="btn btn-warning" href="<?= base_url('Data/excel'); ?>"> <span><i class="fa fa-download"></i></span> Export</a>
                    <a class="btn btn-warning" href="<?= base_url('Data/uploadExcel'); ?>" data-toggle="modal" data-target="#ModalImportExcel"><span><i class="fa fa-upload"></i></span> Import File Excel</a>

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
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dm)) : ?>
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger" role="alert"> Data not Found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($dm as $dt) : ?>
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
                        ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $dt['Loan_ID']; ?></td>
                            <td><?= $gender; ?></td>
                            <td><?= $married; ?></td>
                            <td><?= $dt['Dependents']; ?></td>
                            <td><?= $edu; ?></td>
                            <td><?= $self; ?></td>
                            <td><?= $dt['ApplicantIncome']; ?></td>
                            <td><?= $dt['CoapplicantIncome']; ?></td>
                            <td><?= $dt['LoanAmount']; ?></td>
                            <td><?= $dt['Loan_Amount_Term']; ?></td>
                            <td><?= $dt['Credit_History']; ?></td>
                            <td><?= $dt['Property_Area']; ?></td>
                            <td><?= $stat; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table> <br><br>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
    <!-- Modal Random -->
    <div class="modal fade" id="ModalRandom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Random Sampling</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Silahkan</b> tentukan jumlah presentase data yang akan dilakukan <i>Random Sampling</i> </p><br>
                    <form action="<?= base_url('Data/sampling/'); ?>" method="POST">
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label class="login2 pull-right pull-right-pro">Jumlah (*) </label>
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="jumlah" id="jumlah" required="" placeholder="Input angka" />
                                </div>
                            </div><br>
                        </div>
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-9">
                                    <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit" value="submit">Sampling</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Delete -->
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete Data Training</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select <b>Delete</b> if you ready to delete all Data Training</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('Data/delete'); ?>"><span><i class="fa fa-trash"></i></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Export -->
    <div class="modal fade" id="ModalExport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Delete Data Training</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select <b>Delete</b> if you ready to delete all Data Training</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('Data/delete'); ?>"><span><i class="fa fa-trash"></i></span> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Import -->
    <div class="modal fade" id="ModalImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Import Data Training</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Select file Excel for <b>Upload</b> to Data Training</p>
                    <div class="form-row">
                        <?= form_open_multipart('data/uploadExcelTraining') ?>
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
    <div class="modal fade" id="ModalImportSampling" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Import Data Sampling</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>Select file Excel for <b>Upload</b> to Data Training</p>
                    <div class="form-row">
                        <?= form_open_multipart('data/uploadSampling') ?>
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