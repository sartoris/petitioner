<html>

<head>
<?php
    include 'includes/db.php';
?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?php echo $cssLocation ?>styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="<?php echo $icon ?>"/>
    <noscript>You must enable JavaScript to run this application.</noscript>
    <title><?php echo $organization ?> - Self Registration</title>
    <script language="javascript">
<?php
    include 'includes/phone_formatter.js';
?>

        function onLoad() {
            onLoadPhoneEmailFormatter();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <form action='registration.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="firstName">First Name</label>
                    <div class="propertyInput">
                        <input id="firstName" name="firstName" required/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="lastName">Last Name</label>
                    <div class="propertyInput">
                        <input id="lastName" name="lastName" required/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label></label>
                    <div class="propertyInput">
                        <label>Registration requires a 10 digit phone number and/or email address</label>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="email">Email</label>
                    <div class="propertyInput">
                        <input id="email" name="email" type="email"/>
                    </div>
                </div>
                <div class="property">
                    <label for="phone">Phone</label>
                    <div class="propertyInput">
                        <input id="phone" name="phone" type="text" pattern="\(\d{3}\)\d{3}-\d{4}|\(___\)___-____"/>
                    </div>
                </div>
                <div class="property">
                    <label for="county">County</label>
                    <div class="propertyInput">
                        <select id="county" name="county" required>
                            <?php echo getMandatoryCounties('');?>
                        </select>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="city">City</label>
                    <div class="propertyInput">
                        <input id="city" name="city"/>
                    </div>
                </div>
                <div class="property">
                    <label for="zip">Zip</label>
                    <div class="propertyInput">
                        <input id="zip" name="zip" required pattern="\d{5}" title="must be 5 digits"/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
            </div>
            <div style="color:red; text-align: right;">* mandatory fields</div>
            <p class="info" align="center" >For login issues, email <br/><?php echo $contact ?></p>
            <Button>Register!</Button>
        </div>
    </form>
</body>

</html>
