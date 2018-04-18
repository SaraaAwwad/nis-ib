    <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="profile.php"><img src="<?= ASSETS_IMG ?>ui-sam.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered"> User</h5>
    
      <?php 
      use PHPMVC\Models\usertypesmodel;
      use PHPMVC\Lib\Database\DatabaseHandler;

        if(!isset($_SESSION["userID"])){
            exit();
        }
        else{
            $userTypeID = $_SESSION["userType"];
            $userTypesObj = new UserTypesModel($userTypeID);

            for ($i=0;$i<count($userTypesObj->UserParentPages);$i++)
            {
                
               echo '<li class="sub-menu dcjq-parent-li">
                        <a class="dcjq-parent" href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>'.$userTypesObj->UserParentPages[$i]->friendlyname.'</span>
                        <span class="dcjq-icon"></span></a>
                        <ul class="sub" style="display: block;">';
                           $subpages = $userTypesObj->getUserPages($userTypesObj->UserParentPages[$i]->id);
                                for ($j=0; $j< count($subpages); $j++){  
                                    if ($subpages[$j]->html != ""){
                                        echo '  <li><a href="'.$subpages[$j]->physicalname.$subpages[$j]->id.'">'. $subpages[$j]->friendlyname  .'</a></li>';

                                    }else{
                                        echo '  <li><a href="'.$subpages[$j]->physicalname.'">'. $subpages[$j]->friendlyname  .'</a></li>';
                                    }           
                                 }
                        echo'</ul>
                    </li>';
            }
        }
    ?>
                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-book"></i>
                          <span>Control</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="\usertypes">User Types</a></li>
                          <li><a href="\pages">View Pages</a></li>
                          <li><a href="\pages\add">Add Page</a></li>                        
                      </ul>
                  </li>

                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-bars"></i>
                          <span>Courses</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="view_courses.php">Manage Courses</a></li>
                      </ul>
                  </li>

                       <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-user"></i>
                          <span>Students</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="\student">View Students</a></li>
                          <li><a href="add_student.php">Add Student</a></li>
                      </ul>
                  </li>

                     <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-male"></i>
                          <span>Staff</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="view_staff.php">View Staff</a></li>
                          <li><a href="addteacher.php">Add Staff</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>