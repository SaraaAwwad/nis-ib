<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Pages</h1>
		</div>
	</div>		

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Friendly Name</th>
          <th>Physical Name</th>
          <th>Parent Page</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                foreach ($pages as $pt){
                    echo '<tr>
                    <td>'.$pt->id.'</td>
                    <td>'.$pt->friendlyname.'</td>                    
                    <td>'.$pt->physicalname.'</td>                    
                    <td>'.$pt->pageid.'</td>                    
                    <td>'.$pt->status.'</td>    
                    <td>
                    <a href="\pages\viewpermissions\\'.$pt->id.'"</a>View Permissions </td>
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