<?php
    session_start();

    require_once './connect.php';

    $id = $_GET['game_id'];

    $sql = "DELETE FROM games WHERE id = $id";
    $result = $connect->query($sql);

    $connect->close();

    ?>
        <script>
            history.back();
        </script>
    <?php
?>