@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Alle scores invullen voor jaar {{ $year }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table>
                    <thead>
                    <tr>
                        <th>Titel</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($ratings as $rating)
                            <tr>
                                <td><a href="{{ route('scores.show', ['year' => $rating->year->label, 'formNumber' => $rating->number, 'suffix' => $rating->suffix]) }}">{{ $rating->name }}</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
