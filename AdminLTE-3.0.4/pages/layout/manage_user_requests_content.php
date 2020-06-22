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
                      <th style="text-align: center">Name</th>
                      <th style="text-align: center">Surname</th>
                      <th style="text-align: center">Email</th>
                      <th style="text-align: center">Birthdate</th>
                      <th style="text-align: center">Registration Timestamp</th>
                      <th style="text-align: right">Accept</th>
                      <th style="text-align: left">Reject</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $sql = "SELECT * FROM `user` WHERE `status_id`=2";
                        $result = $connect->query($sql);

                        if($result->num_rows != 0)
                        {
                          while($user = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\">$user[ID]</td>";
                            echo "<td style=\"text-align: center\">$user[name]</td>";
                            echo "<td style=\"text-align: center\">$user[surname]</td>";
                            echo "<td style=\"text-align: center\">$user[email]</td>";
                            echo "<td style=\"text-align: center\">$user[birthdate]</td>";
                            echo "<td style=\"text-align: center\">$user[registration_timestamp]</td>";



                            echo "<form action=\"../../scripts/accept_user.php\" method=\"GET\">";
                            $id = $user['ID'];
                            echo "<td><button type=\"submit\" class=\"btn btn-success\" style=\"float: right\" value=\"$id\" name=\"user_id\"><span class=\"fas fa-user-check\"></span></button></td>";
                            echo "</form>";

                            //Remove button
                            echo "<form action=\"../../scripts/delete_user.php\" method=\"GET\">";
                            $id = $user['ID'];
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