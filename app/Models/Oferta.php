<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    public $timestamps = false; 
    protected $table = 'oferty';
    protected $primaryKey = 'Id';
    protected $fillable = ['Typ_oferty','Nazwa_ksiazki', 'Cena', 'Opis', 'Stan', 'data_dod', 'data_zak', 'sprzedajacy', 'image', 'kupujacy'];
    
    //use HasFactory;
}
