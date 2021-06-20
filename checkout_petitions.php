<html>

<head>
    <?php
        include 'includes/header.php';
    ?>
    <title>Petitioner - Bulk Checkout</title>
    <script>

        function disableControls(disable) {
            document.getElementById('coordinatorid').disabled = disable;
            document.getElementById('coordinatorid').value = 0;
            document.getElementById('depotid').disabled = disable;
            document.getElementById('depotid').value = 0;
            document.getElementById('ambassadorid').disabled = disable;
            document.getElementById('ambassadorid').value = 0;
            document.getElementById('circulatorid').disabled = disable;
            document.getElementById('circulatorid').value = 0;
            document.getElementById('submitButton').disabled = true;
        }

        function petitionNumbersEntered() {
            var petitionNumbers = document.getElementById('petitionNumbers').value;
            getPetitions(petitionNumbers);
        }

        function petitionNumbersKeyed(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // overide submit
                petitionNumbersEntered();
            } else {
                disableControls(true);
            }
        }

        function petitionNumbersKeydown(event) {
            if (event.key === "Tab") {
                event.preventDefault(); // overide submit
                petitionNumbersEntered();
            }
        }

        function updateControls() {
            var selectedCount=0;
            if(document.getElementById('coordinatorid').value != 0) {
                selectedCount+=1;
                document.getElementById('depotid').disabled = true;
                document.getElementById('ambassadorid').disabled = true;
                document.getElementById('circulatorid').disabled = true;
            }
            if(document.getElementById('depotid').value != 0) {
                selectedCount+=1;
                document.getElementById('coordinatorid').disabled = true;
                document.getElementById('ambassadorid').disabled = true;
                document.getElementById('circulatorid').disabled = true;
            }
            if(document.getElementById('ambassadorid').value != 0) {
                selectedCount+=1;
                document.getElementById('depotid').disabled = true;
                document.getElementById('coordinatorid').disabled = true;
                document.getElementById('circulatorid').disabled = true;
            }
            if(document.getElementById('circulatorid').value != 0) {
                selectedCount+=1;
                document.getElementById('depotid').disabled = true;
                document.getElementById('coordinatorid').disabled = true;
                document.getElementById('ambassadorid').disabled = true;
            }
            if (selectedCount == 0) {
                disableControls(false);
            }
            document.getElementById('submitButton').disabled = selectedCount != 1;
        }

        function getPetitions(petitionNumbers) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("bulkList").value = record.petitionList;
                    document.getElementById("error").innerText = record.error;
                    document.getElementById("count").innerText = record.count;
                    if (record.error != "")
                        disableControls(true);
                    else
                        disableControls(false);
                }
            };
            xmlhttp.open("GET", "get_petitions.php?petitionNumbers=" + petitionNumbers, true);
            xmlhttp.send();
        }

        function onLoad() {
            document.getElementById("petitionNumbers").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <?php
        $page = 'checkoutPetition';
        include 'includes/navbar.php';
    ?>
    <form action='save_petitions.php' method='post'>
        <input id="bulkList" name="bulkList" type="hidden" />
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="petitionNumbers">Enter Petition Number(s)</label>
                    <div class="propertyInput">
                        <input id="petitionNumbers" name="petitionNumbers" type="text" value="" onkeypress="petitionNumbersKeyed(event)" onkeydown="petitionNumbersKeydown(event)"/>
                        <font class="mandatoryField">*</font>
                        <label>(ex: A05004,B05100-B06125)</label><br/>
                    </div>
                    <label id="error" name="error" style="color:red"></label><br/>
                </div>
                <div class="property">
                    <label>Count:</label>
                    <div class="propertyInput">
                        <label id="count" name="count"></label>
                    </div>
                </div>
                <div class="property">
                    <label><b><u>Check Out To:</u></b></label>
                    <div class="propertyInput">
                        <label> </label>
                    </div>
                </div>
                <div class="property">
                    <label for="coordinatorid">Coordinator</label>
                    <div class="propertyInput">
                        <select id="coordinatorid" name="coordinatorid" disabled="true" onchange="updateControls()" >
                            <?php echo getCoordinators(0);?>
                        </select>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label> </label>
                    <div class="propertyInput">OR</div>
                </div>
                <div class="property">
                    <label for="depotid">Depot</label>
                    <div class="propertyInput">
                        <select id="depotid" name="depotid" disabled="true" onchange="updateControls()">
                            <?php echo getDepots(0);?>
                        </select> 
                        <font class="mandatoryField">*</font>
                   </div>
                </div>
                <div class="property">
                    <label> </label>
                    <div class="propertyInput">OR</div>
                </div>
                <div class="property">
                    <label for="ambassadorid">Ambassador</label>
                    <div class="propertyInput">
                        <select id="ambassadorid" name="ambassadorid" disabled="true" onchange="updateControls()">
                            <?php echo getAmbassadors(0);?>
                        </select>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
                <div class="property">
                    <label> </label>
                    <div class="propertyInput">OR</div>
                </div>
                <div class="property">
                    <label for="circulatorid">Circulator</label>
                    <div class="propertyInput">
                        <select id="circulatorid" name="circulatorid" disabled="true" onchange="updateControls()">
                            <?php echo getCirculators(0);?>
                        </select>
                        <font class="mandatoryField">*</font>
                    </div>
                </div>
            </div>
            <div style="color:red; text-align: right;">* mandatory fields</div>
            <Button id="submitButton" disabled="true">Bulk Checkout</Button>
        </div>
    </form>
</body>

</html>
