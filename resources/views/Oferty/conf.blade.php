<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <div id="zawartosc">
        <h2>Potwierdzenie - Usuwanie oferty o ID: {{$oferta->Id}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/oferty/delete/{{$oferta->Id}}" method="post">
        @csrf
    <p>
        <label for="Nazwa_ksiazki">Nazwa Ksiazki: </label>
        <input type="text" id="Nazwa_ksiazki" name="Nazwa_ksiazki" list="ksiazki" value="{{$oferta->Nazwa_ksiazki}}" class="custom-input" readonly/>
    </p>
    <p>
    @if($oferta->Typ_oferty==0)
    Typ oferty: Sprzedaż 
    @elseif($oferta->Typ_oferty==1)
    Typ oferty: Wymiana
    @elseif($oferta->Typ_oferty==2)
    Typ oferty: Zapytanie
    @endif
    </p>
    <p>
        <label for="Cena">Cena: </label>
        <input id="Cena" name="Cena" value="{{$oferta->Cena}}" type="number" step="0.01" readonly>
    </p>
    <p>
        <label for="data_dod">Data dodania: </label>
        <input type="text" id="data_dod" name="data_dod" value="{{$oferta->data_dod}}" readonly>
    </p>
    <p><button type="submit" class="btn btn-primary mb-2">Usuń</button></p>
    </form>
    <p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
    </ul>
    </div>
    @endif
    </p>
    </div>
</div>
</body>
</html>