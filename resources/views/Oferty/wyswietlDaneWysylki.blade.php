<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <div id="zawartosc">
        <h2>Dane wysyłki dla oferty: {{$oferta->Nazwa_ksiazki}} </h2>
        <h4> Zakupiona w: {{$oferta->data_zak}}</h4>
        @csrf
        <p>
            Opcja dostawy:  {{$wysylka->opcja_dost}}<br>
            {{$wysylka->adres_1}}<br>
            @if(isset($wysylka->adres_2))
                {{$wysylka->adres_2}}<br>
            @endif
            {{$wysylka->kod_pocztowy}} {{$wysylka->miasto}}<br>
            {{$wysylka->imie_nazwisko}}<br>
            {{$wysylka->telefon}}
        </p>
        <p>
            <a href="<?=config('app.url'); ?>/mojeSprzedane">Powrót - moje sprzedane</a>
        </p>
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