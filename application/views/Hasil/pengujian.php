<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?php if (empty($dm)) : ?>
        <tr>
            <td colspan="10">
                <div class="alert alert-danger" role="alert"> Data not Found!
                </div>
            </td>
        </tr>
    <?php else : ?>
        <?php
        $jumlah_uji = $co;
        $TP = $FP = $TN = $FN = 0;
        $kosong = 0;
        foreach ($dm as $df) {
            $asli = $df['Loan_Status'];
            $prediksi = $df['Prediksi'];
            if ($asli == 1 && $prediksi == 1) {
                $TP++;
            } elseif ($asli == 1 && $prediksi == 0) {
                $FN++;
            } elseif ($asli == 0 && $prediksi == 0) {
                $TN++;
            } elseif ($asli == 0 && $prediksi == 1) {
                $FP++;
            }
        }
        ?>
        <?php
        $n = round($TP + $TN + $FP + $FN, 2);
        $akurasi = round(($TP + $TN) / $n, 2);
        $PPV = round($TP / ($TP + $FP), 2);
        $NPV = round($TN / ($FN + $TN), 2);
        $sensitiv = round($TP / ($TP + $FN), 2);
        $specifi = round($TN / ($TN + $FP), 2);
        $error_rate = round(($FP + $FN) / $n, 2);
        ?>
        <div class="row">
            <div class="col-lg-8 col-lg-8 col-lg-8 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Grafik</h4>
                        <div id="grafik" class="align-center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <div class="card mt-b-10">
                    <div class="card-body">
                        <h4 class="card-title text-center">Tabel Confussion Matrix</h4>
                        <table class="table table-hover table-md table-responsive" style="margin-left: 30px;">
                            <caption>Total data testing : <?= $jumlah_uji . ' baris data'; ?></caption>
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" colspan="2" class="text-center">Hasil Prediksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Hasil Aktual</th>
                                    <td class="text-center">Y</td>
                                    <td class="text-center">N</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Y</td>
                                    <td><?= $TP; ?></td>
                                    <td><?= $FN; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">N</td>
                                    <td><?= $FP; ?></td>
                                    <td><?= $TN; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                <div class="card mt-b-30">
                    <div class="card-body">
                        <table class="table table-sm table-responsive table-borderless justify-content-center">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="3">
                                        <h5>Parameter Pengujian</h5>
                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Accuracy</td>
                                    <td>=</td>
                                    <td><?= $akurasi; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">PPV</td>
                                    <td>=</td>
                                    <td><?= $PPV; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">NPV</td>
                                    <td>=</td>
                                    <td><?= $NPV; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Sensitivity</td>
                                    <td>=</td>
                                    <td><?= $sensitiv; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Specificity</td>
                                    <td>=</td>
                                    <td><?= $specifi; ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Error Rate</td>
                                    <td>=</td>
                                    <td><?= $error_rate; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        </div><br />
    <?php endif; ?>
    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_material);
            // Themes end

            // Create chart instance
            var chart = am4core.create("grafik", am4charts.XYChart3D);

            // Add data
            chart.data = [{
                "parameter": "Accuracy",
                "total": <?= $akurasi; ?>,
                "color": chart.colors.next()
            }, {
                "parameter": "PPV",
                "total": <?= $PPV; ?>,
                "color": chart.colors.next()
            }, {
                "parameter": "NPV",
                "total": <?= $NPV; ?>,
                "color": chart.colors.next()
            }, {
                "parameter": "Sensitivity",
                "total": <?= $sensitiv; ?>,
                "color": chart.colors.next()
            }, {
                "parameter": "Specificity",
                "total": <?= $specifi; ?>,
                "color": chart.colors.next()
            }, {
                "parameter": "Error Rate",
                "total": <?= $error_rate; ?>,
                "color": chart.colors.next()
            }];

            // Create axes
            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "parameter";
            categoryAxis.numberFormatter.numberFormat = "#";
            categoryAxis.renderer.inversed = true;

            var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries3D());
            series.dataFields.valueX = "total";
            series.dataFields.categoryY = "parameter";
            series.name = "Total";
            series.columns.template.propertyFields.fill = "color";
            series.columns.template.tooltipText = "{valueX}";
            series.columns.template.column3D.stroke = am4core.color("#fff");
            series.columns.template.column3D.strokeOpacity = 0.2;

        }); // end am4core.ready()
    </script>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->