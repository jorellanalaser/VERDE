<!DOCTYPE html>
<html>
    <head>
        <title>Maintenance</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                background: #669933;
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                    <img src="{{ asset('img/logolaser.png') }}" class="img-responsive" style="height:auto;">
                    <br/>
                    En estos Momentos estamos en Mantenimiento, En pocos Minutos estaremos con ustedes.
                    <hr/>
                    In these moments we are in maintenance, in a few minutes we will be with you.
                </div>
            </div>
        </div>
    </body>
</html>
