<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Update Depot</title>
    <script>
        function resetControls() {
            document.getElementById("name").disabled = true;
            document.getElementById("name").value = "";
            document.getElementById("street1").disabled = true;
            document.getElementById("street1").value = "";
            document.getElementById("street2").disabled = true;
            document.getElementById("street2").value = "";
            document.getElementById("city").disabled = true;
            document.getElementById("city").value = "";
            document.getElementById("county").disabled = true;
            document.getElementById("county").value = "";
            document.getElementById("zip").disabled = true;
            document.getElementById("zip").value = "";
            document.getElementById("phone").disabled = true;
            document.getElementById("phone").value = "(___)___-____";
            document.getElementById("email").disabled = true;
            document.getElementById("email").value = "";
            document.getElementById("hours").disabled = true;
            document.getElementById("hours").value = "";
            document.getElementById("notaryHours").disabled = true;
            document.getElementById("notaryHours").value = "";
            document.getElementById("contactId").disabled = true;
            document.getElementById("contactId").value = 0;
            document.getElementById("checkOutPetitions").disabled = true;
            document.getElementById("checkOutPetitions").checked = false;
            document.getElementById("submitCompletedPetitions").disabled = true;
            document.getElementById("submitCompletedPetitions").checked = false;
            document.getElementById("notaryAvailable").disabled = true;
            document.getElementById("notaryAvailable").checked = false;
            document.getElementById("notes").disabled = true;
            document.getElementById("notes").value = "";
            document.getElementById("internalNotes").disabled = true;
            document.getElementById("internalNotes").value = "";
            document.getElementById("submit").disabled = true;
            document.getElementById("delete").disabled = true;
            document.getElementById("id").focus();
        }
        
        function populateForm() {
            var id = document.getElementById("id").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("name").value = record.name;
                    document.getElementById("name").disabled = false;
                    document.getElementById("street1").value = record.street1;
                    document.getElementById("street1").disabled = false;
                    document.getElementById("street2").value = record.street2;
                    document.getElementById("street2").disabled = false;
                    document.getElementById("city").value = record.city;
                    document.getElementById("city").disabled = false;
                    document.getElementById("county").value = record.county;
                    document.getElementById("county").disabled = false;
                    document.getElementById("zip").value = record.zip;
                    document.getElementById("zip").disabled = false;
                    document.getElementById("phone").value = record.phone;
                    document.getElementById("phone").disabled = false;
                    document.getElementById("email").value = record.email;
                    document.getElementById("email").disabled = false;
                    document.getElementById("hours").value = record.hours;
                    document.getElementById("hours").disabled = false;
                    document.getElementById("notaryHours").value = record.notaryHours;
                    document.getElementById("notaryHours").disabled = false;
                    document.getElementById("contactId").value = record.contactId;
                    document.getElementById("contactId").disabled = false;
                    document.getElementById("checkOutPetitions").checked = (record.checkOutPetitions == 1);
                    document.getElementById("checkOutPetitions").disabled = false;
                    document.getElementById("submitCompletedPetitions").checked = (record.submitCompletedPetitions == 1);
                    document.getElementById("submitCompletedPetitions").disabled = false;
                    document.getElementById("notaryAvailable").checked = (record.notaryAvailable == 1);
                    document.getElementById("notaryAvailable").disabled = false;
                    document.getElementById("notes").value = record.notes;
                    document.getElementById("notes").disabled = false;
                    document.getElementById("internalNotes").value = record.internalNotes;
                    document.getElementById("internalNotes").disabled = false;
                    document.getElementById("submit").disabled = false;
                    document.getElementById("delete").disabled = false;
                    document.getElementById("name").focus();
                }
            };
            xmlhttp.open("GET", "get_depot.php?id=" + id, true);
            xmlhttp.send();
        }

        function depotChanged(event) {
            var id = document.getElementById("id").value;
            if(id == 0)
                resetControls();
            else
                populateForm();
        }
        
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
            var id = document.getElementById("id");
            id.addEventListener("change", depotChanged, false);
            resetControls();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'updateDepot';
    include 'includes/navbar.php';
?>
    <form action='save_depot.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="id">Select Depot, Ambassador or Organizational Meeting</label>
                    <div class="propertyInput">
                        <select id="id" name="id">
                            <?php echo getDepots(0);?>
                        </select>
                    </div>
                </div>
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
                        <input id="phone" name="phone" type="text" pattern="\(\d{3}\)\d{3}-\d{4}|\(___\)___-____" />
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
                    <label for="notarySchedule">Notary Schedule</label>
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
            <Button id="submit">Save Changes</Button>
            <Button id="delete" name="delete">Delete Depot</Button>
        </div>
    </form>
</body>

</html>
