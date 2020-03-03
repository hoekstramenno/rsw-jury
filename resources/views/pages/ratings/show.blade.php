@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <h1 class="mb-4">Beoordelingsformulier - RSW {{ $rating->year->label }}</h1>

        <div class="row">
            <div class="px-3 d-inline-block float-left w-25">
                <h2 style="padding-top: 25px; height:80px; width:80px;" class="rounded-circle bg-primary text-center text-white">{{ $rating->number. $rating->suffix }}</h2>
            </div>
            <div class="px-3 d-inline-block float-left w-75">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th colspan="2"><h3>{{ $rating->name }}</h3></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Id</td>
                        <td class="last">{{ $rating->id }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Categorie</td>
                        <td class="last">{{ $rating->ratingCategory->name }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Factor</td>
                        <td class="last">{{ $rating->factor }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Punten</td>
                        <td class="last">{{ $rating->points }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Telt mee</td>
                        <td class="last">{{ !$rating->outside_compition }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Formulier formaat</td>
                        <td class="last">{{ $rating->printView->view }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Formulier richting</td>
                        <td class="last">{{ $rating->printView->direction }}</td>
                    </tr>
                    <tr>
                        <td class="w-25 first">Formulier</td>
                        <td>
                            <a href="{{ route('pdf.show', ['year' => $rating->year->label, 'formNumber' => $rating->number, 'suffix' => $rating->suffix]) }}">PDF</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (count($rating->criteria) > 0 || count($rating->definitions) > 0)
        <div class="container">
            <div class="row">
                @if (count($rating->criteria) > 0)
                    <div class="px-3 d-inline-block float-left {{ count($rating->definitions) > 0 ? 'w-50' : 'w-100' }}">
                        <h4>Beoordelingscriteria:</h4>
                        @foreach ($rating->criteria as $criterium)
                            {!!  $criterium->description  !!}
                        @endforeach
                    </div>
                @endif
                @if (count($rating->definitions) > 0)
                    <div class="px-3 d-inline-block float-left {{ count($rating->criteria) > 0 ? 'w-50' : 'w-100' }}">
                        <h4>Definities:</h4>
                        @foreach ($rating->definitions as $definition)
                            {!!  $definition->description  !!}
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col my-3">
                    <a class="btn btn-primary" href="{{ route('ratings.index', ['year' => $rating->year->label])}}"><< Terug naar {{ $rating->year->label }}</a>
                </div>
            </div>
        </div>

    @endif
@endsection
