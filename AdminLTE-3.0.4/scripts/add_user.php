<?php
    session_start();

    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email1']) && !empty($_POST['email2']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['birthdate'])) {
        if(!isset($_POST['terms']))
        {
            $_SESSION['error'] = 'Check agreement to terms.';
            header('location: ../pages/register.php');
            exit();
        }
    }
    else{
        $_SESSION['error'] = 'Enter all the required fields.';
        header('location: ../pages/register.php');
        exit();
    }
?>