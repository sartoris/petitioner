<html>

    <head>
        <title><?php echo $organization ?> - Self Registration</title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>"/>
        <style>
            .main {
                width: 800px;
                display: flex;
                flex-direction: row;
                background-color: rgb(255, 255, 255);
                font-family: 'Arial', sans-serif;
                font-size: 16px;
                margin: 7em auto;
                border-radius: 1.5em;
                box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
            }

            .main img {
                width: 300px;
                height: 218px;
                padding: 10px;
                border-radius: 1.5em;
            }

            .main p {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding-right: 10px;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <img src="<?php echo $loginLogo ?>" alt="<?php echo $organization ?>"/>
            <p>Thank you for registering! We will contact you when your registration has been approved.</p>
        </div>
    </body>

</html>
