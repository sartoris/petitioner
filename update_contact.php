<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Update Contact</title>
    <script>

        function resetControls() {
            document.getElementById("firstName").disabled = true;
            document.getElementById("firstName").value = "";
            document.getElementById("lastName").disabled = true;
            document.getElementById("lastName").value = "";
            document.getElementById("initial").disabled = true;
            document.getElementById("initial").value = "";
            document.getElementById("street1").disabled = true;
            document.getElementById("street1").value = "";
            document.getElementById("street2").disabled = true;
            document.getElementById("street2").value = "";
            document.getElementById("city").disabled = true;
            document.getElementById("city").value = "";
            document.getElementById("state").disabled = true;
            document.getElementById("state").value = "";
            document.getElementById("county").disabled = true;
            document.getElementById("county").value = "";
            document.getElementById("zip").disabled = true;
            document.getElementById("zip").value = "";
            document.getElementById("email").disabled = true;
            document.getElementById("email").value = "";
            document.getElementById("phone").disabled = true;
            document.getElementById("phone").value = "(___)___-____";
            document.getElementById("phonetype").disabled = true;
            document.getElementById("phonetype").value = "";
            document.getElementById("canText").disabled = true;
            document.getElementById("canText").checked = false;
            document.getElementById("legislativeDistrict").disabled = true;
            document.getElementById("legislativeDistrict").value = "";
            document.getElementById("PC").disabled = true;
            document.getElementById("PC").value = 0;
            document.getElementById("notes").disabled = true;
            document.getElementById("notes").value = "";
            document.getElementById("circulatorID").disabled = true;
            document.getElementById("circulatorID").value = 0;
            document.getElementById("organizationID").disabled = true;
            document.getElementById("organizationID").value = 0;
            document.getElementById("hoursAvailable").disabled = true;
            document.getElementById("hoursAvailable").value = "";
            document.getElementById("isCoordinator").disabled = true;
            document.getElementById("isCoordinator").checked = false;
            document.getElementById("isAmbassador").disabled = true;
            document.getElementById("isAmbassador").checked = false;
            document.getElementById("isPetitioner").disabled = true;
            document.getElementById("isPetitioner").checked = false;
            document.getElementById("isDepotContact").disabled = true;
            document.getElementById("isDepotContact").checked = false;
            document.getElementById("depotID").disabled = true;
            document.getElementById("depotID").value = 0;
            document.getElementById("isNotary").disabled = true;
            document.getElementById("isNotary").checked = false;
            document.getElementById("isPersonOfInterest").disabled = true;
            document.getElementById("isPersonOfInterest").checked = false;
            document.getElementById("save").disabled = true;
            document.getElementById("delete").disabled = true;
            document.getElementById("id").focus();
        }
        
        function populateForm() {
            var id = document.getElementById("id").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("firstName").value = record.firstName;
                    document.getElementById("firstName").disabled = false;
                    document.getElementById("lastName").value = record.lastName;
                    document.getElementById("lastName").disabled = false;
                    document.getElementById("initial").value = record.middle;
                    document.getElementById("initial").disabled = false;
                    document.getElementById("street1").value = record.street1;
                    document.getElementById("street1").disabled = false;
                    document.getElementById("street2").value = record.street2;
                    document.getElementById("street2").disabled = false;
                    document.getElementById("city").value = record.city;
                    document.getElementById("city").disabled = false;
                    document.getElementById("state").value = record.state;
                    document.getElementById("state").disabled = false;
                    document.getElementById("county").value = record.county;
                    document.getElementById("county").disabled = false;
                    document.getElementById("zip").value = record.zip;
                    document.getElementById("zip").disabled = false;
                    document.getElementById("email").value = record.email;
                    document.getElementById("email").disabled = false;
                    document.getElementById("phone").value = record.phone;
                    document.getElementById("phone").disabled = false;
                    document.getElementById("phonetype").value = record.phonetype;
                    document.getElementById("phonetype").disabled = false;
                    document.getElementById("canText").checked = (record.canText == 1);
                    document.getElementById("canText").disabled = false;
                    document.getElementById("legislativeDistrict").value = record.legislativeDistrict;
                    document.getElementById("legislativeDistrict").disabled = false;
                    document.getElementById("PC").checked = (record.PC == 1);
                    document.getElementById("PC").disabled = false;
                    document.getElementById("notes").value = record.notes;
                    document.getElementById("notes").disabled = false;
                    document.getElementById("circulatorID").value = record.circulatorID;
                    document.getElementById("circulatorID").disabled = false;
                    document.getElementById("organizationID").value = record.organizationID;
                    document.getElementById("organizationID").disabled = false;
                    document.getElementById("hoursAvailable").value = record.hoursAvailable;
                    document.getElementById("hoursAvailable").disabled = false;
                    document.getElementById("isCoordinator").checked = (record.isCoordinator == 1);
                    document.getElementById("isCoordinator").disabled = false;
                    document.getElementById("isAmbassador").checked = (record.isAmbassador == 1);
                    document.getElementById("isAmbassador").disabled = false;
                    document.getElementById("isPetitioner").checked = (record.isPetitioner == 1);
                    document.getElementById("isPetitioner").disabled = false;
                    document.getElementById("isDepotContact").checked = (record.isDepotContact == 1);
                    document.getElementById("isDepotContact").disabled = false;
                    document.getElementById("depotID").value = record.depotID;
                    document.getElementById("depotID").disabled = false;
                    document.getElementById("isNotary").checked = (record.isNotary == 1);
                    document.getElementById("isNotary").disabled = false;
                    document.getElementById("isPersonOfInterest").checked = (record.isPersonOfInterest == 1);
                    document.getElementById("isPersonOfInterest").disabled = false;
                    document.getElementById("save").disabled = false;
                    document.getElementById("delete").disabled = false;
                    document.getElementById("firstName").focus();
                }
            };
            xmlhttp.open("GET", "get_contact.php?id=" + id, true);
            xmlhttp.send();
        }

        function contactChanged(event) {
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
            onLoadPhoneEmailFormatter();
            var id = document.getElementById("id");
            id.addEventListener("change", contactChanged, false);
            resetControls();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'updateContact';
    include 'includes/navbar.php';
?>
    <form action='save_contact.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="id">Select Contact</label>
                    <div class="propertyInput">
                        <select id="id" name="id" >
                            <?php echo getContacts(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="firstName">First Name</label>
                    <div class="propertyInput">
                        <input id="firstName" name="firstName" value="" required/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="lastName">Last Name</label>
                    <div class="propertyInput">
                        <input id="lastName" name="lastName" value="" required/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="initial">Middle Initial</label>
                    <div class="propertyInput">
                        <input id="initial" name="initial" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="street1">Street Address 1</label>
                    <div class="propertyInput">
                        <input id="street1" name="street1" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="street2">Street Address 2</label>
                    <div class="propertyInput">
                        <input id="street2" name="street2" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="city">City</label>
                    <div class="propertyInput">
                        <input id="city" name="city" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="state">State</label>
                    <div class="propertyInput">
                        <select id="state" name="state">
                            <?php echo getStates('NA');?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="zip">Zip</label>
                    <div class="propertyInput">
                        <input id="zip" name="zip" value="" required pattern="\d{5}" title="must be 5 digits"/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="county">Circulator Home County</label>
                    <div class="propertyInput">
                        <select id="county" name="county">
                            <?php echo getMandatoryCounties('');?>
                        </select>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label></label>
                    <div class="propertyInput">
                        <label>Contacts require a 10 digit phone number and/or email address</label>
                        <font class="mandatoryField">*</font>
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
                    <label for="phonetype">Phone Type</label>
                    <div class="propertyInput">
                        <select id="phonetype" name="phonetype">
                            <option value="cell" selected>Cell</option>
                            <option value="home">Home</option>
                            <option value="work">Work</option>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="canText">Can Text</label>
                    <div class="propertyInput">
                        <input id="canText" name="canText" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="legislativeDistrict">Legislative District</label>
                    <div class="propertyInput">
                    <select id="legislativeDistrict" name="legislativeDistrict">
                            <option value="NA" selected>NA</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="PC">PC</label>
                    <div class="propertyInput">
                        <input id="PC" name="PC" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="circulatorID">Registered Circulator ID</label>
                    <div class="propertyInput">
                        <input id="circulatorID" name="circulatorID" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="organizationID">Organization</label>
                    <div class="propertyInput">
                        <select id="organizationID" name="organizationID">
                            <?php echo getOrganizations(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="hoursAvailable">Hours of Availability</label>
                    <div class="propertyInput">
                        <input id="hoursAvailable" name="hoursAvailable" value=""/>
                    </div>
                </div>
                <div class="property">
                    <label for="isPetitioner">Circulator</label>
                    <div class="propertyInput">
                        <input id="isPetitioner" name="isPetitioner" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="isAmbassador">Petition Ambassador</label>
                    <div class="propertyInput">
                        <input id="isAmbassador" name="isAmbassador" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="isCoordinator">Coordinator</label>
                    <div class="propertyInput">
                        <input id="isCoordinator" name="isCoordinator" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="isDepotContact">Depot Contact</label>
                    <div class="propertyInput">
                        <input id="isDepotContact" name="isDepotContact" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="depotID">Depot Site</label>
                    <div class="propertyInput">
                        <select id="depotID" name="depotID">
                            <?php echo getDepots(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="isNotary">Notary</label>
                    <div class="propertyInput">
                        <input id="isNotary" name="isNotary" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="isPersonOfInterest">PersonOfInterest</label>
                    <div class="propertyInput">
                        <input id="isPersonOfInterest" name="isPersonOfInterest" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="notes">Notes</label>
                    <div class="propertyInput">
                        <textarea style="width:100%" id="notes" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div style="color:red; text-align: right;">* mandatory fields</div>
            <Button id="save">Save Changes</Button>
            <Button id="delete" name="delete">Delete Contact</Button>
        </div>
    </form>
</body>

</html>