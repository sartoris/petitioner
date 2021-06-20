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
    <title>Petitioner - Update User</title>
    <script>
        function populateForm() {
            var id = document.getElementById("id").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("loginId").value = record.loginId;
                    document.getElementById("name").value = record.name;
                    document.getElementById("email").value = record.email;
                    document.getElementById("password").value = record.password;
                    document.getElementById("userType").value = record.userType;
                    document.getElementById("name").focus();
                }
            };
            xmlhttp.open("GET", "get_user.php?id=" + id, true);
            xmlhttp.send();
        }
        function onLoad() {
            document.getElementById("id").focus();
        }        
    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'updateUser';
    include 'includes/navbar.php';
?>
    <div class="error" align="center" ><?php echo $msg ?></div>
    <form action='save_user.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="id">Users</label>
                    <div class="propertyInput">
                        <select id="id" name="id" onchange="populateForm()" >
                            <?php echo getUsers(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="loginId">Login Id</label>
                    <div class="propertyInput">
                        <input id="loginId" name="loginId" readonly/>
                    </div>
                </div>
                <div class="property">
                    <label for="name">Name</label>
                    <div class="propertyInput">
                        <input id="name" name="name"/>
                    </div>
                </div>
                <div class="property">
                    <label for="password">Password</label>
                    <div class="propertyInput">
                        <input id="password" name="password" type="password"
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
                            <option value="Admin">Admin</option>
                            <option value="User" selected>User</option>
                        </select>
                    </div>
                </div>
            </div>
            <Button>Save Changes</Button>
            <Button id="delete" name="delete">Delete User</Button>
        </div>
    </form>
<?php
    include 'includes/password_validation.php';
?>
</body>

</html>
