
@if(!$gerichte)
    <p>Es sind keine Gerichte vorhanden</p>
@else
    <table>
        <thead>
        <th>Name</th>
        <th>Preisintern</th>

        </thead>
        @foreach($gerichte as $gericht)
            <tr>
                <th>{{$gericht['name']}}</th>
                <th>{{$gericht['preisintern']}}€</th>
            </tr>
        @endforeach
    </table>
@endif
