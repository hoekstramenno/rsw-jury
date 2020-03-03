@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            @include('partials.page-title', [
                'title' => 'Beoordelingsformulier - RSW ' . $rating->year->label
            ])
            <div class="px-3 d-inline-block float-left w-25">
                <h2 style="padding-top: 25px; height:80px; width:80px;" class="rounded-circle bg-primary text-center text-white">{{ $rating->number. $rating->suffix }}</h2>
            </div>
            <div class="px-3 d-inline-block float-left w-75">
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">{{ $rating->name }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-25 first">Categorie</td>
                        <td class="last">{{ $rating->ratingCategory->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="POST" action="{{route('scores.store', ['year' => $rating->year->label, 'formNumber' => $rating->number, 'suffix' => $rating->suffix])}}">
                    @csrf

                @foreach ($teams as $team)

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="score">{{ $team->start_number }}. {{ $team->name }}</label>
                            <div class="col-10">
                            <input type="number" class="form-control"  name="score[{{ $team->id }}]" value="{{ $team->scores->first()->score ?? 0 }}"/>
                            </div>
                        </div>

                @endforeach
                    <input class="float-right btn btn-lg btn-primary" type="submit" value="Verstuur">
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('scores.index', ['year' => $rating->year->label])}}"><< Terug naar scores van {{ $rating->year->label }}</a>
            </div>
        </div>
    </div>
@endsection
