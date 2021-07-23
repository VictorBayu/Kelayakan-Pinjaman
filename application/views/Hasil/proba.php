<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Data Numerik</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Atribut</th>
                                    <th scope="col">Mean Y</th>
                                    <th scope="col">Mean N</th>
                                    <th scope="col">StDev Y</th>
                                    <th scope="col">StDev N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($num as $nu) : ?>
                                    <tr>
                                        <td><?= $nu['atribut']; ?></td>
                                        <td><small><?= $nu['mean_y']; ?></small></td>
                                        <td><small><?= $nu['mean_n']; ?></small></td>
                                        <td><small><?= $nu['stdev_y']; ?></small></td>
                                        <td><small><?= $nu['stdev_n']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Gender</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Gender</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['2'] as $p) : ?>
                                    <tr>
                                        <td>Gender</td>
                                        <td class="text-center"><small><?= $p['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $p['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $p['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Married</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Married</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['3'] as $u) : ?>
                                    <tr>
                                        <td>Married</td>
                                        <td class="text-center"><small><?= $u['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $u['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $u['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Self Employee</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Employee</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['6'] as $de) : ?>
                                    <tr>
                                        <td class="text-center">Self Employee</td>
                                        <td class="text-center"><small><?= $de['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Credit History</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Credit</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['7'] as $de) : ?>
                                    <tr>
                                        <td class="text-center">Credit History</td>
                                        <td class="text-center"><small><?= $de['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Dependents</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Dependents</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['4'] as $de) : ?>
                                    <tr>
                                        <td class="text-center">Dependent</td>
                                        <td class="text-center"><small><?= $de['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Property Area</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Area</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['8'] as $de) : ?>
                                    <tr>
                                        <td class="text-center">Property Area</td>
                                        <td class="text-center"><small><?= $de['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><br />
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <h3 class="card-title text-center">Loan Status</h3>
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Atribut</th>
                                    <th class="text-center" scope="col">Loan</th>
                                    <th class="text-center" scope="col">Loan Status Yes</th>
                                    <th class="text-center" scope="col">Loan Status No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($temp['1'] as $de) : ?>
                                    <tr>
                                        <td class="text-center">Loan Status</td>
                                        <td class="text-center"><small><?= $de['atribut']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_Y']; ?></small></td>
                                        <td class="text-center"><small><?= $de['prob_N']; ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->