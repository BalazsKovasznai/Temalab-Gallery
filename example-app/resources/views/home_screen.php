<?php ?>

<html>
    <head>
        <title>Home Screen</title>

        <style>
            button
            {
                background-color: #2ca02c;
                font-size: 30px;
                padding: 10px;
                border-radius: 10px;
                margin: 20px;
            }
            #container
            {
                position: absolute;
                margin: 0;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);
            }
        </style>
    </head>
    <body>

        <div id="container">
            <button name="loginButton" onclick="location.href='/login'"> Login</button>
            <button name="registrationButton" onclick="location.href='/register'"> Registration</button>
            Gallery
        </div>


    </body>


</html>
