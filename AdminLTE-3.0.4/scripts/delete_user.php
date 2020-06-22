<?php
    session_start();

    require_once './connect.php';

    $id = $_GET['user_id'];

    $sql = "DELETE FROM `user` WHERE ID = $id";
    $result = $connect->query($sql);

    $connect->close();

    ?>
        <script>
            history.back();
        </script>
    <?php
?>