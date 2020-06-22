<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Game</b>Live</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="../logged/my_games.php" class="d-block">
          <?php
            require_once '../../scripts/connect.php';

            $email = $_SESSION['logged']['email'];

            $sql = "SELECT * FROM user WHERE email = '$email'";

            $result = $connect->query($sql);
            $user = $result->fetch_assoc();

            $name = ucfirst($user['name']);
            $surname = ucfirst($user['surname']);

            echo "$name $surname";
          ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="../../" class="nav-link active">
              <i class="nav-icon fas fa-gamepad"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Main Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../logged/all_games.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Games</p>
                </a>
              </li>
            </ul>
              <?php
              if($_SESSION['user_permission'] != 2)
              {
              ?>
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-closed">
                  <a href="../../" class="nav-link active">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manage Users
                    <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../logged/manage_user_requests.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Requests</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../logged/manage_users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
            </ul>
                </li>
              </ul>
              <?php
              }
              ?>
          </li>
          <li class="nav-item">
            <a href="../../scripts/logout.php" class="nav-link active">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>