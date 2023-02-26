<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="zawartosc">
    <div id="zawartosc">
        <h2>Nowa książka</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/ksiazka/save" method="post" enctype="multipart/form-data">
        @csrf
    <p>
        <label for="ksiazka_Nazwa">Nazwa: </label>
        <input id="ksiazka_Nazwa" name="ksiazka_Nazwa" value="" type="text" required>
    </p>
    <p>
        <label for="ksiazka_Gatunek">Gatunek: </label>
        <input id="ksiazka_Gatunek" name="ksiazka_Gatunek" value="" type="tel" required>
    </p>
    <p>
        <label for="custom-textarea">Opis: </label>
        <textarea class="custom-textarea" id="ksiazka_Opis" name="ksiazka_Opis"></textarea>
    </p>
    <p>
        <label for="ksiazka_Data_wyd">Data wydania: </label>
        <input id="ksiazka_Data_wyd" name="ksiazka_Data_wyd" value="" type="date" required>
    </p>
    <p>
        <label for="ksiazka_Autorzy">Autorzy: </label>
        <input id="ksiazka_Autorzy" name="ksiazka_Autorzy" value="" type="text" required>
    </p>
    <p>
        <label for="ksiazka_Wydawnictwo">Wydawnictwo: </label>
        <input id="ksiazka_Wydawnictwo" name="ksiazka_Wydawnictwo" value="" type="text">
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