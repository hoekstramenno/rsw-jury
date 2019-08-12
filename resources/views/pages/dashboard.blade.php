@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $year->label }}</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <h5 class="card-title">Verdeling activiteitengebieden</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas class="rating-categories"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Expressie</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="4" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Identiteit</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="5" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Sportenspel</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="6" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Kamperen</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="7" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Knopen</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="8" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Tocht</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="9" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Veilig en Gezond</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="10" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Buitenleven</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="11" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
            <div class="card col-12">
                <div class="card-body rating-category-score">
                    <h5 class="card-title">Score voor Internationaal</h5>
                    <p class="card-text" style="height:400px;width: content-box;">
                        <canvas data-category="11" class="rating-scores"></canvas>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{ mix('js/ratio-category.js')}}"></script>
    <script src="{{ mix('js/per-category-scores.js')}}"></script>

@endpush
