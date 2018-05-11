<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>

    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Transcript:  
               <?php if(!empty($trans)){
                  echo $trans[0]->course->course_code; ?></h1>
                  <h2><?php echo $trans[0]->semester->season_name .'-'. $trans[0]->semester->year; }?></h2>
		</div>
	</div>		

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

  <section class="tabcontent">    
    <div class="row">
  </div>
  </section>

 <div id="sched">
    <table id="tab_sched" class="table table-striped text-center">
        <colgroup>
            <col width="50%">
                <col width="50%">
        </colgroup>
        <thead>
                <tr class='warning'>
                <th>Student</th>                           
                <th>Grade</th> 
            </tr>
        </thead>
        <tbody>
        <?php
                if(!empty($trans)){
                    foreach($trans as $t){
                        echo '<tr>';
                        echo '<td>'.$t->student->fname .' '. $t->student->lname .'</td>';
                        echo '<td align="center"> <input type="number" value="'.$t->NumericGrade.'" min="0" max="'.$maxgrade.'" name="grades[]" class="form-control" placeholder="Enter Grade" required /></td>';
                        echo '</tr>';
                    }
                }
            ?>
        </tbody>
        </table>
    </div>

            </fieldset>
                    <input type="submit" name="editTranscript" id="main">
                </form>
            </div>
        </div>
    </div>



<?php
    require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php';