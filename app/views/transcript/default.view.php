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
    <!-- <div class="col-lg-12 main-chart">
<a class="buttonlink btn btn-theme04 left" href="/schedule/add"><i class="fa fa-plus"></i>Add Schedule</a>
    </div> -->
  </div>
  </section>

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <!-- <th>ID</th>-->
          <th>User ID</th>
          <th>Semester</th>
          <th>Course</th>          
          <th>Grade</th>                              
          <th>Out Of</th>                              
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
            if(!empty($transcript)){
                foreach ($transcript as $t){
                    echo '<tr>
                    <td>'.$t->user_id_fk.'</td>
                    <td>'.$t->semester->season_name .' - '. $t->semester->year.'</td>
                    <td>'.$t->course->course_code.'</td>
                    <td>'.$t->NumericGrade.'</td>
                    <td>'.$t->OutOfGrade.'</td>                    
                    </tr>';
                }
            }
            ?>
        </tr>
        </tbody>
    </table>
  </section>	

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';