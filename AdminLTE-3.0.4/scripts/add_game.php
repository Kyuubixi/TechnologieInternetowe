<?php
    session_start();

    if(isset($_SESSION['logged']['email']))
    {
        if (!empty($_POST['title']) && !empty($_POST['genre']) && !empty($_POST['desc']))
        {
            if (!isset($_POST['terms']))
            {
                $_SESSION['error'] = "Check agreements to terms.";
            }

            require_once './connect.php';

            if($connect->connect_errno != 0)
            {
                $_SESSION['error'] = "Failed connection to the database.";
                header('location: ../pages/register_game.php');
                exit();
            }


            $id = $_SESSION['user_id'];
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $desc = $_POST['desc'];

            $sql = "INSERT INTO `games` (`user_id`, `title`, `genre`, `description`) VALUES (?, ?, ?, ?)";

            $result = $connect->prepare($sql);
            $result->bind_param("ssss", $id, $title, $genre, $desc);

            if($result->execute())
            {
                header('location: ../?gameregister=success');
                $stmt->close();
                $connect->close();
                exit();
            }
            else
            {
                $_SESSION['error'] = "Failed to add game";

            ?>
                <script>
                    history.back();
                </script>
            <?php
            }
        }
    }
?>