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
          </div>
      </aside>