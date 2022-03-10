<?php ?>
<html>
    <head>
        <style>
            #textBoxes
            {
                position: absolute;
                margin: 0;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);
            }
            button
            {
                font-size: 20px;
                padding: 10px;
                border-radius: 10px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div id="textBoxes">
            <input type="text" name="Username" placeholder="Username">
            <input type="password" name="Password" placeholder="Password">
            <button id="submitButton" onclick="location.href='/folders'"> Login </button>
        </div>


    </body>


</html>
