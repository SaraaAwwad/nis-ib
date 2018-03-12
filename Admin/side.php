      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="profile.php"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                  <h5 class="centered">User</h5>

                
      <?php 
        /*require_once("../classes/user.php");
        if(!isset($_SESSION["userID"])){
            echo 'sorry you cant view this page'; 
            exit();
        }
        else{
            $userID = $_SESSION["userID"];
            $userObj = new User($userID);

            for ($i=0;$i<count($userObj->UserTypeObj->UserPages);$i++)
            {
                if ($userObj->UserTypeObj->UserPages[$i]->physicalname!="")
                {   
                    if ($userObj->UserTypeObj->UserPages[$i]->pageid == 0){
                        echo '
                        <li><a href='.$userObj->UserTypeObj->UserPages[$i]->physicalname.'><span>'
                        .$userObj->UserTypeObj->UserPages[$i]->friendlyname.'
                        </span></a></li>';
                    }else{
                        echo '<ul class="sub" style="display: block;">
                        <li><a href="view_pages.php">View Pages</a></li>
                       
                    </ul>';
                    }
                    echo '</li>';
                   /* echo ' <li class="sub-menu">
                     <a href="admin_home.php">
                         <i class="fa fa-dashboard"></i>
                         <span>Dashboarzd</span>
                     </a>
                        </li>';
                }
                else
                {
                   // echo "<br><a href=displayArticleController.php?ID=".$UseObject->UserType_obj->ArrayOfPages[$i]->ID.">".$UseObject->UserType_obj->ArrayOfPages[$i]->FreindlyName."</a>";
                    
                }
            }
        }*/

      ?>
                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-book"></i>
                          <span>Control</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="view_pages.php">View Pages</a></li>
                          <li><a href="add_page.php">Add Page</a></li>
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
                          <li><a href="view_students.php">View Students</a></li>
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