<html>

<head>
<?php
    include 'includes/header.php';
    $msg = "";
    if(isset($_SESSION['errorMsg'])) {
        $msg = $_SESSION['errorMsg'];
        unset($_SESSION['errorMsg']);
    }
?>
    <title>Petitioner - Add User</title>
    <script language="javascript">

        function onLoad() {
            document.getElementById("loginId").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'addUser';
    include 'includes/navbar.php';
?>
    <div class="error" align="center" ><?php echo $msg ?></div>
    <form action='save_user.php' method='post'>
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
                    <label for="password">Password</label>
                    <div class="propertyInput">
                        <input id="password" name="password" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                    </div>
                </div>
                <div class="property">
                    <label for="email">Email</label>
                    <div class="propertyInput">
                        <input id="email" name="email"/>
                    </div>
                </div>
                <div class="property">
                    <label for="userType">User Type</label>
                    <div class="propertyInput">
                        <select id="userType" name="userType">
                            <option value="Admin" selected>Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
            </div>
            <Button>Add User</Button>
        </div>
    </form>
<?php
    include 'includes/password_validation.php';
?>
</body>

</html>
