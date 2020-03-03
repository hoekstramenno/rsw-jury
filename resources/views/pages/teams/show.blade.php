@extends('base')

@php

/**
 * @var \App\Support\Statistics\TeamStatistics $stats
*/

@endphp

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{$team->start_number}}: {{ $team->name }} ({{ $team->group->name }})</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @include('Components.Scores.counter', [
                'title' => 'Totale score',
                'value' => $stats->getTotalTeamScore()->getTotal(),
            ])
            @include('Components.Scores.counter', [
                'title' => 'Percentage van totaal',
                'value' => $stats->getTotalTeamScore()->getPercentage() . '%',
            ])
            @include('Components.Scores.counter', [
                'title' => 'Looptijd voor hike',
                'value' => $stats->getHike()->getTime()
            ])
        </div>
        <div class="row">
            @include('Components.Scores.radar', [
                'title' => 'Activiteitengebieden',
                'id' => 'activity',
                'data' => $radar
            ])
        </div>


    </div>
@endsection
