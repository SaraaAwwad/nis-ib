<?php

require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';
require_once HOME_TEMPLATE_PATH . 'wrapperstart.php';

?>
    <script src="../../../public/js/user.js"></script>
    <div class="row">
        <div class="col-lg-9 main-chart">
            <h1>Edit Student</h1>

        </div>
    </div>

    <div class="row mt">
        <div class="col-lg-12">
            <div class="form-panel">
                <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">

                    <legend>Student Info</legend>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                        <div class="col-sm-8">
                            <input name="fnamein" type="text" class="form-control" value="<?php echo $student->fname; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-8">
                            <input name="lnamein" type="text" class="form-control" value="<?php echo $student->lname; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Grade</label>
                        <div class="col-sm-4">
                            <select name="gradein" id="gradein" class="form-control semester" required>
                                <option value="" selected="selected" disabled="disabled">Select Grade</option>
                                <?php foreach($grade as $grad){ ?>
                                    <option value="<?php echo $grad->id; ?>"><?php echo $grad->grade_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                        <div class="col-sm-8">
                            <input id="date" type="date" name="datein" value="<?php echo $student->DOB; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                        <div class="col-sm-8">
                            <input name="numberin" type="text" pattern="\d*" maxlength="20" class="form-control" value="<?php echo $student->phone; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                        <div class="col-sm-8">
                            <label class="containerradio">Male
                                <input type="radio" checked="checked" value="M" name="radioin">
                                <span class="checkmark"></span>
                            </label>
                            <label class="containerradio" >Female
                                <input type="radio" value="F" name="radioin">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <legend>Account Information</legend>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="emailin" maxlength="15" value="<?php echo $student->email; ?>" required>@nis.edu.eg
                            <input type="hidden" name="extension" value="<?php echo '@nis.edu.eg'; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="usernamein" value="<?php echo $student->username; ?>" required>
                        </div>
                    </div>

                    <input type="submit" name="editStudent" id="main">
                </form>
            </div>
        </div>
    </div>

<?php
require_once HOME_TEMPLATE_PATH . 'wrapperend.php';
require_once HOME_TEMPLATE_PATH . 'templatefooter.php';