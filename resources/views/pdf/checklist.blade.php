<div class="container mb-3">
    <div class="row">
        <div class="col-12">
            <table class="points">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-center">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data['teams'] as $team)
                    <tr>
                        <td class="f-2 font-weight-bold text-center">{{$team->start_number}}</td>
                        <td>Goed</td>
                        <td>Geel</td>
                        <td>Rood</td>
                        <td class="f-2  font-weight-bold text-center">{{$team->start_number}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
