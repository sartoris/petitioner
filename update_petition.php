<html>

<head>
    <?php
        include 'includes/header.php';
    ?>
    <title>Petitioner - Update Petition</title>
    <script>
        var countyRequiredMessage = "Valid County is required when checking in a petition";
        var signatureCountWrong = "Signature count must be between 0 and 15";

        function toggleCheckedIn() {
            if (document.getElementById("circulatorID").value == 0) {
                document.getElementById("isCheckedIn").disabled = true;
            } else {
                document.getElementById("isCheckedIn").disabled = false;
            }
            toggleCountyRequired();
        }

        function toggleCountyRequired() {
            var county = document.getElementById("county");
            if (county.value == "--" && (
                    document.getElementById("isCheckedIn").checked == true ||
                    document.getElementById("signatureCount").value > 0
                )) {
                county.setCustomValidity(countyRequiredMessage);
            } else {
                county.setCustomValidity("");
            }
        }

        function toggle15signatureMax() {
            var signatureCount = document.getElementById("signatureCount");
            if (signatureCount.value < 0 ||  signatureCount.value > 15) {
                signatureCount.setCustomValidity(signatureCountWrong);
            } else {
                signatureCount.setCustomValidity("");
            }
            toggleCountyRequired();
        }

        function resetControls() {
            document.getElementById("county").disabled = true;
            document.getElementById("county").value = "--";
            document.getElementById("petitionName").disabled = true;
            document.getElementById("petitionName").value = "";
            document.getElementById("circulatorID").disabled = true;
            document.getElementById("circulatorID").value = 0;
            document.getElementById("signatureCount").disabled = true;
            document.getElementById("signatureCount").value = 0;
            document.getElementById("isCheckedIn").disabled = true;
            document.getElementById("isCheckedIn").value = false;
            document.getElementById("comments").disabled = true;
            document.getElementById("comments").value = "";
            document.getElementById("submit").disabled = true;
        }
        
        function petitionNumberEntered() {
            var petitionNumber = document.getElementById("petitionNumber").value;
            if(petitionNumber.length == 6) {
                getPetitionData(petitionNumber);
            }
        }

        function petitionNumberKeyed(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // overide submit
                petitionNumberEntered();
            } else {
                resetControls();
            }
        }

        function petitionNumberKeydown(event) {
            if (event.key === "Tab") {
                event.preventDefault(); // overide tab
                petitionNumberEntered();
            }
        }

        function getPetitionData(petitionNumber) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    if (record.comments === undefined) {
                        document.getElementById("error").innerText = "Record not found";
                    } else {
                        document.getElementById("error").innerText = "";
                        document.getElementById("petitionName").value = record.petitionName;
                        document.getElementById("petitionName").disabled = false;
                        document.getElementById("county").value = !record.county ? "--" : record.county;
                        document.getElementById("county").disabled = false;
                        document.getElementById("circulatorID").value = !record.circulatorID ? 0 : record.circulatorID;
                        document.getElementById("circulatorID").disabled = false;
                        document.getElementById("signatureCount").value = record.signatureCount;
                        document.getElementById("signatureCount").disabled = false;
                        document.getElementById("isCheckedIn").checked = (record.isCheckedIn == 1);
                        document.getElementById("isCheckedIn").disabled = false;
                        document.getElementById("comments").value = record.comments;
                        document.getElementById("comments").disabled = false;
                        toggleCheckedIn();
                        toggleCountyRequired();
                        document.getElementById("submit").disabled = false;
                    }
                }
            };
            xmlhttp.open("GET", "get_petition.php?petitionNumber=" + petitionNumber, true);
            xmlhttp.send();
        }

        function onLoad() {
            var urlParams = <?php echo json_encode($_GET, JSON_HEX_TAG);?>;
            if(urlParams.id != undefined && urlParams.id.length == 6) {
                document.getElementById("petitionNumber").value = urlParams.id;
                getPetitionData(urlParams.id);
            } else {
                resetControls();
            }
            var petitionNumber = document.getElementById("petitionNumber");
            petitionNumber.addEventListener("keypress", petitionNumberKeyed, false);
            petitionNumber.addEventListener("keydown", petitionNumberKeydown, false);
            var circulatorID = document.getElementById("circulatorID");
            circulatorID.addEventListener("change", toggleCheckedIn, false);
            var isCheckedIn = document.getElementById("isCheckedIn");
            isCheckedIn.addEventListener("change", toggleCountyRequired, false);
            var county = document.getElementById("county");
            county.addEventListener("change", toggleCountyRequired, false);
            var signatureCount = document.getElementById("signatureCount");
            signatureCount.addEventListener("change", toggle15signatureMax, false);
            document.getElementById("petitionNumber").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <?php
        $page = 'updatePetition';
        include 'includes/navbar.php';
    ?>
    <form action="save_petitions.php" method="post">
        <input name="referrer" type="hidden" value="update_petition.php" />
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="petitionNumber">Petition Number</label>
                    <div class="propertyInput">
                        <input id="petitionNumber" name="petitionNumber" style="width:8ch"  maxlength="6" />
                        <font id="error" class="error"></font>
                    </div>
                </div>
                <div class="property">
                    <label for="petitionName">Petition Name</label>
                    <div class="propertyInput">
                        <select id="petitionName" name="petitionName">
                            <?php echo getPetitionNames("");?>
                        </select> 
                    </div>
                </div>
                <div class="property">
                    <label for="circulatorID">Circulator</label>
                    <div class="propertyInput">
                        <select id="circulatorID" name="circulatorID" >
                            <?php echo getCirculators(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="county">County Signatures are for</label>
                    <div class="propertyInput">
                        <select id="county" name="county">
                            <?php echo getCounties("");?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="signatureCount">Number of signatures on Petition</label>
                    <div class="propertyInput">
                        <input id="signatureCount" name="signatureCount" type="text" inputmode="numeric" class="numericInput"/>
                    </div>
                </div>
                <div class="property">
                    <label for="isCheckedIn" >Checked In?</label>
                    <div class="propertyInput">
                        <input id="isCheckedIn" name="isCheckedIn" type="checkbox" width=10px disabled="disabled"/>
                    </div>
                </div>
                <div class="property">
                    <label for="comments" >Comments</label>
                    <div class="propertyInput">
                        <textarea id="comments" name="comments" style="width:100%"></textarea>
                    </div>
                </div>
            </div>
            <button id="submit" disabled>Update Petition</button>
        </div>
    </form>
</body>

</html>
