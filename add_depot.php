<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Add Depot</title>
    <script language="javascript">
<?php
    include 'includes/phone_formatter.js';
?>

        function onLoad() {
            var phone = document.getElementById("phone");
            phone.addEventListener('keypress', phoneKeyPress, false);
            phone.addEventListener('keydown', phoneKeyDown, false);
            phone.addEventListener('focus', phoneOnfocus, false);
            phone.addEventListener('click', phoneClick, false);
            resetPhone(phone);
            document.getElementById("name").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'addDepot';
    include 'includes/navbar.php';
?>
    <form action='save_depot.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="name">Name</label>
                    <div class="propertyInput">
                        <input id="name" name="name"/>
                    </div>
                </div>
                <div class="property">
                    <label for="street1">Street Address 1</label>
                    <div class="propertyInput">
                        <input id="street1" name="street1"/>
                    </div>
                </div>
                <div class="property">
                    <label for="street2">Street Address 2</label>
                    <div class="propertyInput">
                        <input id="street2" name="street2"/>
                    </div>
                </div>
                <div class="property">
                    <label for="city">City</label>
                    <div class="propertyInput">
                        <input id="city" name="city"/>
                    </div>
                </div>
                <input id="state" name="state" type="hidden" value="Arizona" />
                <div class="property">
                    <label for="zip">Zip</label>
                    <div class="propertyInput">
                        <input id="zip" name="zip"/>
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
                    <label for="phone">Phone</label>
                    <div class="propertyInput">
                        <input id="phone" name="phone" type="text" pattern="\(\d{3}\)\d{3}-\d{4}|\(___\)___-____"/>
                    </div>
                </div>
                <div class="property">
                    <label for="email">Email</label>
                    <div class="propertyInput">
                        <input id="email" name="email" type="email"/>
                    </div>
                </div>
                <div class="property">
                    <label for="hours">Hours of Operation</label>
                    <div class="propertyInput">
                        <input id="hours" name="hours"/>
                    </div>
                </div>
                <div class="property">
                    <label for="contactId">Contact</label>
                    <div class="propertyInput">
                        <select id="contactId" name="contactId" >
                            <?php echo getContacts(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="checkOutPetitions">Check Out Petitions</label>
                    <div class="propertyInput">
                         <input id="checkOutPetitions" name="checkOutPetitions" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="submitCompletedPetitions">Submit Completed Petitions</label>
                    <div class="propertyInput">
                         <input id="submitCompletedPetitions" name="submitCompletedPetitions" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="notaryAvailable">Notary Available</label>
                    <div class="propertyInput">
                         <input id="notaryAvailable" name="notaryAvailable" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="notaryHours">Notary Schedule</label>
                    <div class="propertyInput">
                        <input id="notaryHours" name="notaryHours"/>
                    </div>
                </div>
                <div class="property">
                    <label for="notes">Notes</label>
                    <div class="propertyInput">
                        <textarea style="width:100%; height:100px" id="notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="property">
                    <label for="internalNotes">Internal Notes (not for publication)</label>
                    <div class="propertyInput">
                        <textarea style="width:100%; height:100px" id="internalNotes" name="internalNotes"></textarea>
                    </div>
                </div>
            </div>
            <Button>Add Depot</Button>
        </div>
    </form>
</body>

</html>
