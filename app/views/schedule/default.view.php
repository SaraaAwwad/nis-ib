<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Schedules</h1>
		</div>
	</div>		

  <section class="tabcontent">    
    <div class="row">
    <div class="col-lg-12 main-chart">
    <a class="buttonlink btn btn-theme04 left" href="/schedule/add"><i class="fa fa-plus"></i>Add Schedule</a>
    </div>
  </div>
  </section>

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Class</th>
          <th>Semester</th>
          <th>Actions</th>                              
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                foreach ($schedule as $s){
                    echo '<tr>
                    <td>'.$s->id.'</td>
                    <td>'.$s->name.'</td>
                    <td>'.$s->season_name .' - '. $s->year.'</td>
                    <td> <a href="\class\edit\\'.$s->id.'">Edit </a></td>
                    </tr>';
                }
            ?>
        </tr>
        </tbody>
    </table>
  </section>	

<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';