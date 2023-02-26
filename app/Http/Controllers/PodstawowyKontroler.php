<?php

namespace App\Http\Controllers;

use App\Models\ksiazka;
use App\Models\Oferta;
use App\Models\User;
use App\Models\Wysylka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;


class PodstawowyKontroler extends Controller
{
    public function zwrocStroneDomowa()
    {
        return view('domowa');
    }

    public function zwrocStroneKonto()
    {
        $id = Auth::id();
        if($id==1)
            return view('konto_admin_ekran');
        return view('konto_ekran');
    }

    public function zwrocStroneUstawienia()
    {
        return view('konto_ustawienia');
    }

    public function pokazKontakt()
    {
        return view('kontakt');
    }

    public function zwrocStroneZmianaHasla(){
        return view('auth.reset-password');
    }

    public function zologujScr()
    {
        $name = Auth::user()->name;
        return view('/zologujScr', ['name' => $name,]);
    }

    public function zmienStanUwierzytelnienia()
    {
        if(auth()->check()){
            $user = auth()->user();
            Auth::logout();
            return view('wylogowano');
        }else{
            return redirect('/register');
        } 
    }

    public function search(){
        $search_text = $_GET['query'];
        $oferty = Oferta::where('Nazwa_ksiazki', 'LIKE', '%'.$search_text.'%')
                ->where('data_zak', null)
                ->get();
        /*
        if($request->search){
            $searchProducts = Oferta::where('Nazwa_ksiazki', 'LIKE', '%'.$request->search.'%')->latest();
        }else{

        }
        */
        return view('oferty', compact('oferty'));
    }

    public function zwrocListeOfert()
    {
        /* //Wszystkie oferty
        $ofertyZBazy = DB::table('oferty')->get();
        return view('oferty', ['oferty' => $ofertyZBazy,]);
        */
         //Nie zakończone oferty
        $oferty = Oferta::where('data_zak', null)->get();
        return view('oferty', compact('oferty'));
        
    }

    public function zwrocListeKsiazek(){
        $ksiazki = DB::table('ksiazki')->get();
        return view('ksiazki', compact('ksiazki'));
    }

    public function zwrocMojeOferty(){
        $id = Auth::id();
        $oferty = Oferta::where('sprzedajacy', $id)->get();
        return view('Oferty.mojeOferty', compact('oferty'));
    }
    public function zwrocMojeSprzedane(){
        $id = Auth::id();
        $oferty = Oferta::where('sprzedajacy', $id)->whereNotNull('kupujacy')->get();
        $wysylka = Wysylka::where('sprzedajacy', $id)->get();
        return view('Oferty.mojeSprzedane', compact('oferty'), compact('wysylka'));
    }
    public function zwrocMojeZakupione(){
        $id = Auth::id();
        $oferty = Oferta::where('kupujacy', $id)->get();
        $wysylka = Wysylka::where('kupujacy', $id)->get();
        return view('Oferty.mojeZakupione', compact('oferty'), compact('wysylka'));
    }

