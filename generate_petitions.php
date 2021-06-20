<html>

<head>
    <?php
        include 'includes/header.php';
    ?>
    <title>Petitioner - Generate Petitions</title>
    <script language="javascript">

        function onLoad() {
            document.getElementById("startingNumber").focus();
        }

    </script>
</head>

<body onLoad="onLoad()">
    <?php
        $page = 'generatePetition';
        include 'includes/navbar.php';
    ?>
    <form action='save_petitions.php' method='post'>    
        <div class="main">
            <div class ="properties">
                <div class="property">
                    <label for="batch">Latest Batch</label>
                    <div class="propertyInput">
                    <input id=batch name=batch type="text" value=<?php echo getNextBatchLetter() ?> readonly style="border:none" />
                    </div>
                </div>
                <div class="property">
                    <label for="startingNumber">Starting Number</label>
                    <div class="propertyInput">
                        <input id="startingNumber" name="startingNumber" type="text" inputmode="numeric" class="numericInput" value="05000"/>
                    </div>
                </div>
                <div class="property">
                    <label for="endingNumber">Ending Number</label>
                    <div class="propertyInput">
                        <input id="endingNumber" name="endingNumber" type="text" inputmode="numeric" class="numericInput" value="06999"/>
                    </div>
                </div>
            </div>
            <Button>Generate Next Batch</Button>
        </div>
    </form>
</body>

</html>
