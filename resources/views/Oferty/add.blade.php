<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <div id="zawartosc">
        <h2>Nowa oferta</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/oferty/save" method="post" enctype="multipart/form-data">
        @csrf
    <p>
        <label for="oferta_nazwa_ksiazki">Nazwa Ksiazki</label>
        <input type="text" name="oferta_nazwa_ksiazki" id="oferta_nazwa_ksiazki" placeholder="Nazwa książki..." required> 
    </p>
    <p>
        <label for="oferta_typ_oferty">Typ oferty:</label>
    
        <input type="radio" name="oferta_typ_oferty" id="oferta_typ_oferty" value=0  required>
        <label for="oferta_typ_oferty">Sprzedaż</label>
        <input type="radio" name="oferta_typ_oferty" id="oferta_typ_oferty" value=1  required>
        <label for="oferta_typ_oferty">Wymiana</label>
        <input type="radio" name="oferta_typ_oferty" id="oferta_typ_oferty" value=2  required>
        <label for="oferta_typ_oferty">Zapytanie</label>
    </p>
    <p>
        <label for="oferta_cena">Cena: </label>
        <input id="oferta_cena" name="oferta_cena" value="" type="number" step="0.01" max="999" min="0" placeholder="Cena" required>
    </p>
    <p>
        <label for="custom-textarea">Opis: </label>
        <textarea class="custom-textarea" id="oferta_opis" name="oferta_opis" required></textarea>
    </p>
    <p>
        <label for="oferta_stan">Stan: </label>
        <input type="radio" name="oferta_stan" id="oferta_stan" value="Nowy"  required>
        <label for="oferta_stan">Nowy</label>
        <input type="radio" name="oferta_stan" id="oferta_stan" value="Bardzo dobry"  required>
        <label for="oferta_typ_oferty">Bardzo dobry</label>
        <input type="radio" name="oferta_stan" id="oferta_stan" value="Dobry"  required>
        <label for="oferta_typ_oferty">Dobry</label>
        <input type="radio" name="oferta_stan" id="oferta_stan" value="Zadowalajacy"  required>
        <label for="oferta_typ_oferty">Zadowalający</label>
    </p>
    <p>
        <label for="inputFile">Zjęcie: </label>
        <input type="file" name="image" class ="form-control-file" id="inputFile">
    </p>
    <p><button type="submit" class="btn btn-primary mb-2">Dodaj</button></p>
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