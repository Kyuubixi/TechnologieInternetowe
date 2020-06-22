<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">

            <!-- PRODUCT LIST -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All user applications</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="text-align: center">ID</th>
                      <th style="text-align: center">Permission_ID</th>
                      <th style="text-align: center">Status_ID</th>
                      <th style="text-align: center">Name</th>
                      <th style="text-align: center">Surname</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Birthdate</th>
                      <th style="text-align: center">Registration Timestamp</th>
                      <th style="text-align: right">Unblock</th>
                      <th style="text-align: center">Block</th>
                      <th style="text-align: left">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $sql = "SELECT * FROM `user` INNER JOIN `permissions` ON `user`.`permission_id`=`permissions`.`id` INNER JOIN `status` ON `user`.`status_id`=`status`.`id`";
                        $result = $connect->query($sql);

                        if($result->num_rows != 0)
                        {
                          while($user = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\">$user[ID]</td>";

                            switch($user['permission_id'])
                            {
                                case '1': 
                                    $color = 'info';
                                    break;
                                case '2':
                                    $color = 'success';
                                    break;
                                case '3':
                                    $color = 'warning';
                                    break;
                            }

                            $permission = ucfirst($user['permission']);

                            echo "<td style=\"text-align: center\"><span class=\"badge badge-$color\">$permission</span></td>";

                            switch($user['status_id'])
                            {
                                case '1': 
                                    $color = 'success';
                                    break;
                                case '2':
                                    $color = 'warning';
                                    break;
                                case '3':
                                    $color = 'danger';
                                    break;
                            }

                            $status = ucfirst($user['status']);

                            echo "<td style=\"text-align: center\"><span class=\"badge badge-$color\">$status</span></td>";

                            echo "<td style=\"text-align: center\">$user[name]</td>";
                            echo "<td style=\"text-align: center\">$user[surname]</td>";
                            echo "<td style=\"text-align: center\">$user[email]</td>";
                            echo "<td style=\"text-align: center\">$user[birthdate]</td>";
                            echo "<td style=\"text-align: center\">$user[registration_timestamp]</td>";

                            $id = $user['ID'];

                            //Unbock button
                            echo "<form action=\"../../scripts/accept_user.php\" method=\"GET\">";
                            echo "<td><button type=\"submit\" class=\"btn btn-success\" style=\"float: right\" value=\"$id\" name=\"user_id\"><span class=\"fas fa-lock-open\"></span></button></td>";
                            echo "</form>";

                            //Block button
                            echo "<form action=\"../../scripts/block_user.php\" method=\"GET\">";
                            echo "<td style=\"text-align: center\"><button type=\"submit\" class=\"btn btn-warning\" value=\"$id\" name=\"user_id\"><span class=\"fas fa-lock\"></span></button></td>";
                            echo "</form>";

                            //Remove button
                            echo "<form action=\"../../scripts/delete_user.php\" method=\"GET\">";
                            echo "<td><button type=\"submit\" class=\"btn btn-danger\" style=\"float: left\" value=\"$id\" name=\"user_id\"><span class=\"fas fa-times-circle\"></span></button></td>";
                            echo "</form>";

                            echo "</tr>";
                          }
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\" colspan=8>No user applications.</td>";
                            echo "</tr>";
                        }

                      ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>