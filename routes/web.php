<?php

use App\Http\Controllers\Pokemon;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Pokemon::class, "index"]);
Route::get('/my-pokemon', [Pokemon::class, "myPokemon"]);
Route::get('/detail/{id}', [Pokemon::class, "detail"]);

Route::post("/catch-pokemon", [Pokemon::class, "cathPokemon"]);