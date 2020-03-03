@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Teams voor {{ $currentYear }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Startnummer</th>
                        <th scope="col">Naam</th>
                        <th scope="col">Groepsnaam</th>
                        <th scope="col">Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>{{ $team->start_number }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->group->name }}</td>
                            <td>
                                <a href="{{ route('teams.show', [
                                    'id' => $team->id,
                                    'year' => $currentYear
                                ]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
