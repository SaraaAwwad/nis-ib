<?php
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
  </div>
  </section>

<?php
if(!empty($transcript)){
    foreach($transcript as $transSem){?>
    <h1> <?= $transSem[0]->semester->season_name .' - '. $transSem[0]->semester->year ?></h1>
      <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>User ID</th>
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
               <td>'.$t->user_id_fk.'</td>
               <td>'.$t->course->course_code.'</td>
               <td>'.$t->NumericGrade.'</td>
               <td>'.$t->OutOfGrade.'</td>                    
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

            

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';