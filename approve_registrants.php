<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Approve Registrations</title>
    <script>
        function populateForm() {
            var id = document.getElementById("id").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("firstName").value = record.firstName;
                    document.getElementById("lastName").value = record.lastName;
                    document.getElementById("county").value = record.county;
                    document.getElementById("city").value = record.city;
                    document.getElementById("zip").value = record.zip;
                    document.getElementById("email").value = record.email;
                    document.getElementById("phone").value = record.phone;
                }
            };
            xmlhttp.open("GET", "get_contact.php?id=" + id, true);
            xmlhttp.send();
        }

<?php
    include 'includes/phone_formatter.js';
?>

        function onLoad() {
            onLoadPhoneEmailFormatter();
            document.getElementById("id").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'approveRegistrants';
    include 'includes/navbar.php';
?>
    <form action='save_contact.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="id">Select Contact</label>
                    <div class="propertyInput">
                        <select id="id" name="id" onchange="populateForm()" >
                            <?php echo getPendingContacts(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="firstName">First Name</label>
                    <div class="propertyInput">
                        <input id="firstName" name="firstName" value="" required/>
                    </div>
                </div>
                <div class="property">
                    <label for="lastName">Last Name</label>
                    <div class="propertyInput">
                        <input id="lastName" name="lastName" value="" required/>
                    </div>
                </div>
                <div class="property">
                    <label></label>
                    <div class="propertyInput">
                        <label>Contacts require a 10 digit phone number and/or email address</label>
                    </div>
                </div>
                <div class="property">
                    <label for="email">Email</label>
                    <div class="propertyInput">
                        <input id="email" name="email" value="" type="email"/>
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
                        <select id="county" name="county">
                            <?php echo getCounties('NA');?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="city">City</label>
                    <div class="propertyInput">
                        <input id="city" name="city" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="zip">Zip</label>
                    <div class="propertyInput">
                        <input id="zip" name="zip" value="" required pattern="\d{5}" title="must be 5 digits"/>
                    </div>
                </div>
            </div>
            <Button>Save Registrant</Button>
            <Button id="delete" name="delete">Delete Registrant</Button>
        </div>
    </form>
</body>

</html>