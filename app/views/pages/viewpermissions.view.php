<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Page Access</h1>
            <hr>
		</div>
    </div>
    
    
  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>User Type</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
                foreach ($permissions as $ut){
                    echo '<tr>
                    <td>'.$ut->id.'</td>
                    <td>'.$ut->title.'</td>
                    <td>'.$ut->status.'</td>
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