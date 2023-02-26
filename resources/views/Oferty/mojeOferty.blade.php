<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
@include('partials.left_block')
<div id="zawartosc">
<h2>Moje oferty</h2>
 <table>
 <thead>
 <tr> <th>Id</th> <th>Typ oferty</th> <th>Nazwa ksiazki</th> <th>Cena</th><th>Stan</th> <th>Data dodania</th> <th>Data zakonczenia</th> <th>Edit</th> <th>Del</th></tr>
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
    <td>
      @if(is_null($el->data_zak))
      <a href="<?=config('app.url'); ?>/oferty/edit/{{$el->Id}}">Edit</a>
      @endif
   </td> 
   <td>
      @if(is_null($el->data_zak))
      <a href="<?=config('app.url'); ?>/oferty/deleteConf/{{$el->Id}}">Delete</a>
      @endif
   </td></tr>
 @endforeach
 </tbody>
 </table>
</div>
</body>
</html>