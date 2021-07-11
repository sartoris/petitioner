<html>

<head>
    <?php
        include 'includes/header.php';
        $msg = "";
        $msgClass = "noMsg";
    ?>
    <title>Petitioner - Generate Petitions</title>
    <script language="javascript">

        function onLoad() {
            document.getElementById("batch").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <?php
        $page = 'generatePetition';
        include 'includes/navbar.php';
        if(isset($_SESSION['errorMsg'])) {
            $msg = $_SESSION['errorMsg'];
            unset($_SESSION['errorMsg']);
            $msgClass = "error";
        } else if(isset($_SESSION['message'])) {
            $msg = $_SESSION['message'];
            unset($_SESSION['message']);
            $msgClass = "info";
        }
    ?>
    <div class="<?php echo $msgClass ?>" ><?php echo $msg ?></div>
    <form action='save_petitions.php' method='post'>    
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="batch">Latest Batch</label>
                    <div class="propertyInput">
                    <input id=batch name=batch type="text" value="AA" />
                    </div>
                </div>
                <div class="property">
                    <label for="startingNumber">Starting Number</label>
                    <div class="propertyInput">
                        <input id="startingNumber" name="startingNumber" type="text" inputmode="numeric" class="numericInput" value="1001"/>
                    </div>
                </div>
                <div class="property">
                    <label for="endingNumber">Ending Number</label>
                    <div class="propertyInput">
                        <input id="endingNumber" name="endingNumber" type="text" inputmode="numeric" class="numericInput" value="1200"/>
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
            </div>
            <Button>Generate Next Batch</Button>
        </div>
    </form>
</body>

</html>
