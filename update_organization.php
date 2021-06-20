<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Update Organization</title>
    <script>
        function populateForm() {
            var id = document.getElementById("id").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var record = JSON.parse(this.responseText);
                    document.getElementById("name").value = record.name;
                    document.getElementById("contactId").value = record.contactId;
                    document.getElementById("endorsement").checked = (record.endorsement == 1);
                    document.getElementById("notes").value = record.notes;
                    document.getElementById("name").focus();
                }
            };
            xmlhttp.open("GET", "get_organization.php?id=" + id, true);
            xmlhttp.send();
        }

        function onLoad() {
            document.getElementById("id").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'updateOrganization';
    include 'includes/navbar.php';
?>
    <form action='save_organization.php' method='post'>
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="id">Select Organization</label>
                    <div class="propertyInput">
                        <select id="id" name="id" onchange="populateForm()">
                            <?php echo getOrganizations(0);?>
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
                    <label for="contactId">Contact</label>
                    <div class="propertyInput">
                        <select id="contactId" name="contactId" >
                            <?php echo getContacts(0);?>
                        </select>
                    </div>
                </div>
                <div class="property">
                    <label for="endorsement">Formal Endorsement</label>
                    <div class="propertyInput">
                         <input id="endorsement" name="endorsement" type="checkbox"/>
                    </div>
                </div>
                <div class="property">
                    <label for="notes">Notes</label>
                    <div class="propertyInput">
                        <textarea style="width:100%; height:100px" id="notes" name="notes"></textarea>
                    </div>
                </div>
            </div>
            <Button>Save Changes</Button>
            <Button id="delete" name="delete">Delete Organization</Button>
        </div>
    </form>
</body>

</html>
