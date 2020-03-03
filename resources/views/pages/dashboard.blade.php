@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            @include('partials.page-title', [
                'title' => $currentYear,
            ])
        </div>
        <div class="row">
            <div class="col-6">
{{--                @include('Components.Scores.bar', [--}}
{{--                    'title' => 'Per activiteiten-gebied',--}}
{{--                    'data' => $chart--}}
{{--                ])--}}
            </div>
        </div>
    </div>
@endsection
