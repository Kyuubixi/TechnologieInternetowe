<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Games</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../#">Home</a></li>
              <li class="breadcrumb-item active">Games</li>
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

            <!-- TABLE: RECENT ACTIVITY -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Recent activity</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Surname</th>
                      <th>Permission</th>
                      <th>Status</th>
                      <th>Last login</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $sql = 'SELECT * FROM user INNER JOIN permissions ON user.permission_id = permissions.id INNER JOIN status ON user.status_id = status.id ORDER BY `user`.`last_login` DESC LIMIT 4';
                        $result = $connect->query($sql);

                        if ($result->num_rows != 0)
                        {
                          while($user = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td>$user[name]
                            <td>$user[surname]";

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

                            echo "<td><span class=\"badge badge-$color\">$permission</span></td>";

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

                            echo "<td><span class=\"badge badge-$color\">$status</td>";

                            if ($user['last_login'] != null)
                            {
                              echo "<td>$user[last_login]</td>";
                            }
                            else
                            {
                              echo "<td>Never</td>";
                            }


                            echo "</tr>";
                          }
                        }
                        else
                        {
                          echo '<td colspan="5"><span class="badge badge-danger">No records</span></td>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Games</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Title</th>
                      <th>Genre</th>
                      <th>Description</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $sql = 'SELECT * FROM games ORDER BY id DESC';
                        $result = $connect->query($sql);

                        if($result->num_rows != 0)
                        {
                          while($game = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td>$game[title]</td>";
                            echo "<td>$game[genre]</td>";
                            echo "<td>$game[description]</td>";

                            echo "<form action=\"../../scripts/delete_game.php\" method=\"GET\">";
                            
                            $id = $game['id'];

                            echo "<td><button type=\"submit\" class=\"btn btn-block bg-gradient-danger\" value=\"$id\" name=\"game_id\">X</button></td>";

                            echo "</form>";

                            echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="../../" class="uppercase">View All Games</a>
              </div>
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