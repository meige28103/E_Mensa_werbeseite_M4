<ul>
        @foreach($kategorien as $kategorie)
        @if($loop->odd)
                <li> <b> {{$kategorie['name']}} </b> </li>
        @else
                <li> {{$kategorie['name']}} </li>
        @endif
        @endforeach
</ul>