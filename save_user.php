<?php
    include 'includes/session.php';
    include 'includes/db_user.php';
    saveUser();
    header('Location: '.$_SERVER["HTTP_REFERER"]);
    exit();
?>