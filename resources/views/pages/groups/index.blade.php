@extends('base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Alle groepen</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table>
                    <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Plaats</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->city }}</td>
                            <td><a href="{{ route('groups.show', ['id' => $group->id]) }}">Detail</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
