<?php
//use \PHPMVC\Views\transcriptView;
//$tview = new transcriptView();
//$tview->pdf();

require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Transcript</h1>
		</div>
	</div>		

  
  <section class="tabcontent">    
    <div class="row">
    <div class="col-lg-12 main-chart">
    <a class="btn btn-primary btn-lg left" target="_blank" href="/transcript/pdf"><i class="fa fa-download"></i> Generate Report</a>
    </div>
  </div>
  </section>

<?php
if(!empty($transcript)){
    foreach($transcript as $transSem){?>
    <h3> <?= $transSem[0]->semester->season_name .' - '. $transSem[0]->semester->year ?></h3>
    <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>Course</th>          
          <th>Grade</th>                              
          <th>Out Of</th>                              
        </tr>
      </thead>
      <tbody>
        <tr>

<?php
           
           foreach($transSem as $t){
               echo '<tr>
               <td>'.$t->course->course_code.'</td>
               <td id="grade" >'.$t->NumericGrade.'</td>
               <td id="total" >'.$t->OutOfGrade.'</td>                    
               </tr>';
           }
       ?>
   </tr>
   </tbody>
</table>
</section>	
<hr>
    <?php
    }
}          
?>

<script>
$(document).ready(function(data){
    $(".order-table").each(function(){

        var grades = "";
        $(this).find("td[id^='grade']").each(function () {
            grades += $(this).text();
        });

        var total = "";
        $(this).find("td[id^='total']").each(function () {
            total += $(this).text();
        });

        var percentage = (grades/total) * 100;

        $(this).append("<tr>"+"<td id='percentage' colspan='3'> Percentage: " +percentage+"%</td>"
            +"</tr>");        
    });
});

</script>            

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';