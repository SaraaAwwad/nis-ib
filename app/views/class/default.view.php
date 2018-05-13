<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Classes</h1>
		</div>
	</div>		

  <section class="tabcontent">    
    <div class="row">
    <div class="col-lg-12 main-chart">
    <a class="buttonlink btn btn-theme04 left" href="/class/add"><i class="fa fa-plus"></i>Add Class</a>
    </div>
  </div>
  </section>

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Grade</th>
          <th>Status</th>
          <th>Actions</th>                              
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
            if(!empty($class)){

                foreach ($class as $ut){
                    echo '<tr>
                    <td>'.$ut->id.'</td>
                    <td>'.$ut->name.'</td>
                    <td>'.$ut->grade_name.'</td>
                    <td>'.$ut->code.'</td>
                    <td> <a href="\class\edit\\'.$ut->id.'">Edit </a></td>
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