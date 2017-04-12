<?php

include_once 'db_connect.php';
include_once 'functions.php';

//Can't start a session since user doesn't know password
//sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['p'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['p']; // The hashed password.



    if (login($email, $password, $mysqli) == true) {
        // Login success
        header("Location: ../index.php");
        exit();
    }
} else {
    // The correct POST variables were not sent to this page.
    header('Location: ../error.php?err=Could not process login');
    exit();
}