<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
<h2>Lista Ksiazek</h2>
 <table>
 <thead>
 <tr> <th>Zdjęcie</th> <th>Nazwa</th> <th>Gatunek</th> <th>Data wydania</th><th>Autorzy</th><th>Wydawnictwo</th><th>Opis</th> </tr>
 </thead>
 <tbody>
 @foreach($ksiazki as $el)
 <tr> <td>
   <img src="{{ asset('storage/img2/products/'.$el->image) }}" alt="Product Image">
</td>
<td>{{$el->Nazwa}}</td><td>{{$el->Gatunek}}</td><td>{{$el->Data_wyd}}</td><td>{{$el->Autorzy}}</td><td>{{$el->Wydawnictwo}}</td><td>{{$el->Opis}}</td></tr>
 @endforeach
 </tbody>
 </table>
</div>
</body>
</html>