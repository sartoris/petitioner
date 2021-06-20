<?php
    session_start();
    include 'includes/db_user.php';
?>

<html>

<head>
    <link rel="stylesheet" href="<?php echo $cssLocation ?>login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $organization ?> - Sign in</title>
    <link rel="icon" type="image/png" href="<?php echo $icon ?>"/>
<?php
    $msg = "";
    if (isset($_POST['login']))
    {
        if(!isset($_POST['loginId']) || empty($_POST['loginId'])) {
            $msg = "Login Id is required";
        } else if(!isset($_POST['password']) || empty($_POST['password'])) {
            $msg = "Password is required";
        } else {
            $userid = getUserID($_POST['loginId'], $_POST['password']);
            if ($userid == 0) {
                $msg = "Bad password or login id";
            } else  if ($userid == 400) {
                $msg = "400 error";
            } else {
                $_SESSION['userid'] = $userid;
                $_SESSION['isadmin'] = isAdminUser($userid);
                $_SESSION['timeout'] = time() + 1800; // 30 minutes
                if(isPasswordChangeRequired($userid)) {
                    $_SESSION['errorMsg'] = "You must change your password.";
                    header('Location: reset_password.php');
                } else {
                    header('Location: update_petition.php');
                }
                exit();
            }
        }
    } else {
        unset($_SESSION['errorMsg']);
        unset($_SESSION['userid']);
        unset($_SESSION['isadmin']);
        unset($_SESSION['timeout']);
    }
?>
    <script language="javascript">

        function onLoad() {
            document.getElementById("loginId").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <div class="main">
        <div class="logo">
            <img src="<?php echo $loginLogo ?>" alt="<?php echo $organization ?>"/>
            <p class="info" align="center" >For login issues, email <br/><?php echo $contact ?></p>
            <div class="forgot" align="center"><a href="forgot_password.php">Forgot Password?</a></div>
        </div>
        <div class="login">
            <p class="sign">Sign in</p>
            <div class="error" align="center" ><?php echo $msg ?></div>
            <form class="form1" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                <input class="un" type="text" align="center" id="loginId" name="loginId" placeholder="Login Id">
                <input class="pass" type="password" align="center" name="password" placeholder="Password">
                <input type="submit" class="submit" align="center" name="login" value="Sign in">
            </form>
        </div>
    </div>
</body>

</html>