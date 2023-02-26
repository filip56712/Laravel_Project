<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wydawnictwo extends Model
{
    public $timestamps = false;
    protected $table = 'wydawnictwa';
    protected $primaryKey = 'Nazwa';
    protected $fillable = ['Ksiazki','Opis', 'Id'];
    //metoda odczytująca ksiazki danego wydawnictwa
    public function ksiazki(){
        return $this->hasMany(ksiazka::class);
    }
    //use HasFactory;
}
