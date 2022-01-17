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

        $img = [];
        foreach ($response["sprites"] as $image) {
            if ($image != null && !\is_array($image)) $img[] = $image;
        }

        $move = [];
        foreach ($response["moves"] as $m) {
            $move[] = $m["move"]["name"];
        }
        \sort($move);

        $type = [];
        foreach ($response["types"] as $t) {
            $type[] = $t["type"]["name"];
        }
        \sort($type);

        $data = [
            "id" => $id,
            "name" => $response["name"],
            "move" => \implode(", ", $move),
            "img" => $img,
            "type" => \implode(", ", $type),
        ];
        return view('detail', compact("data"));
    }
}