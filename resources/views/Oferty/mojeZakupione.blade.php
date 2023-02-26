<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
@include('partials.left_block')
<div id="zawartosc">
<h2>Moje zakupione oferty</h2>
 <table>
 <thead>
 <tr> <th>Id</th> <th>Typ oferty</th> <th>Nazwa ksiazki</th> <th>Cena</th><th>Stan</th> <th>Data dodania</th> <th>Data zakonczenia</th><th>Stan zamówienia</th><th></th></tr>
 </thead>
 <tbody>
 @foreach($oferty as $el)
 <tr> <td>{{$el->Id}}</td> 
 @if($el->Typ_oferty==0)
    <td>Sprzedaż</td> 
 @elseif($el->Typ_oferty==1)
    <td>Wymiana</td>
 @elseif($el->Typ_oferty==2)
    <td>Zapytanie</td>
 @endif
    <td>{{$el->Nazwa_ksiazki}}</td><td>{{$el->Cena}}</td><td>{{$el->Stan}}</td><td>{{$el->data_dod}}</td>
 @if(is_null($el->data_zak))
 <td>Trwa</td>
 @else   
<td>{{$el->data_zak}}</td>
@endif
   @foreach($wysylka as $w)
    @if($w->oferta_id == $el->Id)
        <td>{{$w->stan_wys}}</td>
        @if(is_null($w->miasto))
        <td><a href="<?=config('app.url'); ?>/oferty/wysylka/zmienDane/{{$el->Id}}">Dodaj</a></td>
        @else
        <td></td>
        @endif
    @endif
@endforeach
    </tr>
 @endforeach
 </tbody>
 </table>
</div>
</body>
</html>