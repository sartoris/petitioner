<?php
    session_start();
    unset($_SESSION['userid']);
    unset($_SESSION['isadmin']);
    unset($_SESSION['timeout']);
    header('Location: login.php');
    exit();
?>