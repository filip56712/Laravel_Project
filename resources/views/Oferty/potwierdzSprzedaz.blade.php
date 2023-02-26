<!DOCTYPE html>
<html lang="pl">
@include('partials.head')
<body>
@include('partials.topbar')
@include('partials.navi')
<div id="left-block">
    <img src="{{ asset('storage/img2/products/'.$oferta->image) }}" alt="Product Image">
</div>
<div id="zawartosc">
    <div id="zawartosc">
        <br>
        <br>
        <br>
        <br>
        <h2>Potwierdzasz sprzedaż: {{$oferta->Nazwa_ksiazki}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/oferty/potwierdzSprzedaz/{{$oferta->Id}}/save" method="post" enctype="multipart/form-data">
        @csrf
    <p>
        <h4>Za cene: </h4>
        <h2>{{$oferta->Cena}} zł</h2>
    </p>
    <p>
        <h4>Dla kupującego: {{$sprzedajacy}}</h4>
    </p>
    <p>
        <h4>O stanie minimum: {{$oferta->Stan}}</h4>
    </p>
    <h3>UWAGA - klikając akceptuj zgadzasz się na sprzedaż</h3>
    <p><button type="submit" class="btn btn-primary mb-2">Akceptuj</button></p>
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