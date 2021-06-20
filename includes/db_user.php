<?php
require_once 'db.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function getUserID($loginId, $password) {
    global $connection;
    $userid = 0;
    $hash = "";
    $statement = $connection->prepare("SELECT ID, Password FROM `User` WHERE LoginId = ?");
    $statement->bind_param("s", $loginId);
    $statement->execute();
    $result = $statement->bind_result($userid, $hash);
    $statement->fetch();
    $statement->close();
    if (!password_verify($password, $hash)) {
        $userid = 0;
    }
    return $userid;
}

function isAdminUser($userid) {
    global $connection;
    $isAdmin = 0;
    $statement = $connection->prepare("SELECT ID FROM User WHERE ID = ? AND Type = 'Admin'");
    $statement->bind_param("s", $userid);
    $statement->execute();
    $result = $statement->bind_result($returnid);
    if ($result == false)
        return 400;
    else {
        if ($statement->fetch()) {
            $isAdmin = $returnid == $userid;
        }
    }
    $statement->close();
    return $isAdmin;
}

function isPasswordChangeRequired($userid) {
    global $connection;
    $changeRequired = true;
    $statement = $connection->prepare("SELECT ModifiedBy FROM User WHERE ID = ?");
    $statement->bind_param("i", $userid);
    $statement->execute();
    $result = $statement->bind_result($returnid);
    if ($result == false)
        return 400;
    else {
        if ($statement->fetch()) {
            $changeRequired = $returnid != $userid;
        }
    }
    $statement->close();
    return $changeRequired;
}

function userExists($loginId) {
    global $connection;
    $stmt = $connection->prepare("select id from User where LoginId = ?");
    $stmt->bind_param("s", $loginId);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();
    return $result != NULL;
}

function saveUserBasic() {
    global $connection;
    $result = false;
    if (empty($_POST["id"])) {
        if(userExists($_POST["loginId"])) {
            $_SESSION['errorMsg'] = "User already exists!";
            return;
        } else {
            $stmt = $connection->prepare("insert into User (
                LoginId,
                Name,
                Email,
                Type,
                CreatedBy,
                ModifiedBy
            ) values (?,?,?,?,?,?)");
            $stmt->bind_param("ssssii", 
                $_POST["loginId"],
                $_POST["name"],
                $_POST["email"],
                $_POST["userType"],
                $_SESSION["userid"],
                $_SESSION["userid"]
            );
        }
    } else {
        $stmt = $connection->prepare("select id from User where id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if ($result == $_POST["id"]) {
            if (isset($_POST["delete"])) {
                $stmt = $connection->prepare("delete from User where id = ?");
                $stmt->bind_param("i", $_POST["id"]);
            } else {
                $stmt = $connection->prepare("update User set
                    LoginId = ?,
                    Name = ?,
                    Email = ?,
                    Type = ?,
                    Token = '',
                    ResetAttempts = 0,
                    ModifiedBy = ?,
                    ModifiedOn = CURRENT_TIMESTAMP where id = ?");
                $stmt->bind_param("ssssii", 
                    $_POST["loginId"],
                    $_POST["name"],
                    $_POST["email"],
                    $_POST["userType"],                               
                    $_SESSION["userid"],
                    $_POST["id"]
                );
            }
        }
    }
    $result = $stmt->execute();
    if($result === FALSE) { 
        $_SESSION['errorMsg'] = "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    return $result;
}

function saveUser() {
    global $connection;
    $result = false;
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    if (empty($_POST["id"])) {
        if(userExists($_POST["loginId"])) {
            $_SESSION['errorMsg'] = "User already exists!";
            return;
        } else {
            $stmt = $connection->prepare("insert into User (
                LoginId,
                Name,
                Password,
                Email,
                Type,
                CreatedBy,
                ModifiedBy
            ) values (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssii", 
                $_POST["loginId"],
                $_POST["name"],
                $hash,
                $_POST["email"],
                $_POST["userType"],
                $_SESSION["userid"],
                $_SESSION["userid"]
            );
        }
    } else {
        $stmt = $connection->prepare("select id from User where id = ?");
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        $stmt->close();
        if ($result == $_POST["id"]) {
            if (isset($_POST["delete"])) {
                $stmt = $connection->prepare("delete from User where id = ?");
                $stmt->bind_param("i", $_POST["id"]);
            } else {
                $stmt = $connection->prepare("update User set
                    LoginId = ?,
                    Name = ?,
                    Password = ?,
                    Email = ?,
                    Type = ?,
                    Token = '',
                    ResetAttempts = 0,
                    ModifiedBy = ?,
                    ModifiedOn = CURRENT_TIMESTAMP where id = ?");
                $stmt->bind_param("sssssii", 
                    $_POST["loginId"],
                    $_POST["name"],
                    $hash,
                    $_POST["email"],
                    $_POST["userType"],                               
                    $_SESSION["userid"],
                    $_POST["id"]
                );
            }
        }
    }
    $result = $stmt->execute();
    if($result === FALSE) { 
        $_SESSION['errorMsg'] = "ERROR: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    return $result;
}

function sendForgotEmail($useremail) {
    global $connection;
    global $contact;
    global $organization;
    global $mainLocation;
    global $smtpHost;
    global $smtpPort;
    global $smtpUsername;
    global $smtpPassword;
    $result = "";
    $userid = "";
    $name = "";
    $password = "";
    $attempts = 0;
    $statement = $connection->prepare("SELECT Id, Name, Password, ResetAttempts FROM `User` WHERE Email = ? AND ResetAttempts < 3");
    $statement->bind_param("s", $useremail);
    $statement->execute();
    $result = $statement->bind_result($userid, $name, $password, $attempts);
    $statement->fetch();
    $statement->close();
    if ($userid == NULL) {
        $result = "There is a problem with " . $useremail . "; Please contact " . $contact . " for help.";
    } else {
        $token = md5($useremail . strtotime("now"));
        $attempts ++;
        $statement = $connection->prepare("UPDATE `User` SET
            Token = ?,
            ResetAttempts = ?,
            ModifiedOn = CURRENT_TIMESTAMP WHERE Id = ?");
        $statement->bind_param("sii", $token, $attempts, $userid);
        $result = $statement->execute();
        if($result === FALSE) { 
            $result = "ERROR: " . $statement->error;
        } else {
            $mail = new PHPMailer();
            $mail->isSMTP();
            
            //Enable SMTP debugging
            //SMTP::DEBUG_OFF = off (for production use)
            //SMTP::DEBUG_CLIENT = client messages
            //SMTP::DEBUG_SERVER = client and server messages
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            
            //Set the hostname of the mail server
            $mail->Host = $smtpHost;
            $mail->Port = $smtpPort;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;

            $mail->setFrom($contact, $organization." Support");
            $mail->addReplyTo($contact, $organization." Support");
            $mail->addAddress($_POST['user_email'], $name);
            $mail->Subject = 'Password reset';

            $mail->isHTML(true);
            $link = $_SERVER['HTTP_HOST'].$mainLocation."reset_password.php?i=".$userid."&h=".$token;
            $mail->Body = "<a href='$link'>Click here to reset password</a>";
            $mail->AltBody = "Navigate here to reset password: " . $link;
            
            if (!$mail->send()) {
                $result = "Mailer Error: " . $mail->ErrorInfo;
            } else {
                $result = "Email has been sent - Please click on the link in the email to confirm.";
            }
        }
        $statement->close();
    }
    return $result;   
}

?>