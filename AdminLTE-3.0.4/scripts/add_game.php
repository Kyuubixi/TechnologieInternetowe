<?php
    session_start();

    if(isset($_SESSION['logged']['email']))
    {
        if (!empty($_POST['title']) && !empty($_POST['genre']) && !empty($_POST['desc']))
        {
            $error = 0;

            if (!isset($_POST['terms']))
            {
                $_SESSION['error'] = "Check agreements to terms.";
                $error = 1;
            }

            if($error == 0)
            {
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
                $link = $_POST['link'];

                $sql = "INSERT INTO `games` (`user_id`, `title`, `genre`, `description`, `address`) VALUES (?, ?, ?, ?, ?)";

                $result = $connect->prepare($sql);
                $result->bind_param("sssss", $id, $title, $genre, $desc, $link);

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
            else
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
            $_SESSION['error'] = "Fill all required fields.";
            ?>
                <script>
                    history.back();
                </script>
            <?php
        }
    }
?>