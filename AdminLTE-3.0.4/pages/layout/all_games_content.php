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
              <li class="breadcrumb-item active">All Games</li>
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
          <!-- col -->
          <div class="col-md-12">
            <!-- PRODUCT LIST -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">All Games</h3>
                <div class="card-tools">
                  <form action="../register_game.php" method="POST">
                    <button type="submit" class="btn btn-block bg-gradient-success">
                      <span><i class="fas fa-plus"></i> <b>Add Game</b></span>
                    </button>
                  </form>
                </div>
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

                        $sql = "SELECT * FROM games g INNER JOIN user u ON g.user_id=u.ID ORDER BY g.id";
                        $result = $connect->query($sql);

                        if($result->num_rows != 0)
                        {
                          while($game = $result->fetch_assoc())
                          {
                            echo "<tr>";
                            echo "<td style=\"text-align: center\">$game[title]</td>";
                            echo "<td style=\"text-align: center\">$game[genre]</td>";

                            $str = wordwrap($game['description'], 20);
                            //$str = $game['description'];
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
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>