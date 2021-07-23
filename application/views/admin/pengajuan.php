<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title . ' Pinjaman'; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('admin/pengajuan/'); ?>" method="POST">
                <div class="row">
                    <div class="col">
                        <label for="inputEmail4">No</label>
                        <input type="number" class="form-control" id="no" name="no" aria-describedby="emailHelp" readonly value="<?= rand(1000, 5000); ?>">
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option selected disabled>Choose one</option>
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                        </select>
                    </div>
                </div><br />
                <div class="form-row">
                    <div class="col">
                        <label for="inputEmail4">Married</label>
                        <select class="form-control" id="marital" name="marital" required>
                            <option selected disabled>Choose one</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Dependent</label>
                        <select class="form-control" id="dependent" name="dependent" required>
                            <option selected disabled>Choose one</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3+">3+</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Education</label>
                        <select class="form-control" id="edu" name="edu" required>
                            <option selected disabled>Choose one</option>
                            <option value="1">Graduate</option>
                            <option value="0">Not Graduate</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Self Employed</label>
                        <select class="form-control" id="self" name="self" required>
                            <option selected disabled>Choose one</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div><br />
                <div class="form-row">
                    <div class="form-group col-lg-4">
                        <label for="inputEmail4">Applicant Income</label>
                        <input type="text" class="form-control" id="gaji1" name="gaji1" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="inputEmail4">Coapplicant Income</label>
                        <input type="text" class="form-control" id="gaji2" name="gaji2" required>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="inputEmail4">Loan Amount <small>(in thousands)</small></label>
                        <input type="text" class="form-control" id="pinjaman" name="pinjaman" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputEmail4">Loan Amount Term <small>(in month)</small></label>
                        <input type="text" class="form-control" id="tenor" name="tenor" required>
                    </div>
                    <div class="form-group col">
                        <label for="inputEmail4">Credit History</label>
                        <select class="form-control" id="history" name="history" required>
                            <option selected disabled>Choose one</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="inputEmail4">Property Area</label>
                        <select class="form-control" id="property" name="property" required>
                            <option selected disabled>Choose one</option>
                            <option value="Urban">Urban</option>
                            <option value="Semiurban">Semiurban</option>
                            <option value="Rural">Rural</option>
                        </select>
                    </div>
                </div>
                <button type="submit" id="ajukan" name="ajukan" class="btn btn-primary">Pengajuan</button>\
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->