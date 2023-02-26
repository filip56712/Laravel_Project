<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
<h2>Lista Ofert</h2>
 <table>
 <thead>
 <tr> <th>Zdjęcie</th> <th>Typ oferty</th> <th>Nazwa ksiazki</th> <th>Cena</th><th>Stan</th><th></th> </tr>
 </thead>
 <tbody>
 @foreach($oferty as $el)
 <tr> <td>
   <img src="{{ asset('storage/img2/products/'.$el->image) }}" alt="Product Image">
</td> 
 @if($el->Typ_oferty==0)
    <td>Sprzedaż</td> 
 @elseif($el->Typ_oferty==1)
    <td>Wymiana</td>
 @elseif($el->Typ_oferty==2)
    <td>Zapytanie</td>
 @endif
    <td>{{$el->Nazwa_ksiazki}}</td><td><h3>{{$el->Cena}} zł</h3></td><td> Stan: {{$el->Stan}}</td><td><a href="<?=config('app.url'); ?>/oferty/kupno/{{$el->Id}}">Kup</a></td></tr>
 @endforeach
 </tbody>
 </table>
</div>
</body>
</html>