    public function zmienStanWysylki($id){
        $idUser = Auth::id();
        $oferta = Oferta::find($id);
        $wysylka = Wysylka::where('oferta_id', $id)->first();
        if(is_null($wysylka)){
            $error_message = "Nie znaleziono wysyłki 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }else if($idUser!=$wysylka->sprzedajacy){
            $error_message = "404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        return view('Oferty.zmienStanWysylki', ['oferta'=>$oferta], ['wysylka'=>$wysylka]);
    }

    public function zapiszStanWysylki(Request $request, $id){
        $idUser = Auth::id();
        $wysylka = Wysylka::find($id);
        if(is_null($wysylka)){
            $error_message = "Nie znaleziono wysyłki 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        else if($idUser!=$wysylka->sprzedajacy){
            $error_message = "404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }

        $wysylka->stan_wys=$request->wysylka_stan_wys;
        $wysylka->save();
        return redirect('/mojeSprzedane');

    }

     /**
     * Display the specified resource.
     *
     * @param  String  $Nazwa_ksiazki
     * @return \Illuminate\Http\Response
     */
    public function show($Id)
    {
        $myOferta = Oferta::find($Id);
        if(isset($myOferta->data_zak)){
            $error_message = "Nie możesz usuwać zakończonych ofert!";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }else if($myOferta == null){
            $error_message = "Oferta o id=Id nie znaleziona";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        if($myOferta->count() > 0)
        return view('Oferty.conf', ['oferta'=>$myOferta,]);
    }

    public function kupno($Id){
        $myOferta = Oferta::find($Id);
        $user = User::find($myOferta->sprzedajacy);
        if($myOferta == null){
            $error_message = "Oferta o id=Id nie znaleziona";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        if($myOferta->count() > 0)
        return view('Oferty.kupno_ekran', ['oferta'=>$myOferta,], ['sprzedajacy'=>$user->name]);
    }

    public function potwierdzSprzedaz($id){
        $oferta = Oferta::find($id);
        if(is_null($oferta)){
            $error_message = "Oferta o nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        $user = User::find($oferta->sprzedajacy);
        return view('Oferty.potwierdzSprzedaz', ['oferta'=>$oferta,], ['sprzedajacy'=>$user->name]);

    }

    public function potwierdzWymiane($id){

        $oferta = Oferta::find($id);
        if(is_null($oferta)){
            $error_message = "Oferta o nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        $user = User::find($oferta->sprzedajacy);
        return view('Oferty.potwierdzWymiane', ['oferta'=>$oferta,], ['sprzedajacy'=>$user->name]);

    }
    public function confWymiana($id){
        $date = date('Y-m-d', time());
        $oferta = Oferta::find($id);
        $idKupujacy = Auth::id();
        $user = User::find($oferta->sprzedajacy);
        if(is_null($oferta)){
            $error_message = "Oferta nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        } 
        $idSprzedajacy = $oferta->sprzedajacy;

        //stworzenie danych "tymczasowych" wysyłki
        $wysylka = new Wysylka();
        $wysylka->kupujacy = $idKupujacy;
        $wysylka->sprzedajacy = $idSprzedajacy;
        $wysylka->oferta_id=$id;
        $wysylka->stan_wys=$user->email;
        $wysylka->save();

        //zmiana stanu oferty
        $oferta->data_zak = $date;
        $oferta->kupujacy = $idKupujacy;
        $oferta->sprzedajacy = $idSprzedajacy;
        $oferta->save();
        return redirect('/mojeZakupione');
    }

    public function confSprzedaz(Request $request, $id){
        $date = date('Y-m-d', time());
        $oferta = Oferta::find($id);
        $idSprzedajacy = Auth::id();

        if(is_null($oferta)){
            $error_message = "Oferta nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        } 
        $idKupujacy = $oferta->sprzedajacy;

        //stworzenie danych "tymczasowych" wysyłki
        $wysylka = new Wysylka();
        $wysylka->kupujacy = $idKupujacy;
        $wysylka->sprzedajacy = $idSprzedajacy;
        $wysylka->oferta_id=$id;
        $wysylka->stan_wys='Oczekiwanie na podanie danych wysyłki';
        $wysylka->save();

        //zmiana stanu oferty
        $oferta->data_zak = $date;
        $oferta->kupujacy = $idKupujacy;
        $oferta->sprzedajacy = $idSprzedajacy;
        $oferta->save();
        return redirect('/mojeSprzedane');
    }


    public function edit($Id)
    {
        $editOferta = Oferta::find($Id);
        if(isset($editOferta->data_zak)){
            $error_message = "Nie możesz edytować zakończonych ofert!";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        $ksiazkiZbazy = DB::table('ksiazki')->get();
        if($editOferta == null)
        {
            $error_message = "Oferta id=$Id nie znaleziona";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        if($editOferta->count() >0)
        return view('Oferty.edit', ['oferta' => $editOferta], ['ksiazki' => $ksiazkiZbazy]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'oferta_nazwa_ksiazki' => 'required',
            'oferta_typ_oferty' =>'required|max:1',
            'oferta_cena'=>'required',
            'oferta_opis'=>'required|max:500',
            'oferta_stan'=>'required',
        ]);

        if($validated)
        {
            $oferta = Oferta::find($id);
            if($oferta !=null){
                $oferta->Nazwa_ksiazki = $request ->oferta_nazwa_ksiazki;
                $oferta ->Typ_oferty = $request->oferta_typ_oferty;
                $oferta ->Cena = $request->oferta_cena;
                $oferta ->Opis = $request->oferta_opis;
                $oferta ->Stan = $request->oferta_stan;
                $oferta->save();
                return redirect('/mojeOferty');
            }
            else{
                $error_message = "Oferta id=$id nie znaleziona.";
                return view('oferty.message', ['message'=>$error_message, 'type_of_message'=>'Error']);
            }
        }
    }
    public function destroy($id)
    {
        $oferta = Oferta::find($id);
        if($oferta != null){
            $oferta->delete();
            return redirect('/mojeOferty');
        }
        else{
            $error_message = "Usuwanie nie udane, oferta o id=$id nie znaleziona";
            return view('oferty.message', ['message'=>$error_message, 'type_of_message'=>'Error']);
        } 
    }
    public function create()
    {
        $ksiazkiZbazy = DB::table('ksiazki')->get();
        return view('Oferty.add', ['ksiazki' => $ksiazkiZbazy]);
    }

    public function createKsiazka(){
        $idUser = Auth::id();
        if($idUser==1)
            return view('Ksiazki.add');
        else{
            $error_message = "Error 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
    }

    public function createDaneWysylki($id)
    {
        $oferta = Oferta::find($id);
        return view('Oferty.addDaneWysylki', ['oferta' => $oferta]);
    }

    public function zmienDaneWysylkiStrona($id)
    {
        $oferta = Oferta::find($id);
        return view('Oferty.zmienDaneWysylki', ['oferta' => $oferta]);
    }

    public function zmienDaneWysylki(Request $request, $id){
        $oferta = Oferta::find($id);
        $wysylka = Wysylka::where('oferta_id', $id)->first();

        if(is_null($oferta)){
            $error_message = "Oferta nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }

        if(is_null($wysylka)){
            $error_message = "Dane do wysyłki nie znalezione 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }

        $validated = $request->validate([
            'wysylka_miasto' => 'required',
            'wysylka_adres_1' => 'required',
            'wysylka_kod_pocztowy' => 'required',
            'wysylka_telefon' => 'required',
            'wysylka_imie_nazwisko' => 'required',
        ]);

        if($validated){
            $wysylka->miasto=$request->wysylka_miasto;
            $wysylka->adres_1=$request->wysylka_adres_1;
            $wysylka->adres_2=$request->wysylka_adres_2;
            $wysylka->kod_pocztowy=$request->wysylka_kod_pocztowy;
            $wysylka->telefon=$request->wysylka_telefon;
            $wysylka->imie_nazwisko=$request->wysylka_imie_nazwisko;
            $wysylka->stan_wys='Kupujacy otrzymal zamowienie';
            $wysylka->save();

            return redirect('/mojeZakupione');

        }else{
            $error_message = "Złe dane ERROR";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
    }

    public function wyswietlDaneWysylki($id){
        $wysylka = Wysylka::where('oferta_id', $id)->first();
        if(is_null($wysylka)){
            $error_message = "Dane do wysyłki nie znalezione 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        $oferta = Oferta::find($id);
        if(is_null($oferta)){
            $error_message = "Oferta nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
        return view('Oferty.wyswietlDaneWysylki', compact('wysylka'), ['oferta' => $oferta]);
    }

    public function storeDaneWysylki($id, Request $request){

        $oferta = Oferta::find($id);
        $idUser = Auth::id();
        $date = date('Y-m-d', time());

        if(is_null($oferta)){
            $error_message = "Oferta nie znaleziona 404";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        } 

        $validated = $request->validate([
            'wysylka_miasto' => 'required',
            'wysylka_adres_1' => 'required',
            'wysylka_kod_pocztowy' => 'required',
            'wysylka_telefon' => 'required',
            'wysylka_imie_nazwisko' => 'required',
        ]);

        if($validated){
            $wysylka = new Wysylka();
            $wysylka->kupujacy = $idUser;
            $wysylka->sprzedajacy = $oferta->sprzedajacy;
            $wysylka->oferta_id=$id;
            $wysylka->miasto=$request->wysylka_miasto;
            $wysylka->adres_1=$request->wysylka_adres_1;
            $wysylka->adres_2=$request->wysylka_adres_2;
            $wysylka->kod_pocztowy=$request->wysylka_kod_pocztowy;
            $wysylka->telefon=$request->wysylka_telefon;
            $wysylka->imie_nazwisko=$request->wysylka_imie_nazwisko;
            $wysylka->opcja_dost = $request->wysylka_opcja_dost;
            $wysylka->stan_wys='Kupujacy otrzymal zamowienie';
            $wysylka->save();

            //zmiana stanu oferty
            $oferta->data_zak = $date;
            $oferta->kupujacy = $idUser;
            $oferta->save();

            return redirect('/mojeZakupione');
        }else{
            $error_message = "Złe dane ERROR";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }
    }

    public function storeKsiazka(Request $request){

        $validated = $request->validate([
            'ksiazka_Nazwa' => 'required',
            'ksiazka_Gatunek' => 'required',
            'ksiazka_Data_wyd' => 'required',
            'ksiazka_Autorzy' => 'required',
        ]);

        if($validated){
            $ksiazka = new ksiazka();
            if($request->hasFile('image')){
                $destination_path = '/storage/img2/products';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                $path = $request->file('image')->move(public_path().$destination_path, $image_name);
                $ksiazka->image=$image_name;
            }
            $ksiazka->Nazwa=$request->ksiazka_Nazwa;
            $ksiazka->Opis=$request->ksiazka_Opis;
            $ksiazka->Gatunek=$request->ksiazka_Gatunek;
            $ksiazka->Data_wyd=$request->ksiazka_Data_wyd;
            $ksiazka->Autorzy=$request->ksiazka_Autorzy;
            $ksiazka->Wydawnictwo=$request->ksiazka_Wydawnictwo;
            $ksiazka->save();
            return redirect('/ksiazki');
        }else{
            $error_message = "Złe dane ERROR";
            return view('Oferty.message',['message'=>$error_message, 'type_of_message'=>'Error']);
        }

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'oferta_nazwa_ksiazki' => 'required',
            'oferta_typ_oferty' =>'required|max:1',
            'oferta_cena'=>'required',
            'oferta_opis'=>'required|max:500',
            'oferta_stan'=>'required',
        ]);

        if($validated)
        {
            $oferta = new Oferta();
            if($request->hasFile('image'))
            {
                $destination_path = '/storage/img2/products';
                //$destination_path = '/img';
                $image = $request->file('image');
                $image_name = $image->getClientOriginalName();
                //permisje:
                /*
                useradd -U -G www-data -m -c "deploy" deploybot
                chown deploybot:www-data /var/www/laravel
                chmod 2755 /var/www/laravel
                sudo usermod -aG www-data deploybot
                sudo chown -R www-data:www-data /var/www/laravel
                sudo chown -R www-data:www-data /var/www/laravel/public/uploads
                sudo chmod -R 775 /var/www
                */
                $path = $request->file('image')->move(public_path().$destination_path, $image_name);
                //$path = $request->file('image')->storePubliclyAs(public_path().$destination_path, $image_name);
                //File::deleteDirectory(public_path('public/img/products'));
                $oferta->image = $image_name;
            }
            $id = Auth::id();
            $date = date('Y-m-d', time());
            $oferta->Nazwa_ksiazki = $request ->oferta_nazwa_ksiazki;
            $oferta ->Typ_oferty = $request->oferta_typ_oferty;
            $oferta ->Cena = $request->oferta_cena;
            $oferta ->Opis = $request->oferta_opis;
            $oferta ->Stan = $request->oferta_stan;
            $oferta ->data_dod = $date;
            $oferta ->sprzedajacy = $id;
            $oferta->save();
            return redirect('/mojeOferty');
        }
    }
}
