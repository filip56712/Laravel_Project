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
        <h2>Potwierdzasz wymiane: {{$oferta->Nazwa_ksiazki}}</h2>
        <form class="form-inline" action="<?=config('app.url'); ?>/oferty/potwierdzWymiane/{{$oferta->Id}}/save" method="post" enctype="multipart/form-data">
        @csrf
    <p>
        <h4>O budżecie: </h4>
        <h2>{{$oferta->Cena}} zł</h2>
    </p>
    <p>
        <h4>Z użytkownikiem:</h4>
        <h3>{{$sprzedajacy}}</h3>
    </p>
    <p>
        <h4>Z stanem minimum:</h4>
        <h3>{{$oferta->Stan}}</h3>
    </p>

    <p>
        <h3>UWAGA - Strona nie posiada mechaniki wiadomości, dane w przypadku wymiany zostaną dodane do stanu wysyłki, dalszy kontak po za stroną.</h3>
    </p>
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