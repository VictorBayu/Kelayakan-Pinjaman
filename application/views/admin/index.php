<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card">
        <div class="card-body">
            <h4 class="text-center">Status Yes</h4>
            <div id="chartdiv" class="align-center">
            </div>
        </div>
    </div>
    <div class="card" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="card-body">
            <h4 class="text-center">Status No</h4>
            <div id="chartdiv1" class="align-center">
            </div>
        </div>
    </div>
    <!-- Chart code -->
    <script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_material);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            // Add data
            chart.data = [{
                    "col": "Gender",
                    "male": <?php foreach ($temp['1'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "female": <?php foreach ($temp['2'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                },
                {
                    "col": "Married",
                    "married": <?php foreach ($temp['3'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "single": <?php foreach ($temp['4'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }, {
                    "col": "Dependents",
                    "0": <?php foreach ($temp['5'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "1": <?php foreach ($temp['6'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "2": <?php foreach ($temp['7'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "3+": <?php foreach ($temp['8'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }, {
                    "col": "Education",
                    "graduate": <?php foreach ($temp['9'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "not graduate": <?php foreach ($temp['10'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }, {
                    "col": "Self Employed",
                    "yes": <?php foreach ($temp['11'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "no": <?php foreach ($temp['12'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }, {
                    "col": "Credit History",
                    "have": <?php foreach ($temp['13'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "haven't": <?php foreach ($temp['14'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }, {
                    "col": "Property Area",
                    "rural": <?php foreach ($temp['15'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "urban": <?php foreach ($temp['16'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>,
                    "semiurban": <?php foreach ($temp['17'] as $a) : ?><?= $a['Yes']; ?><?php endforeach; ?>
                }
            ];

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "col";
            categoryAxis.title.text = "Atribut";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 50;
            categoryAxis.renderer.cellStartLocation = 0.1;
            categoryAxis.renderer.cellEndLocation = 0.9;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.title.text = "Total";

            // Create series
            function createSeries(field, name, stacked) {
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = field;
                series.dataFields.categoryX = "col";
                series.name = name;
                series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
                series.stacked = stacked;
                series.columns.template.width = am4core.percent(98);
            }

            createSeries("male", "Male", true);
            createSeries("female", "Female", true);
            createSeries("married", "Married", true);
            createSeries("single", "Single", true);
            createSeries("0", "0", true);
            createSeries("1", "1", true);
            createSeries("2", "2", true);
            createSeries("3+", "3+", true);
            createSeries("graduate", "Graduate", true);
            createSeries("not graduate", "Not Graduate", true);
            createSeries("yes", "Yes", true);
            createSeries("no", "No", true);
            createSeries("have", "Have", true);
            createSeries("haven't", "Haven't", true);
            createSeries("rural", "Rural", true);
            createSeries("urban", "Urban", true);
            createSeries("semiurban", "Semiurban", true);
            // Add legend
            chart.legend = new am4charts.Legend();
            chart.legend.position = "right";
            chart.legend.valign = "middle";
            chart.legend.maxWidth = 300;
            chart.legend.scrollable = true;
        }); // end am4core.ready()
    </script>
    <script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_material);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv1", am4charts.XYChart);

            // Add data
            chart.data = [{
                    "col": "Gender",
                    "male": <?php foreach ($temp['1'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "female": <?php foreach ($temp['2'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                },
                {
                    "col": "Married",
                    "married": <?php foreach ($temp['3'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "single": <?php foreach ($temp['4'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }, {
                    "col": "Dependents",
                    "0": <?php foreach ($temp['5'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "1": <?php foreach ($temp['6'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "2": <?php foreach ($temp['7'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "3+": <?php foreach ($temp['8'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }, {
                    "col": "Education",
                    "graduate": <?php foreach ($temp['9'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "not graduate": <?php foreach ($temp['10'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }, {
                    "col": "Self Employed",
                    "yes": <?php foreach ($temp['11'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "no": <?php foreach ($temp['12'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }, {
                    "col": "Credit History",
                    "have": <?php foreach ($temp['13'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "haven't": <?php foreach ($temp['14'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }, {
                    "col": "Property Area",
                    "rural": <?php foreach ($temp['15'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "urban": <?php foreach ($temp['16'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>,
                    "semiurban": <?php foreach ($temp['17'] as $a) : ?><?= $a['No']; ?><?php endforeach; ?>
                }
            ];

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "col";
            categoryAxis.title.text = "Atribut";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 50;
            categoryAxis.renderer.cellStartLocation = 0.1;
            categoryAxis.renderer.cellEndLocation = 0.9;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.title.text = "Total";

            // Create series
            function createSeries(field, name, stacked) {
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = field;
                series.dataFields.categoryX = "col";
                series.name = name;
                series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
                series.stacked = stacked;
                series.columns.template.width = am4core.percent(98);
            }

            createSeries("male", "Male", true);
            createSeries("female", "Female", true);
            createSeries("married", "Married", true);
            createSeries("single", "Single", true);
            createSeries("0", "0", true);
            createSeries("1", "1", true);
            createSeries("2", "2", true);
            createSeries("3+", "3+", true);
            createSeries("graduate", "Graduate", true);
            createSeries("not graduate", "Not Graduate", true);
            createSeries("yes", "Yes", true);
            createSeries("no", "No", true);
            createSeries("have", "Have", true);
            createSeries("haven't", "Haven't", true);
            createSeries("rural", "Rural", true);
            createSeries("urban", "Urban", true);
            createSeries("semiurban", "Semiurban", true);
            // Add legend
            chart.legend = new am4charts.Legend();
            chart.legend.position = "right";
            chart.legend.valign = "middle";
            chart.legend.maxWidth = 300;
            chart.legend.scrollable = true;
        }); // end am4core.ready()
    </script>

    <script>
        am4core.ready(function() {
            // Themes begin
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            // Themes end

            // create chart
            var chart = am4core.create("chart1div", am4charts.GaugeChart);
            chart.innerRadius = am4core.percent(80);

            /**
             * Normal axis
             */

            var axis = chart.xAxes.push(new am4charts.ValueAxis());
            axis.min = 0;
            axis.max = 100;
            axis.strictMinMax = true;
            axis.renderer.radius = am4core.percent(80);
            axis.renderer.inside = true;
            axis.renderer.line.strokeOpacity = 1;
            axis.renderer.ticks.template.disabled = false
            axis.renderer.ticks.template.strokeOpacity = 1;
            axis.renderer.ticks.template.length = 10;
            axis.renderer.grid.template.disabled = true;
            axis.renderer.labels.template.radius = 40;
            axis.renderer.labels.template.adapter.add("text", function(text) {
                return text + "%";
            })

            /**
             * Axis for ranges
             */

            var colorSet = new am4core.ColorSet();

            var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
            axis2.min = 0;
            axis2.max = 100;
            axis2.strictMinMax = true;
            axis2.renderer.labels.template.disabled = true;
            axis2.renderer.ticks.template.disabled = true;
            axis2.renderer.grid.template.disabled = true;

            var range0 = axis2.axisRanges.create();
            range0.value = 0;
            range0.endValue = 50;
            range0.axisFill.fillOpacity = 1;
            range0.axisFill.fill = colorSet.getIndex(0);

            var range1 = axis2.axisRanges.create();
            range1.value = 50;
            range1.endValue = 100;
            range1.axisFill.fillOpacity = 1;
            range1.axisFill.fill = colorSet.getIndex(2);
            /**
             * Label
             */
            var label = chart.radarContainer.createChild(am4core.Label);
            label.isMeasured = false;
            label.fontSize = 20;
            label.x = am4core.percent(40);
            label.y = am4core.percent(100);
            label.horizontalCenter = "middle";
            label.verticalCenter = "bottom";
            label.text = "30%";
            /**
             * Hand
             */
            var hand = chart.hands.push(new am4charts.ClockHand());
            hand.axis = axis2;
            hand.innerRadius = am4core.percent(20);
            hand.startWidth = 10;
            hand.pin.disabled = true;
            hand.value = 0;

            hand.events.on("propertychanged", function(ev) {
                range0.endValue = ev.target.value;
                range1.value = ev.target.value;
                label.text = axis2.positionToValue(hand.currentPosition).toFixed(2);
                axis2.invalidate();
            });
            setInterval(function() {
                var value = <?= $akurasi; ?>;
                var animation = new am4core.Animation(hand, {
                    property: "value",
                    to: value
                }, 1000, am4core.ease.cubicOut).start();
            }, 2000);
        });
    </script>
    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Accuracy</h4>
                <div id="chart1div" class="align-center">
                </div>
            </div>
        </div>
        <div class="w-100"></div><br />
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Presisi</h4>
                <div id="chart2div" class="align-center">
                </div>
            </div>
        </div>
        <div class="w-100"></div><br />
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Recall</h4>
                <div id="chart3div">
                </div>
            </div>
        </div><br />
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Data Training</h4>
                <div id="chartTraindiv"></div>
            </div>
        </div>
        <div class="w-100"></div><br />
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Data Testing</h4>
                <div id="chartTestdiv"></div>
            </div>
        </div>
    </div><br />
</div>
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_dataviz);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // create chart
        var chart = am4core.create("chart1div", am4charts.GaugeChart);
        chart.innerRadius = am4core.percent(80);

        /**
         * Normal axis
         */

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;
        axis.renderer.radius = am4core.percent(80);
        axis.renderer.inside = true;
        axis.renderer.line.strokeOpacity = 1;
        axis.renderer.ticks.template.disabled = false
        axis.renderer.ticks.template.strokeOpacity = 1;
        axis.renderer.ticks.template.length = 10;
        axis.renderer.grid.template.disabled = true;
        axis.renderer.labels.template.radius = 40;
        axis.renderer.labels.template.adapter.add("text", function(text) {
            return text + "%";
        })

        /**
         * Axis for ranges
         */

        var colorSet = new am4core.ColorSet();

        var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
        axis2.min = 0;
        axis2.max = 100;
        axis2.strictMinMax = true;
        axis2.renderer.labels.template.disabled = true;
        axis2.renderer.ticks.template.disabled = true;
        axis2.renderer.grid.template.disabled = true;

        var range0 = axis2.axisRanges.create();
        range0.value = 0;
        range0.endValue = 50;
        range0.axisFill.fillOpacity = 1;
        range0.axisFill.fill = colorSet.getIndex(0);

        var range1 = axis2.axisRanges.create();
        range1.value = 50;
        range1.endValue = 100;
        range1.axisFill.fillOpacity = 1;
        range1.axisFill.fill = colorSet.getIndex(2);
        /**
         * Label
         */
        var label = chart.radarContainer.createChild(am4core.Label);
        label.isMeasured = false;
        label.fontSize = 20;
        label.x = am4core.percent(40);
        label.y = am4core.percent(100);
        label.horizontalCenter = "middle";
        label.verticalCenter = "bottom";
        label.text = "30%";
        /**
         * Hand
         */
        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.axis = axis2;
        hand.innerRadius = am4core.percent(20);
        hand.startWidth = 10;
        hand.pin.disabled = true;
        hand.value = 0;

        hand.events.on("propertychanged", function(ev) {
            range0.endValue = ev.target.value;
            range1.value = ev.target.value;
            label.text = axis2.positionToValue(hand.currentPosition).toFixed(2);
            axis2.invalidate();
        });
        setInterval(function() {
            var value = <?= $akurasi; ?>;
            var animation = new am4core.Animation(hand, {
                property: "value",
                to: value
            }, 1000, am4core.ease.cubicOut).start();
        }, 2000);
    });
</script>
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // create chart
        var chart = am4core.create("chart2div", am4charts.GaugeChart);
        chart.innerRadius = am4core.percent(80);

        /**
         * Normal axis
         */

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;
        axis.renderer.radius = am4core.percent(80);
        axis.renderer.inside = true;
        axis.renderer.line.strokeOpacity = 1;
        axis.renderer.ticks.template.disabled = false
        axis.renderer.ticks.template.strokeOpacity = 1;
        axis.renderer.ticks.template.length = 10;
        axis.renderer.grid.template.disabled = true;
        axis.renderer.labels.template.radius = 40;
        axis.renderer.labels.template.adapter.add("text", function(text) {
            return text + "%";
        })

        /**
         * Axis for ranges
         */

        var colorSet = new am4core.ColorSet();

        var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
        axis2.min = 0;
        axis2.max = 100;
        axis2.strictMinMax = true;
        axis2.renderer.labels.template.disabled = true;
        axis2.renderer.ticks.template.disabled = true;
        axis2.renderer.grid.template.disabled = true;

        var range0 = axis2.axisRanges.create();
        range0.value = 0;
        range0.endValue = 50;
        range0.axisFill.fillOpacity = 1;
        range0.axisFill.fill = colorSet.getIndex(0);

        var range1 = axis2.axisRanges.create();
        range1.value = 50;
        range1.endValue = 100;
        range1.axisFill.fillOpacity = 1;
        range1.axisFill.fill = colorSet.getIndex(2);
        /**
         * Label
         */
        var label = chart.radarContainer.createChild(am4core.Label);
        label.isMeasured = false;
        label.fontSize = 20;
        label.x = am4core.percent(40);
        label.y = am4core.percent(100);
        label.horizontalCenter = "middle";
        label.verticalCenter = "bottom";
        label.text = "20%";
        /**
         * Hand
         */
        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.axis = axis2;
        hand.innerRadius = am4core.percent(20);
        hand.startWidth = 10;
        hand.pin.disabled = true;
        hand.value = 0;

        hand.events.on("propertychanged", function(ev) {
            range0.endValue = ev.target.value;
            range1.value = ev.target.value;
            label.text = axis2.positionToValue(hand.currentPosition).toFixed(2);
            axis2.invalidate();
        });
        setInterval(function() {
            var value = <?= $presisi; ?>;
            var animation = new am4core.Animation(hand, {
                property: "value",
                to: value
            }, 1000, am4core.ease.cubicOut).start();
        }, 2000);
    });
</script>
<script>
    am4core.ready(function() {
        // Themes begin
        am4core.useTheme(am4themes_material);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // create chart
        var chart = am4core.create("chart3div", am4charts.GaugeChart);
        chart.innerRadius = am4core.percent(80);

        /**
         * Normal axis
         */

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;
        axis.renderer.radius = am4core.percent(80);
        axis.renderer.inside = true;
        axis.renderer.line.strokeOpacity = 1;
        axis.renderer.ticks.template.disabled = false
        axis.renderer.ticks.template.strokeOpacity = 1;
        axis.renderer.ticks.template.length = 10;
        axis.renderer.grid.template.disabled = true;
        axis.renderer.labels.template.radius = 40;
        axis.renderer.labels.template.adapter.add("text", function(text) {
            return text + "%";
        })

        /**
         * Axis for ranges
         */

        var colorSet = new am4core.ColorSet();

        var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
        axis2.min = 0;
        axis2.max = 100;
        axis2.strictMinMax = true;
        axis2.renderer.labels.template.disabled = true;
        axis2.renderer.ticks.template.disabled = true;
        axis2.renderer.grid.template.disabled = true;

        var range0 = axis2.axisRanges.create();
        range0.value = 0;
        range0.endValue = 50;
        range0.axisFill.fillOpacity = 1;
        range0.axisFill.fill = colorSet.getIndex(0);

        var range1 = axis2.axisRanges.create();
        range1.value = 50;
        range1.endValue = 100;
        range1.axisFill.fillOpacity = 1;
        range1.axisFill.fill = colorSet.getIndex(2);
        /**
         * Label
         */
        var label = chart.radarContainer.createChild(am4core.Label);
        label.isMeasured = false;
        label.fontSize = 20;
        label.x = am4core.percent(40);
        label.y = am4core.percent(100);
        label.horizontalCenter = "middle";
        label.verticalCenter = "bottom";
        label.text = "20%";
        /**
         * Hand
         */
        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.axis = axis2;
        hand.innerRadius = am4core.percent(20);
        hand.startWidth = 10;
        hand.pin.disabled = true;
        hand.value = 0;

        hand.events.on("propertychanged", function(ev) {
            range0.endValue = ev.target.value;
            range1.value = ev.target.value;
            label.text = axis2.positionToValue(hand.currentPosition).toFixed(2);
            axis2.invalidate();
        });
        setInterval(function() {
            var value = <?= $recall; ?>;
            var animation = new am4core.Animation(hand, {
                property: "value",
                to: value
            }, 1000, am4core.ease.cubicOut).start();
        }, 2000);
    });
</script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_dataviz);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartTraindiv", am4charts.PieChart);

        // Add data
        chart.data = [{
            "Status": "Yes",
            "total": <?= $y; ?>
        }, {
            "Status": "No",
            "total": <?= $n; ?>
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "total";
        pieSeries.dataFields.category = "Status";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;

        var rgm = new am4core.RadialGradientModifier();
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";

    }); // end am4core.ready()
</script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_spiritedaway);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartTestdiv", am4charts.PieChart);

        // Add data
        chart.data = [{
            "Status": "Yes",
            "total": <?= $y; ?>
        }, {
            "Status": "No",
            "total": <?= $n; ?>
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "total";
        pieSeries.dataFields.category = "Status";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;

        var rgm = new am4core.RadialGradientModifier();
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";

    }); // end am4core.ready()
</script> -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->