<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= 'Hasil ' . $title; ?></h1>
    <div class="row">
        <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-sm table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Iterasi</th>
                                    <th class="text-center" scope="col">No Pengajuan</th>
                                    <th class="text-center col-10" scope="col">Probabilitas Yes</th>
                                    <th class="text-center col-8" scope="col">Probabilitas No</th>
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
                                <?php foreach ($dm as $hasil) : ?>
                                    <tr>
                                        <th class="text-center" scope="row"><?= ++$start; ?></th>
                                        <td><?= $hasil['No']; ?></td>
                                        <td><?= $hasil['hasilY']; ?></td>
                                        <td><?= $hasil['hasilN']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center"><b>Performance Vector</b></h4>
                    <?php
                    //$getDataUji = $this->db->query();
                    $TP = $FP = $TN = $FN = 0;
                    $null = 0;

                    foreach ($dk as $conf) {
                        $status = $conf['Loan_Status'];
                        $prediksi = $conf['Prediksi'];
                        if ($status == '1' & $prediksi == '1') {
                            $TP++;
                        } elseif ($status == '1' && $prediksi == '0') {
                            $FP++;
                        } elseif ($status == '0' && $prediksi == '1') {
                            $FN++;
                        } elseif ($status == '0' && $prediksi == '0') {
                            $TN;
                        } else {
                            $null++;
                        }
                    }
                    $tepat = ($TP + $TN);
                    $salah = ($FP + $FN + $null);

                    $akurasi = round((($tepat / ($TP + $TN + $FP + $FN)) * 100), 2);
                    $presisi = round((($TP / ($TP + $FP)) * 100), 2);
                    $recall = round((($TP / ($TP + $FN)) * 100), 2);
                    ?>
                    <table class="table table-borderless table-hover">
                        <tbody>
                            <tr>
                                <th>Accuracy</th>
                                <td>=</td>
                                <td><?= $akurasi . '%'; ?></td>
                            </tr>
                            <tr>
                                <th>Recall</th>
                                <td>=</td>
                                <td><?= $recall . '%'; ?></td>
                            </tr>
                            <tr>
                                <th>Presisi</th>
                                <td>=</td>
                                <td><?= $presisi . '%'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-100"></div><br />
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center"><b>Counfusion Matrix</b></h4>
                    <table class="table table-sm">
                        <caption><small><?= "Jumlah = " . $count; ?></small></caption>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Yes</td>
                                <td>No</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Yes</td>
                                <td><?= $TP; ?></td>
                                <td><?= $FP; ?></td>
                            </tr>
                            <tr>
                                <td>No</td>
                                <td><?= $FN; ?></td>
                                <td><?= $TN; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> -->

    </div><br />

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->