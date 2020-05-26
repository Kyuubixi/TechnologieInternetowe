<?php
    session_start();

    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email1']) && !empty($_POST['email2']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['birthdate']))
    {
        $error = 0;

        if(!isset($_POST['terms']))
        {
            $_SESSION['error'] = 'Check agreement to terms.';
            $error = 1;
        }

        if($_POST['email1'] != $_POST['email2'])
        {
            $_SESSION['error'] = 'Emails are different.';
            $error = 1;
        }

        if($_POST['pass1'] != $_POST['pass2'])
        {
            $_SESSION['error'] = 'Passwords are different.';
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

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email1'];
        $pass = $_POST['pass1'];
        $birthdate = $_POST['birthdate'];

        $city = 1;


        // password encryption using ARGON2ID
        $pass = password_hash($pass, PASSWORD_ARGON2ID);


        require_once './connect.php';
        if($connect->connect_errno != 0)
        {
            $_SESSION['error'] = "Failed connection to the database.";
            header('location: ../pages/register.php');
            exit();
        }

        // adding users to database

        $sql = "INSERT INTO `user` (`name`, `surname`, `city_id`, `email`, `password`, `birthdate`) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $connect->prepare($sql);
        $stmt->bind_param("ssssss", $name, $surname, $city, $email, $pass, $birthdate);

        if($stmt->execute())
        {
            header('location: ../?register=success');
        }
        else
        {
            $sql = "SELECT * FROM `user` WHERE `email` = ?";

            $stmt = $connect->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();

            if($connect->affected_rows)
            {
                $_SESSION['error'] = 'Provided email already exists in the database.';
            }
            else
            {
                $_SESSION['error'] = 'Failed to add user to the database.';
            }

            ?>
                <script>
                    history.back();
                </script>
            <?php
        }

        $stmt->close();
        $connect->close();
        exit();
    }
    else
    {
        $_SESSION['error'] = 'Enter all the required fields.';
        ?>
            <script>
                history.back();
            </script>
        <?php
        exit();
    }
?>