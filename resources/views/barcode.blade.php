<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        </head>
    <body>
        <div class="flex-center position-ref full-height">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('QZ21398zas', 'QRCODE', '100', '100')}}" style="width: 20%;display: block; margin-left: auto;margin-right: auto;margin-top: 20vh;padding: 20px;border: 3px solid #3498db;" alt="barcode" />
        </div>
    </body>
</html>
