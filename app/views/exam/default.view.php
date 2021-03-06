<?php
    use PHPMVC\Views\ScheduleView;
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <script src="../../../public/assets/js/staff.js"></script>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Exams</h1>
		</div>
	</div>

  <section class="tabcontent">
      <input type="search" class="searchtab light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
      <div class="row">
    <div class="col-lg-12 main-chart">
    <a class="buttonlink btn btn-theme04 left" href="/exam/add"><i class="fa fa-plus"></i>Add Exam</a>
    </div>
  </div>
  </section>

  <section class="tabcontent">
    <table class="order-table">
      <thead>
        <tr>
            <th>ID</th>
            <th>Grade</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Day</th>
            <th>Date</th>
            <th>Slot</th>
            <th>Room</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <?php
            if(!empty($exams)){
                foreach ($exams as $exam){
                    echo '<tr>
                    <td>'.$exam->id.'</td>
                    <td>'.$exam->grade_name.' Grade</td>
                    <td>'.$exam->name.'</td>
                    <td>'.$exam->season_name .' - '. $exam->year.'</td>
                    <td>'.$exam->day.'</td>
                    <td>'.$exam->date.'</td>
                    <td>'.$exam->slot_name.' Slot</td>
                    <td>'.$exam->room_name.'</td>
                    <td><span class="label label-info label-mini">'.$exam->code.'</span></td>
                    <td> <!--<a href="\exam\edit\\'.$exam->id.'">Edit ,  </a> -->
                     <a href="\exam\details\\'.$exam->id.'">Students Applied </a><br>';
                     if($exam->code == "active")
                     {echo '<a href="\exam\activation\\'.$exam->id.'">Deactivate</a><br>';}
                     else{
                         echo '<a href="\exam\activation\\'.$exam->id.'">Activate</a><br>';
                     }

                     echo '
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