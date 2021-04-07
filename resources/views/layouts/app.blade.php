<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{ mix('css/quasar.css', 'backend') }}">
</head>
<body>
@inertia

<script type="text/javascript" src="{{ mix('js/manifest.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('vendor/common.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('vendor/quasar.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('js/quasar.js', 'backend') }}"></script>
</body>
</html>
