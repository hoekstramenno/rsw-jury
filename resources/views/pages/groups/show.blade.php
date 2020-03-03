@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            @include('partials.page-title', [
                'title' => $group->name,
                'description' => $group->city
            ])
        </div>
        <div class="row">
            <div class="col-6">
            @include('Components.Scores.bar', [
                'title' => 'Totale score',
                'data' => $totalScoreBar
            ])
            </div>
            <div class="col-6">
            @include('Components.Scores.line', [
                'title' => 'Totale score',
                'data' => $totalScoreBar
            ])
            </div>
        </div>
    </div>
@endsection

