@extends('base')

@section('content')
    <div class="container-fluid  dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Hike tijden voor {{ $currentYear }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Startnummer</th>
                        <th colspan="4" scope="col">Naam</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>{{ $team->start_number }}</td>
                            <td>{{ $team->name }}</td>
                            <td colspan="3">
                                <table>
                                    <hike-time :team="{{ $team->id }}"
                                               :start="'{{ $team->hiketime->start ?? null }}'"
                                               :end="'{{ $team->hiketime->end ?? null }}'">
                                    </hike-time>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
