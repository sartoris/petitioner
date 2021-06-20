<html>
    <head>
        <?php
            session_start();
            require_once 'includes/site.cfg';
            $showForm = 0;
            $msg = "Enter the email address associated with your Login ID.";
            if (isset($_SESSION['errorMsg'])) {
                $msg = $_SESSION['errorMsg'];
                unset($_SESSION['errorMsg']);
            } else if (isset($_POST['user_email'])) {
                include 'includes/db_user.php';
                $result = sendForgotEmail($_POST['user_email']);
                if ($result=="") {
                    $result = "Email has been sent - Please click on the link in the email to confirm.";
                }
                $msg = $result;
            } else {
                $showForm = 1;
            }
        ?>
        <link rel="stylesheet" href="<?php echo $cssLocation ?>styles.css">
        <title><?php echo $organization ?> - Forgot Password</title>
    </head>
    <body>
        <div class="info"><?php echo $msg ?></div>
<?php if($showForm == 1) : ?>
        <form method="post" target="_self">
            <div class="main">
                <div class ="properties">
                    <div class="property">
                        <label for="email">Email</label>
                        <div class="propertyInput">
                            <input type="email" name="user_email"/>
                        </div>
                    </div>
                </div>
                <Button>Reset Password</Button>
            </div>
        </form>
<?php endif; ?>
    </body>
</html>