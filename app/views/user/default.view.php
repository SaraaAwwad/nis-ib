<?php
                require_once HOME_TEMPLATE_PATH . 'templateheaderstart.php';
                require_once HOME_TEMPLATE_PATH . 'templateheaderend.php';
                require_once HOME_TEMPLATE_PATH . 'header.php';
                require_once HOME_TEMPLATE_PATH . 'nav.php';

              ?>
                	
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
      <section id="container" >
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> View Staff</h3>

  <section class="tabcontent">
    <a class="buttonlink btn btn-theme04 left" href=""><i class="fa fa-undo"></i> Reload</a>
    <input type="search" class="light-table-filter" results="2" name="s" data-table="order-table" placeholder="Search.." />
    <table class="order-table">
      <thead>
        <tr>
          <th>ID</th>
          <th class="hidden-phone">First Name</th>
          <th class="hidden-phone">Last Name</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Username</th>
          <th>Password</th> 
          <th>Email</th>
          <th>Telephone</th>
          <th>User</th>
          <th><i class="fa fa-bookmark"></i> Salary</th>
          <th><i class=" fa fa-edit"></i> Status</th>
          <th>Action</th>
          <!--
          
          <th>Address</th>
          -->
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user){ ?>
        <tr>
          <td><?php echo $user->id; ?></td>
          <td><?php echo $user->fname; ?></td>
          <td><?php echo $user->lname; ?></td>
          <td><?php echo $user->gender; ?></td>
          <td><?php echo $user->DOB; ?></td>
          <td><a href="teacherspanel.php#"><?php echo $user->username;?></a></td>
          <td><?php echo $user->pwd; ?></td>
          <td><?php echo $user->email;?></td>
          <td><?php echo $user->number;?></td>
          <td><?php echo $user->title;?></td>
          <td><?php echo $user->amount;?></td>
          <td><span class="label label-info label-mini"><?php echo $user->code;?></span></td>
          <td  colspan="2">
            <a class="btn btn-success btn-xs" href="/user/edit/<?= $user->id ?>"><i class="fa fa-pencil-square-o"></i></a>
            <a class="btn btn-success btn-xs" href="/user/activate/<?= $user->id ?>"><i class="fa fa-unlock"></i></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

               
    </section><!-- wrapper -->
      </section><!-- /MAIN CONTENT -->
  </section>
                <?php
                //require_once TEMPLATE_PATH . 'wrapperend.php';
                require_once HOME_TEMPLATE_PATH . 'templatefooter.php';
