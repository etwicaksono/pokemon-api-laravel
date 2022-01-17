<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPokemon extends Model
{
    use HasFactory;
    protected $table = "my_pokemon";
    protected $fillable = ["id_pokemon", "name", "rename_count"];
}