<?php
    session_start();

    require_once './connect.php';

    if (isset($_SESSION['logged']['email']))
    {
        switch($_SESSION['logged']['permission'])
        {
            case '1':
                header('location: ../pages/logged/admin.php');
                break;
            case '2':
                header('location: ../pages/logged/user.php');
                break;
            case '3':
                header('location: ../pages/logged/moderator.php');
                break;
        }
        exit();
    }

    if(!empty($_POST['email'] && !empty($_POST['pass'])))
    {
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $sql = "SELECT * FROM `user` WHERE `email` = ?";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $error = 0;

        if($result->num_rows == 1)
        {
            $user = $result->fetch_assoc();

            if(password_verify ($pass, $user['password']))
            {
                switch($user['status_id'])
                {
                    case '1':
                        $_SESSION['logged']['name'] = $user['name'];
                        $_SESSION['logged']['surname'] = $user['surname'];
                        $_SESSION['logged']['email'] = $user['email'];
                        $_SESSION['logged']['permission'] = $user['permission_id'];
                        $_SESSION['user_id'] = $user['ID'];
                    case '2':
                        $_SESSION['error'] = "Account is inactive<br>Email: ".$user['email'];
                        break;
                    case '3':
                        $_SESSION['error'] = "Account is blocked";
                        break;
                }

                if($user['status_id'] != 1)
                {
                    header('location: ../');
                }
                else
                {
                    switch($user['permission_id'])
                    {
                        case '1':
                            header('location: ../pages/logged/admin.php');
                            break;
                        case '2':
                            header('location: ../pages/logged/user.php');
                            break;
                        case '3':
                            header('location: ../pages/logged/moderator.php');
                            break;
                    }
                }

                     // update last login
                    $date = date('Y-m-d H:i:s');
                    $email = $_SESSION['logged']['email'];
                    $sql = "UPDATE `user` SET `last_login`='$date' WHERE email='$email'";
                    $connect->query($sql);

                $stmt->close();
                $connect->close();
                exit();
            }
            else
            {
                $_SESSION['error'] = 'Incorrect email or password.';

                $error = 1;
            }

        }
        else
        {
            $_SESSION['error'] = 'Incorrect email or password.';

            $error = 1;
        }

        if($error == 1)
        {
            ?>
                <script>
                    history.back();
                </script>
            <?php
        }
    }
    else
    {
        $_SESSION['error'] = 'Fill every field.'

        ?>
            <script>
                history.back();
            </script>
        <?php
    }
?>