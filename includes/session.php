<?php 
    session_start();
    validateSession();

    function validateSession() {
        if (!isset($_SESSION['userid']) || !isset($_SESSION['timeout']) || $_SESSION['timeout'] < time()) {
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['timeout'] = time() + 1800; // 30 minutes
        }
        return true;
    }

?>
