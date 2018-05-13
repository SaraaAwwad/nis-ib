<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Courses</h1>
		</div>
	</div>		

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Code</th>
          <th>Description</th>
          <th>Grade</th>
          <th>Status</th>
          <th>Actions</th>

        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                foreach ($course as $cs){
                    echo '<tr>
                    <td>'.$cs->id.'</td>
                    <td>'.$cs->name.'</td>
                    <td>'.$cs->course_code.'</td>
                    <td>'.$cs->descr.'</td>
                    <td>'.$cs->grade_id_fk.'</td>
                    <td>'.$cs->status.'</td>
                    <td> <a href="\coursework\addcw\\'.$cs->id.'">Add CourseWork </a></td>
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