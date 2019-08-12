@extends('pdf.base')

@section('content')
    <div class="container">
        <h2 class="mb-4">Beoordelingsformulier - RSW {{ $data['year']['label'] }}</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="px-3 d-inline-block float-left w-25">
                <h2 style="padding-top: 25px; height:80px; width:80px;" class="rounded-circle bg-primary text-center text-white">{{ $data['number']. $data['suffix'] }}</h2>
            </div>
            <div class="px-3 d-inline-block float-left w-75">
                <table>
                    <thead>
                    <tr>
                        <th colspan="2">Formulier: {{ $data['name'] }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-25 first">Categorie</td>
                        <td class="last">{{ $data['rating_category']['name'] }}</td>
                    </tr>
                    <tr>
                        <td class="first">Naam jury</td>
                        <td class="last"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($data['print_view']['view'] === 'logboek')
        @include('pdf.logboek', ['data' => $data])
    @elseif ($data['print_view']['view'] === 'checklist')
        @include('pdf.checklist', ['data' => $data])
    @else
        @include('pdf.normal', ['data' => $data])
    @endif
    <div class="container mb-3">
        <div class="row">
            <div class="col">
                <h4>Uitleg</h4>
                Volg via de criteria hoeveel punten een ploeg heeft verdiend op deze post. Er kunnen nooit halve punten worden gegeven.
                <br/>
                <br/>Omcirkel het aantal punten<br/>
                Dus zo:
                <div style="width:20px; height: 20px;" class="d-inline-block text-center rounded-circle border border-success">8</div>
                en niet zo
                <div class="d-inline-block position-relative">
                    8
                    <span class="cross"></span>
                </div>
            </div>
        </div>
    </div>
    @if (count($data['criteria']) > 0 || count($data['definitions']) > 0)
        <div class="page_break_before"></div>
        <div class="container">
            <h1 class="mb-4">Beoordelingsformulier - RSW {{ $data['year']['label'] }}</h1>
        </div>
        <div class="container">
            <div class="row">
                <div class="px-3 d-inline-block float-left w-25">
                    <h2 style="padding-top: 25px; height:80px; width:80px;" class="rounded-circle bg-primary text-center text-white">{{ $data['number']. $data['suffix'] }}</h2>
                </div>
                <div class="px-3 d-inline-block float-left w-75">
                    <table>
                        <thead>
                        <tr>
                            <th colspan="2">Formulier: {{ $data['name'] }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="w-25 first">Categorie</td>
                            <td class="last">{{ $data['rating_category']['name'] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix mb-5"></div>
        <div class="container">
            <div class="row">
                @if (count($data['criteria']) > 0)
                    <div class="px-3 d-inline-block float-left {{ count($data['definitions']) > 0 ? 'w-50' : 'w-100' }}">
                        <h4>Beoordelingscriteria:</h4>
                        @foreach ($data['criteria'] as $criterium)
                            {!!  $criterium['description']  !!}
                        @endforeach
                    </div>
                @endif
                @if (count($data['definitions']) > 0)
                    <div class="px-3 d-inline-block float-left {{ count($data['criteria']) > 0 ? 'w-50' : 'w-100' }}">
                        <h4>Definities:</h4>
                        @foreach ($data['definitions'] as $definition)
                            {!!  $definition['description']  !!}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection
