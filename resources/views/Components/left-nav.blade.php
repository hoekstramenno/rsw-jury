<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'teams.index') === 0) ? 'active' : '' }} nav-link" href="{{ route('teams.index', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Teams</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'ratings.index') === 0) ? 'active' : '' }} nav-link" href="{{ route('ratings.index', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Beoordelingen</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'scores.index') === 0) ? 'active' : '' }} nav-link" href="{{ route('scores.index', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Scores</a>
                    </li>
                    <li class="nav-divider">
                        Uitslagen
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'hike.calculate.times') === 0) ? 'active' : '' }} nav-link" href="{{ route('hike.calculate.times', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Hike uitslag</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'score.calculate.theme') === 0) ? 'active' : '' }} nav-link" href="{{ route('score.calculate.theme', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Thema uitslag</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'result.index') === 0) ? 'active' : '' }} nav-link" href="{{ route('result.index', ['year' => $currentYear]) }}"><i class="fa fa-fw fa-rocket"></i> Uitslag</a>
                    </li>
                    <li class="nav-divider">
                        Algemeen
                    </li>
                    <li class="nav-item">
                        <a class="{{ (strpos(Route::currentRouteName(), 'groups.index') === 0) ? 'active' : '' }} nav-link" href="{{ route('groups.index') }}"><i class="fa fa-fw fa-rocket"></i> Groepen</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#years" aria-controls="years">
                            <i class="fa fa-fw fa-rocket"></i>&nbsp;Jaren
                        </a>
                        <div id="years" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                            @foreach ($availableYears as $year)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('year.change', ['year' => $year->label]) }}">{{ $year->label }}</a>
                                    </li>
                            @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
