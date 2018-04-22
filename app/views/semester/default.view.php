<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Semesters</h1>
		</div>
	</div>		

  <section class="tabcontent">    
    <div class="row">
    <div class="col-lg-12 main-chart">
    <a class="buttonlink btn btn-theme04 left" href="/semester/add"><i class="fa fa-plus"></i>Add Semester</a>
    </div>
  </div>
  </section>

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Season</th>
          <th>Year</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                foreach ($semester as $s){
                    echo '<tr>
                    <td>'.$s->id.'</td>
                    <td>'.$s->season_name.'</td>
                    <td>'.$s->year.'</td>
                    <td>'.$s->start_date.'</td>
                    <td>'.$s->end_date.'</td>
                    <td> <a href="\semester\edit\\'.$s->id.'">Edit </a></td>
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