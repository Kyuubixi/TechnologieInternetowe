<?php
    session_start();

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

        require_once './connect.php';

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