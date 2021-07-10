<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Add Contact</title>
    <script language="javascript">
<?php
    include 'includes/phone_formatter.js';
?>

        function onLoad() {
            onLoadPhoneEmailFormatter();
            document.getElementById("firstName").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'addContact';
    include 'includes/navbar.php';
?>
    <form action='save_contact.php' method='post'>
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
                    <label for="initial">Middle Initial</label>
                    <div class="propertyInput">
                        <input id="initial" name="initial"/>
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
                        <input id="zip" name="zip" required pattern="\d{5}" title="must be 5 digits"/>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label for="county">Circulator Home County</label>
                    <div class="propertyInput">
                        <select id="county" name="county">
                            <?php echo getCounties('');?>
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
                        <input id="circulatorID" name="circulatorID"/>
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
                    <label for="hoursOfAvailability">Hours of Availability</label>
                    <div class="propertyInput">
                        <input id="hoursOfAvailability" name="hoursOfAvailability"/>
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
                        <input id="isCoordinator" name="isCoordinator" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="isDepotcontact">Depot Contact</label>
                    <div class="propertyInput">
                        <input id="isDepotcontact" name="isDepotcontact" type="checkbox" />
                    </div>
                </div>
                <div class="property">
                    <label for="depotSite">Depot Site</label>
                    <div class="propertyInput">
                        <select id="depotID" name="depotID">
                            <?php echo getDepots(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="notary">Notary</label>
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
                        <textarea style="width:100%; height:100px" id="notes" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <div style="color:red; text-align: right;">* mandatory fields</div>
            <Button>Add Contact</Button>
        </div>
    </form>
</body>

</html>
