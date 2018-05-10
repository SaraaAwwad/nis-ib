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

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>Course</th>   
          <th>Semester</th>       
          <th>action</th>                              
        </tr>
      </thead>
      <tbody>
            <?php
                if(!empty($trans)){
                    foreach($trans as $t){
                        echo '<tr>';
                        echo '<td>'.$t->course->course_code.'</td>';
                        echo '<td>'.$t->semester->year .' - '. $t->semester->season_name .'</td>';
                        echo '<td> <a href="/transcript/edit/'.$t->course_id_fk.'/'.$t->semester_id_fk.'">View Grades</a></td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
    </table>
  </section>	

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';