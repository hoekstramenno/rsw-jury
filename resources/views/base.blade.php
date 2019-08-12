<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">


<head>

    {{-------------------------------------------------------------------------------
    Stylesheets
    -------------------------------------------------------------------------------}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    @stack('head')

</head>
<body>


<main id="main">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 shadow-sm">
        <a class="navbar-brand" href="#">RSW Haarlem</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Jaren <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('groups.index', ['year' => $currentYear]) }}">Groepen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ratings.index', ['year' => $currentYear]) }}">Beoordelingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('scores.index', ['year' => $currentYear]) }}">Scores</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Jaren
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($years as $year)
                        <a class="dropdown-item" href="{{ route('dashboard', ['year' => $year->label]) }}">{{ $year->label }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('result.index', ['year' => $currentYear]) }}">Uitslag</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')
</main>


{{-------------------------------------------------------------------------------
Scripts
-------------------------------------------------------------------------------}}

<script src="{{ mix('js/app.js') }}"></script>


@stack('scripts')
</body>
</html>
