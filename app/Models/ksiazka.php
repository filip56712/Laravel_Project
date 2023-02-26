<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ksiazka extends Model
{
    public $timestamps = false;
    protected $table = 'ksiazki';
    protected $primaryKey = 'Nazwa';
    protected $fillable = ['Opis','Gatunek', 'Data_wyd', 'Autorzy', 'Wydawnictwo', 'image'];
    //use HasFactory;
}
