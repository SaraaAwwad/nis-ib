<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';

?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="../../../public/assets/js/validation.js"></script>

<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Add Exam Details</h1>
            <hr>
        </div>
    </div>

    <div class="row mt info">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post">

                    <legend>Exam Info</legend>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-4">
                            <select name="grade" id="grade" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                <?php
                                foreach($grades as $grade){
                                    echo '<option value='.$grade->id.'>'.$grade->grade_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Course</label>
                        <div class="col-sm-4">
                            <select name="course" id="course" class="form-control class" required>
                                <option value="" selected="selected" disabled="disabled">Select Course</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Students</label>
                        <div class="col-sm-4">
                            <select multiple = "multiple" name="students[]" id="students" class="form-control semester" required>
                                <option value="" disabled>Select Students</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Day</label>
                        <div class="col-sm-4">
                            <select name="day" id="day" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Day</option>
                                <?php
                                foreach($days as $d){
                                    echo '<option value='.$d->id.'>'.$d->day.'</option>';
                                }
                                ?>
                            </select>
                        </div>


                        <select name="visible" id="visible" class="form-control semester" style="display:none;">
                        <option value="" disabled="disabled">Select Date</option>
                        </select>

                        <label class="col-sm-2 col-sm-2 control-label">Date</label>
                        <div class="col-sm-4">
                            <input id="date" type="text" name="dateinput" required>
                        </div>

                    </div>


                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Slot</label>
                        <div class="col-sm-4">
                            <select name="slot" id="slot" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Slot</option>
                                <?php
                                foreach($slots as $slot){
                                    echo '<option value='.$slot->id.'>'.$slot->slot_name.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Room</label>
                        <div class="col-sm-4">
                            <select name="room" id="room" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Room</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                        <div class="col-sm-4">
                            <select name="semester" id="semester" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Semester</option>
                                <?php
                                foreach($semesters as $semester){
                                    echo '<option value='.$semester->id.'>'.$semester->season_name.' - '.$semester->year.'</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <label class="col-sm-2 col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            <select name="status" id="status" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Status</option>
                                <?php
                                foreach($status as $stmt){
                                    echo '<option value='.$stmt->id.'>'.$stmt->code.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Grade Out Of</label>
                            <div class="col-sm-4">
                            <input type="text" pattern="\d*" maxlength="3" class="form-control" name="gradeof" id="gradeof" required>
                        </div>

                    </div>
                    </fieldset>
                    <input type="submit" name="addDetail" id="main">
                    <a href="/exam/default" id="cancel">Cancel</a>
                </form>
            </div>
        </div>
    </div>
<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';