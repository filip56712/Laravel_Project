<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <div id="zawartosc">
        <h2>Dane wysyłki dla oferty: {{$oferta->Nazwa_ksiazki}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/oferty/daneWysylki/{{$oferta->Id}}/save" method="post" enctype="multipart/form-data">
        @csrf
    <p>
        <label for="wysylka_imie_nazwisko">Imie i nazwisko: </label>
        <input id="wysylka_imie_nazwisko" name="wysylka_imie_nazwisko" value="" type="text" required>
    </p>
    <p>
        <label for="wysylka_telefon">Telefon: </label>
        <input id="wysylka_telefon" name="wysylka_telefon" value="" type="tel" required>
    </p>
    <p>
        <label for="wysylka_adres_1">Adres 1: </label>
        <input id="wysylka_adres_1" name="wysylka_adres_1" value="" type="text" required>
    </p>
    <p>
        <label for="wysylka_adres_2">Adres 2: </label>
        <input id="wysylka_adres_2" name="wysylka_adres_2" value="" type="text">
    </p>
    <p>
        <label for="wysylka_kod_pocztowy">Kod pocztowy: </label>
        <input id="wysylka_kod_pocztowy" name="wysylka_kod_pocztowy" value="" type="text" required>
    </p>
    <p>
        <label for="wysylka_miasto">Miasto: </label>
        <input id="wysylka_miasto" name="wysylka_miasto" value="" type="text" required>
    </p>
    <p>
        <label for="wysylka_opcja_dost">Opcja dostawy:</label>
        <select id="wysylka_opcja_dost" name="wysylka_opcja_dost">
            <option value="Kurier - poczta polska - za pobraniem">Kurier - poczta polska - za pobraniem</option>
            <option value="Kurier - inpost - za pobraniem">Kurier - inpost - za pobraniem</option>
            <option value="Kurier - poczta polska">Kurier - poczta polska</option>
            <option value="Kurier - inpost">Kurier - inpost</option>
            <option value="Przesyłka polecona">Przesyłka polecona</option>
            <option value="List - ekonomiczny">List - ekonomiczny</option>
        </select>
    </p>
    <p><button type="submit" class="btn btn-primary mb-2">Zakończ</button></p>
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