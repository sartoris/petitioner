<html>

<head>
<?php
    include 'includes/header.php';
?>
    <title>Petitioner - Add Organization</title>
    <script language="javascript">

        function onLoad() {
            document.getElementById("name").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
<?php
    $page = 'addOrganization';
    include 'includes/navbar.php';
?>
    <form action='save_organization.php' method='post'>
        <div class="main">
            <div class ="properties">
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
            <Button>Add Organization</Button>
        </div>
    </form>
</body>

</html>
