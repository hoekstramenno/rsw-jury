@extends('base')

@section('content')
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-12">
                <table class="results">
                    <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                        <th class="text-center">Onderdeel</th>
                        @foreach ($ratings as $rating)
                            <th class="text-center">{{ $rating->number }}{{$rating->suffix}}</th>
                        @endforeach
                        <th class="text-center">Totaal</th>
                        <th class="text-center">%</th>
                    </tr>
                    <tr>
                        <th class="text-center">Plaats</th>
                        <th class="text-center">WN</th>
                        <th class="text-center">Groep</th>
                        <th class="text-center">Ploeg</th>
                        @foreach ($ratings as $rating)
                            <th class="rotate"><div><span>{{ $rating->name }}</span></div></th>
                        @endforeach
                        <th class="rotate"><div><span>Totaal</span></div></th>
                        <th class="rotate"><div><span>%</span></div></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($scores as $position => $score)
                        @if ($score->getTeam()->outside_competition === false)
                            <tr class="
                                    {{ $score->getTeam()->won_motivation_award ? 'text-danger ' : '' }}
                                    {{ $score->getTeam()->won_theme_award ? 'text-info ' : '' }}
                                    {{ $position < 2 ? 'text-success ' : '' }}
                                    ">
                                <td class="text-center">{{ $position+1 }}</td>
                                <td class="text-center">{{ $score->getTeam()->start_number }}</td>
                                <td class="text-center">{{ $score->getTeam()->group->name }}</td>
                                <td class="text-center">{{ $score->getTeam()->name }}</td>
                                @foreach ($ratings as $rating)
                                    @foreach ($score->getScores() as $ratingId => $points)
                                            @if ($ratingId === $rating->id)
                                                <td class="text-center">{{ $points }}</td>
                                            @endif
                                    @endforeach
                                @endforeach
                                <td class="text-center">{{$score->getTotal()}}</td>
                                <td class="text-center">{{$score->getPercentage()}}%</td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($scores as $position => $score)
                        @if ($score->getTeam()->outside_competition === true)
                            <tr class="text-muted">
                                <td class="text-center">BM</td>
                                <td class="text-center">{{ $score->getTeam()->start_number }}</td>
                                <td class="text-center">{{ $score->getTeam()->group->name }}</td>
                                <td class="text-center">{{ $score->getTeam()->name }}</td>
                                @foreach ($ratings as $rating)
                                    @foreach ($score->getScores() as $ratingId => $points)
                                        @if ($ratingId === $rating->id)
                                            <td class="text-center">{{ $points }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                                <td class="text-center">{{$score->getTotal()}}</td>
                                <td class="text-center">{{$score->getPercentage()}}%</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                        <td class="text-center">Totaal</td>
                        <td class="text-center"></td>
                        @foreach ($ratings as $rating)
                            <td class="text-center">{{ $rating->max_points }}</td>
                        @endforeach
                        <td class="text-center">{{ $total }}</td>
                        <td class="text-center">%</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
