<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wysylka extends Model
{
    public $timestamps = false;
    protected $table = 'wysylka';
    protected $primaryKey = 'id';
    protected $fillable = ['kupujacy','sprzedajacy', 'oferta_id', 'miasto', 'adres_1', 'adres_2', 'kod_pocztowy', 'telefon', 'imie_nazwisko', 'stan_wys', 'opcja_dost'];
    use HasFactory;
}
