<html>

<head>
<?php
    session_start();
    include 'includes/db_user.php';
    $msg = "";
    $msgClass = "noMsg";
    
    if(isset($_GET["i"]) && isset($_GET["h"])) {
        $token = "";
        $modifiedon = "";
        $statement = $connection->prepare("SELECT Token FROM `User` WHERE ID = ? AND ModifiedOn > DATE_SUB(NOW(), INTERVAL 15 MINUTE)");
        $statement->bind_param("i", $_GET["i"]);
        $statement->execute();
        $result = $statement->bind_result($token);
        echo $token;
        if($result === FALSE) { 
            $_SESSION['errorMsg'] = "ERROR: " . $statement->error;
           header('Location: forgot_password.php');
            exit();
        }
        $statement->fetch();
        $statement->close();
        if($token == $_GET["h"]) {
            $statement = $connection->prepare("UPDATE `User` SET Token = '', ResetAttempts = 0 WHERE Id = ?");
            $statement->bind_param("i", $_GET["i"]);
            $result = $statement->execute();
            if($result === FALSE) { 
                $_SESSION['errorMsg'] = "ERROR: " . $statement->error;
                header('Location: forgot_password.php');
                exit();
            } else {
                $_SESSION["userid"] = $_GET["i"];
                $_SESSION['timeout'] = time() + 1800;
            }
            $statement->close();
        } else {
            $_SESSION['errorMsg'] = "ERROR: token does not match or is expired";
            header('Location: forgot_password.php');
            exit();
        }
    }

    if(isset($_POST["password"])) {
        if($_POST["password"] <> $_POST["retypePassword"]) {
            $_SESSION['errorMsg'] = "New and retyped passwords don't match";
        } else if(!validateInput()) {
            $_SESSION['errorMsg'] = "All fields are required";
        } else if(strlen($_POST["password"] ) < 8) {
            $_SESSION['errorMsg'] = "Password must be 8 characters";
        } else if(!preg_match("#[0-9]+#", $_POST["password"])) {
            $_SESSION['errorMsg'] = "Password must include at least one number";
        } else if(!preg_match("#[a-z]+#", $_POST["password"])) {
            $_SESSION['errorMsg'] = "Password must include at least one lower case letter";
        } else if(!preg_match("#[A-Z]+#", $_POST["password"])) {
            $_SESSION['errorMsg'] = "Password must include at least one upper case letter";
        } else if(!preg_match("~[!@$#%^&_+=]+~", $_POST["password"])) {
            $_SESSION['errorMsg'] = "Password must include one of the following characters: !@$#%^&_+=";
        } else if(saveUser()) {
            $msg = "Your profile has been updated!<br/><a href='/index.html'>Login</a>";
        }
    }

    function validateInput() {
        $valid = false;
        if(isset($_POST["loginId"])
            && isset($_POST["name"])
            && isset($_POST["password"])
            && isset($_POST["email"])
            && isset($_POST["userType"])
            && isset($_POST["retypePassword"]))
        {
            $valid = true;
        }
        return $valid;
    }
    
?>
    <title>Petitioner - Reset Password</title>
    <link rel="stylesheet" href="<?php echo $cssLocation ?>styles.css">
    <script>
        
        function populateForm() {
            document.getElementById("id").value = <?php echo $_SESSION['userid'] ?>;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("loginId").value = record.loginId;
                    document.getElementById("name").value = record.name;
                    document.getElementById("userType").value = record.userType;
                    document.getElementById("email").value = record.email;
                }
                document.getElementById("password").focus();
            };
            xmlhttp.open("GET", "get_user.php?id=" + <?php echo $_SESSION['userid'] ?>, true);
            xmlhttp.send();
        }

        function testMatch() {
            var password = document.getElementById("password").value;
            var retype = document.getElementById("retypePassword");
            if (password == retype.value) {
                retype.style.color = "black";
            } else {
                retype.style.color = "red";
            }
        }

    </script>
</head>

<body onload="populateForm()">
<?php
    $page = 'updateProfile';
    if(isset($_SESSION['errorMsg'])) {
        $msg = $_SESSION['errorMsg'];
        unset($_SESSION['errorMsg']);
        $msgClass = "error";
    } else {
        if ($msg != "") $msgClass = "info";
    }
?>
    <div class="<?php echo $msgClass ?>" ><?php echo $msg ?></div>
<?php if($msg == "" || $msg == "You must change your password.") : ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="loginId">Login Id</label>
                    <div class="propertyInput">
                        <input id="loginId" name="loginId"/>
                    </div>
                </div>
                <div class="property">
                    <label for="name">User Name</label>
                    <div class="propertyInput">
                        <input id="name" name="name"/>
                    </div>
                </div>
                <div class="property">
                    <label for="password">New Password</label>
                    <div class="propertyInput">
                        <input id="password" name="password" type="password"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@$#%^&_+=]).{8,}" 
                            title="Must contain at least 8 or more characters including at least oneof each: number, uppercase letter, lowercase letter, and one symbol: !@$#%^&_+="
                            required />
                    </div>
                </div>
                <div class="property">
                    <label for="retypePassword">Retype New Password</label>
                    <div class="propertyInput">
                        <input id="retypePassword" name="retypePassword" type="password" onkeyup="testMatch()" 
                            title="Must match the password entered above" required/>
                    </div>
                </div>
                <div class="property">
                    <label for="email">Email</label>
                    <div class="propertyInput">
                        <input id="email" name="email"/>
                    </div>
                </div>
                <input type="hidden" id="id" name="id" />
                <input type="hidden" id="userType" name="userType" />
                <p class="forgot" align="center" >For help, email<br/><?php echo $contact ?></p>
            </div>
            <Button>Save Changes</Button>
        </div>
    </form>
<?php
    include 'includes/password_validation.php';
?>
    <script>
        pwd.onkeyup = function() {
            testMatch();
            validatePassword();
        }
    </script>
<?php endif; ?>
</body>

</html>