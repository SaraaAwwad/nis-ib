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
                <h2>Statistics</h2>

                <div class="form-panel">
                        <div id="piechart"></div>
                </div>
            </section>
        </section>
    </section>
<script type="text/javascript">

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


</script>
<?php
require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>
