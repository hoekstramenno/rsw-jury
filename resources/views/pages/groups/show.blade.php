@extends('base')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ $group->name }}</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="px-3">
                <canvas class="scores"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{ mix('js/group-line-chart.js')}}"></script>

@endpush

