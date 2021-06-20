<html>

<head>
<?php
    include 'includes/header.php';
    include 'includes/db_user.php';
    $msg = "";
    $msgClass = "noMsg";
    
    if(isset($_POST["resetPassword"])) {
        header('Location: reset_password.php');
    } else if(isset($_POST["save"]) && saveUserBasic()) {
        $msg = "Your profile has been updated!";
    }

    function validateInput() {
        $valid = false;
        if(
            isset($_POST["loginId"])
            && isset($_POST["name"])
            && isset($_POST["email"])
            && isset($_POST["userType"])
        )
        {
            $valid = true;
        }
        return $valid;
    }
    
?>
    <title>Petitioner - Update Profile</title>
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
                    document.getElementById("name").focus();
                }
            };
            xmlhttp.open("GET", "get_user.php?id=" + <?php echo $_SESSION['userid'] ?>, true);
            xmlhttp.send();
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
        if ($msg != "") {
            $msgClass = "info";
        }
        include 'includes/navbar.php';
    }
?>
    <div class="<?php echo $msgClass ?>" ><?php echo $msg ?></div>
<?php if($msg == "") : ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="loginId">Login Id</label>
                    <div class="propertyInput">
                        <input id="loginId" name="loginId" readonly/>
                    </div>
                </div>
                <div class="property">
                    <label for="name">User Name</label>
                    <div class="propertyInput">
                        <input id="name" name="name"/>
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
            <Button name="save">Save Changes</Button>
            <Button name="resetPassword">Reset Password</Button>
        </div>
    </form>
<?php endif; ?>
</body>

</html>
