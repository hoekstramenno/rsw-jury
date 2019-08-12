@extends('pdf.base')
@section('head')

    <style>
        html {
            font-size: 11px;
        }

        .logo {
            position: absolute;
            top: 5px;
            left: 10px;
        }

        table.results td {
            /*width: 22px;*/
            /*min-width: 22px;*/
        }

        table.results th {
            vertical-align: bottom;
        }

        table.results th.rotate {
            height: 160px;
            white-space: nowrap;
            vertical-align: bottom;
        }

        table.results th.rotate > div {
            transform: translate(0, 0) rotate(270deg);
            width: 10px;
            max-width: 10px;
        }

        table.results th.rotate > div > span {
            /*padding: 5px 10px;*/
        }

    </style>

@endsection

@section('content')
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-12">
                <table class="results">
                    <thead>
                    <tr>
                        <th colspan="3" class="text-center">
                            <img class="logo" src="{{ asset('img/2019-batch.png') }}" height="190" alt="">
                        </th>
                        <th class="text-center">Onderdeel</th>
                        @foreach ($data['ratings'] as $rating)
                            <th class="text-center">{{ $rating['number'] }}{{$rating['suffix'] }}</th>
                        @endforeach
                        <th class="text-center">Totaal</th>
                        <th class="text-center">%</th>
                    </tr>
                    <tr>
                    <th colspan="4" class="text-center"></th>
                    @foreach ($data['ratings'] as $rating)
                        <th class="rotate">
                            <div><span>{{ $rating['name'] }}</span></div>
                        </th>
                    @endforeach
                    <th></th>
                    <th></th>
                    </tr>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">WN</th>
                        <th class="text-center">Groep</th>
                        <th class="text-center">Ploeg</th>
                        @foreach ($data['ratings'] as $rating)
                            <th></th>
                        @endforeach
                        <th class="text-center">Totaal</th>
                        <th class="text-center">%</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['scores'] as $position => $score)
{{--                        @if (($score['team']['start_number'] === 1 || $score['team']['start_number'] === 9))--}}
                        <tr class="
                                {{ $score['team']['won_motivation_award'] ? 'text-danger ' : '' }}
                        {{ $score['team']['won_theme_award'] ? 'text-info ' : '' }}
                        {{ $position < 2 ? 'text-success ' : '' }}
                            ">
                            <td class="text-center">{{ $position+1 }}</td>
                            <td class="text-center">{{ $score['team']['start_number'] }}</td>
                            <td class="text-center">{{ $score['team']['group']['name'] }}</td>
                            <td class="text-center">{{ $score['team']['name'] }}</td>
                            @foreach ($data['ratings'] as $rating)
                                @foreach ($score['ratings'] as $ratingId => $points)
                                    @if ($ratingId === $rating['id'])
                                        <td class="text-center">{{ $points }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                            <td class="text-center">{{$score['total']}}</td>
                            <td class="text-center">{{$score['percentage']}}%</td>
                        </tr>
{{--                        @endif--}}
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-center">0</td>
                        <td class="text-center">0</td>
                        <td class="text-center">Totaal</td>
                        <td class="text-center"></td>
                        @foreach ($data['ratings'] as $rating)
                            <td class="text-center">{{ $rating['points'] * $rating['factor'] }}</td>
                        @endforeach
                        <td class="text-center">{{ $data['total'] }}</td>
                        <td class="text-center">%</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
