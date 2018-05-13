    <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                  <h5 class="centered"> <?php if (isset($_SESSION["userName"])){
                      echo $_SESSION["userName"];
                  } ?></h5>
    
      <?php 
      use PHPMVC\Models\UserTypesModel;

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
              <!--      <li class="sub-menu dcjq-parent-li">
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
-->
                  <!--  <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-bars"></i>
                          <span>Classes</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="/class">Manage Classes</a></li>
                          <li><a href="/schedule">Manage Schedules</a></li>                          
                          <li><a href="/course">Manage Courses</a></li>
                          <li><a href="/semester">Manage Semesters</a></li>                          
                          <li><a href="\registeration">Registeration</a></li>
                      </ul>
                  </li>

                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-table"></i>
                          <span>Exams</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="/exam">Manage Exams</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-user"></i>
                          <span>Staff</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="\staff">View Staff</a></li>
                          <li><a href="\staff\add">Add Staff</a></li>
                      </ul>
                  </li>

                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-user"></i>
                          <span>Students</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="\student">View Students</a></li>
                          <li><a href="\student\add">Add Student</a></li>
                      </ul>
                  </li>

                    <li class="sub-menu dcjq-parent-li">
                      <a class="dcjq-parent" href="javascript:;">
                          <i class="fa fa-user"></i>
                          <span>Resources</span>
                        <span class="dcjq-icon"></span></a>
                      <ul class="sub" style="display: block;">
                          <li><a href="\room">View Rooms</a></li>
                          <li><a href="\room\add">Add Room</a></li>
                      </ul>
                  </li>

              </ul> -->
              <!-- sidebar menu end-->
          </div>
      </aside>