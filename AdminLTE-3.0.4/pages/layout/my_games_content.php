<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Your Games</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../#">Home</a></li>
              <li class="breadcrumb-item active">My Games</li>
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
                <h3 class="card-title">Your Added Games</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              <table class="table m-0">
                    <thead>
                    <tr>
                      <th style="text-align: center">Title</th>
                      <th style="text-align: center">Genre</th>
                      <th style="text-align: center">Description</th>
                      <th style="text-align: center">Link</th>
                      <th style="text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        require_once '../../scripts/connect.php';

                        $user_id = $_SESSION['user_id'];

                        $sql = "SELECT * FROM `games` WHERE `user_id` = $user_id";
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
                            
                            //Check if "HTTP" exists or not
                            $url = $game['address'];
                            if (strpos($url, 'http') === false) {
                              $url = 'http://' .$url;
                            }
                            echo "<td style=\"text-align: center\"><a href=\"$url\" target=\"_blank\">$url</a></td>";

                            //Remove button
                            echo "<form action=\"../../scripts/delete_game.php\" method=\"GET\">";
                            $id = $game['id'];
                            echo "<td><button type=\"submit\" class=\"btn btn-danger\" style=\"float: right\" value=\"$id\" name=\"game_id\"><span class=\"fas fa-times-circle\"></span></button></td>";
                            echo "</form>";

                            echo "</tr>";
                          }
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\" colspan=5>No games found.</td>";
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