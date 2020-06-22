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
              <li class="breadcrumb-item active">Main</li>
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
            <?php
              if($_SESSION['user_permission'] != 2)
              {
            ?>
            <div class="card card-success">
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Recently Added Games</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="text-align: center">Title</th>
                      <th style="text-align: center">Genre</th>
                      <th style="text-align: center">Description</th>
                      <th style="text-align: center">Author</th>
                      <th style="text-align: center">Link</th>
                      <?php
                        if($_SESSION['user_permission'] != 2)
                        {
                          ?>
                          <th style="text-align: center"></th>
                          <?php
                        }
                      ?>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $sql = "SELECT * FROM games g INNER JOIN user u ON g.user_id=u.ID ORDER BY g.id DESC LIMIT 4";
                        $result = $connect->query($sql);

                        if($result->num_rows != 0)
                        {
                          while($game = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\">$game[title]</td>";
                            echo "<td style=\"text-align: center\">$game[genre]</td>";

                            $str = wordwrap($game['description'], 20);
                            echo "<td style=\"text-align: justify; width: 30%;\">$str</td>";

                            echo "<td style=\"text-align: center\">$game[name] $game[surname]</td>";

                            //Check if "HTTP" exists or not
                            $url = $game['address'];
                            if (strpos($url, 'http') === false) {
                              $url = 'http://' .$url;
                            }
                            echo "<td style=\"text-align: center\"><a href=\"$url\" target=\"_blank\">$url</a></td>";

                            if($_SESSION['user_permission'] != 2)
                            {
                              // X button to remove rows
                              echo "<form action=\"../../scripts/delete_game.php\" method=\"GET\">";
                              $id = $game['id'];
                              echo "<td><button type=\"submit\" class=\"btn btn-danger\" style=\"float: right\" value=\"$id\" name=\"game_id\"><span class=\"fas fa-times-circle\"></span></button></td>";
                              echo "</form>";
                            }

                            echo "</tr>";
                          }
                        }

                      ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- NEWS POST -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <span class="username">Admin #1</span>
                  <span class="description">Uploaded: 2:30AM</span>
                </div>
                <!-- /.user-block -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h3 style="text-align: center">Cyberpunk 2077 delayed again: "We won't ship something which is not ready"</h3>
                <p style="text-align: justify">
                Cyberpunk 2077 has been delayed from September 17 to November 19, CD Projekt Red has announced in a new statement on Twitter, seen below.<br><br>

                The official announcement from the Polish studio explains that "Cyberpunk 2077 is finished both content and gameplay-wise. The quests, the cutscenes, the skills and items; all the adventures Night City has to offer - it's all there."<br><br>

                "But with such an abundance of content and complex systems interweaving with each other, we need to properly go through everything, balance game mechanics, and fix a lot of bugs. " "Ready when it's done" is not just a phrase we say because it sounds right, it's something we live by even when we know we'll take the heat for it." <br><br>

                This news marks the second delay for the upcoming game of 2020, though it's not quite as significant as the first, which originally pushed it back by several months from its original release date of April 16. <br><br>

                CD Projekt Red have already confirmed that Cyberpunk 2077 is launching for next-gen consoles the PS5 and Xbox Series X after its initial release, but this delay suggests the game will be arriving within weeks of the two new platforms, and potentially after both systems have hit store shelves. <br><br>

                We'll have to wait a few more months to learn the full layout of the Holiday 2020 release schedule but, rest assured, it looks like we'll still be playing Cyberpunk 2077 before Christmas. <br><br>
                </p>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>