<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1 id="listh1">Students Applied</h1>
		</div>
	</div>

        <div class="row mt info">
              <div class="col-lg-12">
                  <form class="form-horizontal style-form" method="post">
                            <table id="listtable">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($students)){
                                        foreach ($students as $student){
                                            echo '<tr>
                                            <td>'.$student->fname.' '.$student->lname.'</td>
                                            <td>'.$student->phone.'</td>
                                            <td>'.$student->email.'</td>
                                            </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                      <a href="/exam/default" id="cancel">Back</a>
                  </form>
              </div>      
            </div>

<script>
</script>
<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';