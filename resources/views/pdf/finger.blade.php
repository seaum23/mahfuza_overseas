<!DOCTYPE html>

<html>

<head>

    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}">
    <title>Finger PDF</title>

    <style>
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>

</head>

<body>
    

    <img src="{{ storage_path("app/public/candidate/finger/$images[0]") }}" style="width: 100%;">

    <img src="{{ storage_path("app/public/candidate/finger/$images[1]") }}" style="width: 100%;">

</body>

</html>