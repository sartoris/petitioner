<?php
    session_start();
    if (!isset($_SESSION['timeout']) || $_SESSION['timeout'] < time()) {
        header('Location: login.php');
    }
    include 'includes/db.php';

    $endorsement = isset($_POST["endorsement"])?1:0;

    if (empty($_POST["id"])) {
        $stmt = $connection->prepare("insert into Organization (
            Name,
            ContactId,
            Endorsement,
            Notes,
            CreatedBy,
            ModifiedBy
        ) values (?,?,?,?,?,?)");
        $stmt->bind_param("siisii", 
            $_POST["name"],
            $_POST["contactId"],
            $endorsement,
            $_POST["notes"],
            $_SESSION["userid"],
            $_SESSION["userid"]
        );
    } else {
        $stmt = $connection->prepare("select id from Organization where id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if ($result == $_POST["id"]) {
            if (isset($_POST["delete"])) {
                $stmt = $connection->prepare("delete from Organization where id = ?");
                $stmt->bind_param("i", $_POST["id"]);
            } else {
                $stmt = $connection->prepare("update Organization set
                    Name = ?,
                    ContactId = ?,
                    Endorsement = ?,
                    Notes = ?,
                    ModifiedBy = ?,
                    ModifiedOn = CURRENT_TIMESTAMP where id = ?");
                $stmt->bind_param("siisii", 
                    $_POST["name"],
                    $_POST["contactId"],
                    $endorsement,
                    $_POST["notes"],
                    $_SESSION["userid"],
                    $_POST["id"]
                );
            }
        }
    }
    $result = $stmt->execute();
    if($result === FALSE) { 
        echo "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    if($result === TRUE) { 
        header('Location: '.$_SERVER["HTTP_REFERER"]);
        exit();
    }

?>
