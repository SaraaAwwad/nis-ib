<?php
    require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
    require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
    require_once HOME_TEMPLATE_PATH . 'header.php';
    require_once HOME_TEMPLATE_PATH . 'nav.php';
    require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';
?>                    

    <form class="form-horizontal style-form" method="post">
      
        <legend>Course Info</legend>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="coursename" value="<?=$course->name?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Course Code</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="coursecode" value="<?=$course->course_code;?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <input type="text" name="description" value="<?=$course->descr;?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
                <?php foreach($Levels as $lev){ ?>
                <label class="containerradio"><?php echo $lev->level; ?>
                <input type="radio" checked="checked" value="<?php echo $lev->id; ?>" name="level" required>
                <span class="checkmark"></span>
                </label>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Group</label>
            <div class="col-sm-10">
                <?php foreach($group as $gr){ ?>
                <label class="containerradio"><?php echo $gr->group_name; ?>
                <input type="radio" checked="checked" value="<?php echo $gr->id; ?>" name="group" required>
                <span class="checkmark"></span>
                </label>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <?php foreach($status as $status){ ?>
                <label class="containerradio"><?php echo $status->code; ?>
                <input type="radio" checked="checked" value="<?php echo $status->id; ?>" name="status" required>
                <span class="checkmark"></span>
                </label>
                <?php } ?>
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Teaching Hours</label>
            <div class="col-sm-10">
                <input type="text" name="teaching" value="<?=$course->teaching_hours;?>">
            </div>
        </div>
        
        
      <input type="submit" name="updatecourse" id="main">
    </form>


<?php                    
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
?>