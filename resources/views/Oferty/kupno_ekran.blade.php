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
        <h2>Oferta: {{$oferta->Nazwa_ksiazki}}</h2>
        <form class="form-inline" @if($oferta->Typ_oferty==0) action="<?=config('app.url'); ?>/oferty/daneWysylki/{{$oferta->Id}}"
        @elseif($oferta->Typ_oferty==1)
        action="<?=config('app.url'); ?>/oferty/wymiana/{{$oferta->Id}}"
        @elseif($oferta->Typ_oferty==2)
        action="<?=config('app.url'); ?>/oferty/sprzedaj/{{$oferta->Id}}"
        @endif
         method="get">
        @csrf
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
        <h4>Cena: </h4>
        <h2>{{$oferta->Cena}} zł</h2>
    </p>

    <p>
        <h4>Opis oferty: </h4>
        {{$oferta->Opis}}
    </p>
    <p>
        Data dodania: {{$oferta->data_dod}}
    </p>
    <p>
        <h4>Sprzedajacy: {{$sprzedajacy}}</h4>
    </p>
    @if($oferta->Typ_oferty==0)
    <p><button type="submit" class="btn btn-primary mb-2">Kup</button></p>
    @elseif($oferta->Typ_oferty==1)
    <p><button type="submit" class="btn btn-primary mb-2">Wymień się</button></p>
    @elseif($oferta->Typ_oferty==2)
    <p><button type="submit" class="btn btn-primary mb-2">Sprzedaj</button></p>
    @endif
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