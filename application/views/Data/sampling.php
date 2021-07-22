<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="">
        <p>Hasil setelah dilakukan <i>Random Sampling</i> sebanyak <b><?php echo $data_model->num_rows(); ?></b> Total data.</p>
    </div>
    <div class="card col-lg-12">
        <div class="card-body">
            <table id="example" class="table table-sm table-hover table-responsive">
                <thead>
                    <tr>
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
                    <?php if (empty($data_model)) : ?>
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger" role="alert"> Data not Found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($data_model->result_array() as $dt) : ?>
                        <tr>
                            <td><?php echo $dt['Loan_ID']; ?></td>
                            <td><?php echo $dt['Gender']; ?></td>
                            <td><?php echo $dt['Married']; ?></td>
                            <td><?php echo $dt['Dependents']; ?></td>
                            <td><?php echo $dt['Education']; ?></td>
                            <td><?php echo $dt['Self_Employed']; ?></td>
                            <td><?php echo $dt['ApplicantIncome']; ?></td>
                            <td><?php echo $dt['CoapplicantIncome']; ?></td>
                            <td><?php echo $dt['LoanAmount']; ?></td>
                            <td><?php echo $dt['Loan_Amount_Term']; ?></td>
                            <td><?php echo $dt['Credit_History']; ?></td>
                            <td><?php echo $dt['Property_Area']; ?></td>
                            <td><?php echo $dt['Loan_Status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->