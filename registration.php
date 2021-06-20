<?php
    include 'includes/db.php';
    session_start();

    $stmt = $connection->prepare("insert into Person (
        FirstName,
        LastName,
        City,
        Zip,
        Email,
        Phone,
        County
    ) values (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", 
        $_POST["firstName"],
        $_POST["lastName"],
        $_POST["city"],
        $_POST["zip"],
        $_POST["email"],
        $_POST["phone"],
        $_POST["county"]
    );

    $result = $stmt->execute();
    if($result === FALSE) { 
        echo "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    if($result === TRUE) { 
        header('Location: registration_confirmation.php');
        exit();
    }

?>