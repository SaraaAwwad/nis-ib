<?php
require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
require_once HOME_TEMPLATE_PATH . 'header.php';
require_once HOME_TEMPLATE_PATH . 'nav.php';

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../../../public/js/user.js"></script>
<section id="container" >
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Edit Info</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Personal Information</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="fnameinput" value="<?php echo $users->fname; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="lnameinput" value="<?php echo $users->lname; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="numberinput" value="<?php echo $users->phone; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Date Of Birth</label>
                                    <div class="col-sm-10">
                                        <input id="date" type="date" name="dateinput" value="<?php echo $users->DOB; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        <label class="containerradio">Male
                                            <input type="radio" checked="checked" value="M" name="radioinput" required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerradio" >Female
                                            <input type="radio" value="F" name="radioinput">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10">
                                        <?php foreach($status as $status){ ?>
                                            <label class="containerradio"><?php echo $status->code; ?>
                                                <input type="radio" checked="checked" value="<?php echo $status->id; ?>" name="statusinput" required>
                                                <span class="checkmark"></span>
                                            </label>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Profession</label>
                                    <div class="styled-select slate">
                                        <select name="professioninput" required>
                                            <option>Select Profession</option>
                                            <?php foreach($usertype as $usertype){ ?>
                                                <option value="<?php echo $usertype->id; ?>"><?php echo $usertype->title; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Address Information</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Country</label>
                                    <div class="styled-select slate">
                                        <select name="country" id="country" required>
                                            <option value="">Select Country</option>
                                            <?php foreach($country as $count){ ?>
                                                <option value="<?php echo $count->id; ?>"><?php echo $count->address; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">City</label>
                                    <div class="styled-select slate">
                                        <select name="city" id="City" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Area</label>
                                    <div class="styled-select slate">
                                        <select name="area" id="Area" required>
                                            <option value="">Select Area</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Street</label>
                                    <div class="styled-select slate">
                                        <select name="street" id="Street" required>
                                            <option value="">Select Street</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Account Information</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="emailinput" maxlength="15" value="<?php echo $users->email; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="usernameinput" value="<?php echo $users->username; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="imageinput" accept="image/*" required>
                                    </div>
                                </div>
                                <legend>Salary Information</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Salary</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="salaryinput" value="<?php echo $salary->amount; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Currency</label>
                                    <div class="styled-select slate">
                                        <select name="currencyinput" required>
                                            <option value="">Select Currency</option>
                                            <?php foreach($currencies as $currency){ ?>
                                                <option value="<?php echo $currency->id; ?>"><?php echo $currency->code; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="submit" name="edit" id="main">
                            <a href="/staff/default" id="cancel">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
    <?php
    require_once HOME_TEMPLATE_PATH . 'templatefooter.php'; ?>

