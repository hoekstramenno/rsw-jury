@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            @include('partials.page-title', [
                'title' => 'Alle beoordelingen voor jaar ' .  $year,
            ])
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Titel</th>
                        <th>PDF</th>
                        <th>Score</th>
                        <th>Factor</th>
                        <th>Totaal</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Totaal
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $total }}</td>
                        </tr>
                        @foreach ($ratings as $rating)
                            <tr>
                                <td>{{ $rating->number . $rating->suffix }}</td>
                                <td><a href="{{ route('ratings.show', ['year' => $rating->year->label, 'formNumber' => $rating->number, 'suffix' => $rating->suffix]) }}">{{ $rating->name }}</a></td>
                                <td><a href="{{ route('pdf.show', ['year' => $rating->year->label, 'formNumber' => $rating->number, 'suffix' => $rating->suffix]) }}">PDF</a></td>
                                <td>{{ $rating->points }}</td>
                                <td>{{ $rating->factor }}</td>
                                <td>{{ $rating->points * $rating->factor }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                Totaal
                            </td>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
