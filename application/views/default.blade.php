<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SoloMid Developer Test : Aldo Utrera</title>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="{{ URL::to('/img/favico.png') }}">
    @section('cssfiles')
        {{ HTML::style(Footprint::cache_burst('/css/built.css'), array('media' => 'screen, projection')) }}
    @yield_section
</head>
<body>
    <div class="container main">
        @include('partials.navbar')
        <div class="content">
            @include('partials.status_messages')
            @section('content')
            @yield_section
        </div>
    </div>
    @section('jsfiles')
        {{ HTML::script(Footprint::cache_burst('/js/built.js')) }}
        {{ HTML::script('/js/custom.js') }}
    @yield_section
</body>
</html>
