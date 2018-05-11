<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';

?>

    <section id="container" >
        <section id="main-content">
            <section class="wrapper">

                <hr hidden="true">
                <label class="col-sm-2 col-sm-2 control-label margin-top-sm">Statistics</label>
                <div class="col-sm-4">
                    <select name="statistics" id="statistics" class="form-control class margin-top" required>
                        <option value="" selected="selected" disabled="disabled">Choose</option>
                        <option value="Staff">Staff</option>
                        <option value="Students">Students</option>
                        <option value="Profit">Profit</option>
                    </select>
                </div>

                <div class="statistics-panel">
                        <div id="piechart"></div>
                        <div id="studentspiechart"></div>
                        <div id="barchart_material" style="width: 900px; height: 500px;"></div>
                </div>
            </section>
        </section>
    </section>
<script type="text/javascript">



    $(document).ready(function() {

        $(".statistics-panel").hide();
        $("#piechart").hide();
        $("#studentspiechart").hide();
        $("#barchart_material").hide();
    });


    $(document).on("change","#statistics",function(){
        var conceptName = $('#statistics').find(":selected").text();
        if(conceptName == "Staff")
        {
          $(".statistics-panel").show();
          $("#piechart").show();
          $("#studentspiechart").hide();
          $("#barchart_material").hide();

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Position');
                data.addColumn('number', 'Balance');

                data.addRows([
                    <?php
                    for($i=0;$i<$count;$i++){
                        echo "['" . $teachers[$i]['position'] . "'," . $teachers[$i]['newbalance'] . "],";
                    }
                    ?>
                ]);
                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Staff', 'width':1000, 'height':500};
                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        }else if(conceptName == "Students") {

            $(".statistics-panel").show();
            $("#piechart").hide();
            $("#barchart_material").hide();
            $("#studentspiechart").show();

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Students');

                data.addRows([
                    <?php
                    for($i=0;$i<$number;$i++){
                        echo "['" . $students[$i]['year'] . "'," . $students[$i]['students'] . "],";
                    }
                    ?>
                ]);
                // Optional; add a title and set the width and height of the chart
                var options = {'title':'Students Registered in Semester', 'width':1000, 'height':500};
                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('studentspiechart'));
                chart.draw(data, options);
            }
        }else if(conceptName == "Profit"){

            $(".statistics-panel").show();
            $("#piechart").hide();
            $("#studentspiechart").hide();
            $("#barchart_material").show();

            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                   ['Decorators', 'Profit'],
                <?php
                for($i=0;$i<$profitnum;$i++){
                    echo "['" . $profit[$i]['decorator'] . "'," . $profit[$i]['amount'] . "],";
                }
                ?>
                 ]);

                var options = {
                    chart: {
                        title: 'School Performance',
                        subtitle: 'Decorators Profit',
                    },
                    bars: 'horizontal' // Required for Material Bar Charts.
                };
                var chart = new google.charts.Bar(document.getElementById('barchart_material'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
            } }
        });



</script>
<?php
require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>
