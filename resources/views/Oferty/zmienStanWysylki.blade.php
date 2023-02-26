<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <h2>Dane wysyłki dla oferty: {{$oferta->Nazwa_ksiazki}} </h2>
    <h4> Zakupiona w: {{$oferta->data_zak}}</h4>
    <form class="form-inline" action="<?=config('app.url'); ?>/oferty/wysylka/zmienStan/save/{{$wysylka->id}}" method="post">
        @csrf
        <p>
            <label for="wysylka_stan_wys">Stan wysyłki: </label>
            <select id="oferta_nazwa_ksiazki" name="oferta_nazwa_ksiazki">
            <option id="wysylka_stan_wys" name="wysylka_stan_wys" value="Wydrukowana etykieta" required>Wydrukowana etykieta</option>
            <option id="wysylka_stan_wys" name="wysylka_stan_wys" value="Czeka na nadanie" required>Czeka na nadanie</option>
            <option id="wysylka_stan_wys" name="wysylka_stan_wys" value="Odebrana przez kuriera" required>Odebrana przez kuriera</option>
            <option id="wysylka_stan_wys" name="wysylka_stan_wys" value="Nadana - w drodze" required>Nadana - w drodze</option>
            <option id="wysylka_stan_wys" name="wysylka_stan_wys" value="Odebrana - sprzedaż zakończona" required>Odebrana - sprzedaż zakończona</option>
            </select>
        </p>
        <p><button type="submit" class="btn btn-primary mb-2">Zapisz</button></p>
    </form>
    <p>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
    </ul>
    @endif
    </p>
</div>
</body>
</html>