<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    /*  $client = new Client([
        'base_uri' => 'https://pokeapi.co/',
        // default timeout 5 detik
        'timeout'  => 5,
    ]);
    $response = $client->request('GET', 'api/v2/pokemon'); */

    // $response = Http::get("https://pokeapi.co/api/v2/pokemon")->json();

    /* $client = new Client();
    $request = $client->get("https://pokeapi.co/api/v2/pokemon");
    $response = $request->getBody(); */

    $client = new Client();
    $request = new Request("GET", "https://pokeapi.co/api/v2/pokemon");
    $response = $client->send($request, ["timeout" => 2]);

    dd($response);

    return view('welcome');
});