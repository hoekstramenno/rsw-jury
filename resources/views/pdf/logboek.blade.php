<div class="container">
    <div class="row">
        <table class="logbook">
            <thead>
            <tr>
                <th></th>
                <th colspan="2">Thema</th>
                <th colspan="3">Materiaal</th>
                <th></th>
                <th colspan="2">Inhoudelijk gebruik thema</th>
                <th colspan="7">Inhoudelijk  + voor elk genoemd onderstaand programmaonderdeel</th>
                <th></th>
            </tr>
            </thead>
            <tr>
                <th class="vertical"><div><span></span></div></th>
                <th class="vertical"><div><span>Logboekomslag niet in Thema -of-</span></div></th>
                <th class="vertical border-black-right"><div><span>Logboekomslag in thema</span></div></th>
                <th class="vertical"><div><span>Logboek is voornamelijk prefab -of-</span></div></th>
                <th class="vertical"><div><span>Geen prefab, maar ook niet duidelijk zelfgemaakte omslag -of-</span></div></th>
                <th class="vertical border-black-right"><div><span>Duidelijk zelfgemaakt omslag</span></div></th>
                <th class="vertical border-black-right"><div><span>Maximaal 50 bij 50 cm</span></div></th>
                <th class="vertical"><div><span>Gewoon/onbewerkt papier gebruikt -of-</span></div></th>
                <th class="vertical border-black-right"><div><span>Gebruikt papier bevat thematische aankleding(plaatjes o.i.d.)</span></div></th>
                <th class="vertical"><div><span>Bevat zowel verslag als schets -en/of-</span></div></th>
                <th class="vertical"><div><span>Levendige berichtgeving -en/of-</span></div></th>
                <th class="vertical"><div><span>Introductie aanwezig -en/of-</span></div></th>
                <th class="vertical"><div><span>Opening -en/of-</span></div></th>
                <th class="vertical"><div><span>Hike -en/of-</span></div></th>
                <th class="vertical"><div><span>Avondspel -en/of-</span></div></th>
                <th class="vertical border-black-right"><div><span>kampvuur -en/of-</span></div></th>
                <th class="vertical"><div><span>Totaal</span></div></th>
                <th></th>
            </tr>
            @foreach($data['teams'] as $team)
                <tr>
                    <td class="f-2 font-weight-bold border-black-right text-center">{{$team->start_number}}</td>
                    <td class="text-center">1</td>
                    <td class="text-center border-black-right">3</td>
                    <td class="text-center">1</td>
                    <td class="text-center">2</td>
                    <td class="text-center border-black-right">4</td>
                    <td class="text-center border-black-right">2</td>
                    <td class="text-center">1</td>
                    <td class="text-center border-black-right">2</td>
                    <td class="text-center">1</td>
                    <td class="text-center">4</td>
                    <td class="text-center">1</td>
                    <td class="text-center">2</td>
                    <td class="text-center">2</td>
                    <td class="text-center">2</td>
                    <td class="text-center border-black-right">2</td>
                    <td></td>
                    <td class="f-2 font-weight-bold border-black-right text-center">{{$team->start_number}}</td>

                </tr>
            @endforeach
        </table>
    </div>

</div>
