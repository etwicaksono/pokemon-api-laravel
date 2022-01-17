<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Pokemon extends Controller
{
    public function index()
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon")->json();

        $data = [];
        foreach ($response["results"] as $res) {
            $temp = explode("/", trim($res["url"], "/"));
            $id = $temp[count($temp) - 1];
            $data[] = [
                "id" => $id,
                "name" => $res["name"],
                "url" => $res["url"]
            ];
        }

        return view('home', compact("data"));
    }


    public function detail($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $id)->json();
        return view('detail', compact("response"));
    }
}