@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            @include('partials.page-title', [
                'title' => 'Alle scores invullen voor jaar ' . $year
            ])
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
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
