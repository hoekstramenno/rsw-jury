<div class="container mb-3">
    <div class="row">
        <div class="col-12">
            <table class="points">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    @if ($data['printview']['direction'] === 'ltr')
                        @for ($point = 0; $point <= $data['points']; $point++)
                            <th class="text-center">{{ $point }}</th>
                        @endfor
                    @else
                        @for ($point = $data['points']; $point >= 0; $point--)
                            <th class="text-center">{{ $point }}</th>
                        @endfor
                    @endif
                    <th class="text-center">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['teams'] as $team)
                    <tr>
                        <td class="f-2 font-weight-bold text-center">{{$team->start_number}}</td>
                        @if ($data['printview']['direction'] === 'ltr')
                            @for ($point = 0; $point <= $data['points']; $point++)
                                <td class="text-center">{{ $point }}</td>
                            @endfor
                        @else
                            @for ($point = $data['points']; $point >= 0; $point--)
                                <td class="text-center">{{ $point }}</td>
                            @endfor
                        @endif
                        <td class="f-2  font-weight-bold text-center">{{$team->start_number}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
