<?php

namespace App\Http\Controllers;

use App\Models\MyPokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

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
            ];
        }

        return view('home', [
            "data" => $data,
            "next" => $response["next"]
        ]);
    }

    public function myPokemon()
    {
        $pokemon = MyPokemon::all();
        $response = Http::get("https://pokeapi.co/api/v2/pokemon")->json();

        $data = [];
        foreach ($pokemon as $poke) {
            $data[] = [
                "id" => $poke->id_pokemon,
                "name" => $poke->name,
            ];
        }

        return view('my-pokemon', compact("data"));
    }


    public function detail($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/" . $id)->json();
        $catched = false;

        $pokemon = MyPokemon::where("id_pokemon", $id)->first();
        if ($pokemon) $catched = true;

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
            "id" => ($catched ? $pokemon->id : $id),
            "name" => ($catched ? $pokemon->name : $response["name"]),
            "move" => \implode(", ", $move),
            "img" => $img,
            "type" => \implode(", ", $type),
            "catched" => $catched
        ];
        return view('detail', compact("data"));
    }

    public function catchPokemon(Request $request)
    {
        try {
            $success = false;
            if ($request->parameter % 2 == 0) {
                MyPokemon::create([
                    "id_pokemon" => $request->id,
                    "name" => $request->name,
                    "rename_count" => 0
                ]);
                $success = true;
            }

            return \response()->json([
                "error" => false,
                "success" => $success
            ], \http_response_code());
        } catch (Throwable $t) {
            return \response()->json([
                "error" => true,
                "message" => $t->getMessage()
            ], \http_response_code());
        }
    }

    public function releasePokemon(Request $request)
    {
        try {
            $success = false;
            $random = \rand(1, 100);
            if (\isPrime($random)) {
                $pokemon = MyPokemon::find($request->id);
                $pokemon->delete($request->id);
                $success = true;
            }

            return \response()->json([
                "error" => false,
                "success" => $success,
                "number" => $random
            ], \http_response_code());
        } catch (Throwable $t) {
            return \response()->json([
                "error" => true,
                "message" => $t->getMessage()
            ], \http_response_code());
        }
    }

    public function renamePokemon(Request $request)
    {
        try {
            $success = false;

            $pokemon = MyPokemon::find($request->id);

            $new_name = $request->name . "-" . \getFibonacci($pokemon->rename_count + 1);
            $pokemon->rename_count++;

            $pokemon->name = $new_name;
            $pokemon->save();
            $success = true;

            return \response()->json([
                "error" => false,
                "success" => $success,
                "name" => $new_name
            ], \http_response_code());
        } catch (Throwable $t) {
            return \response()->json([
                "error" => true,
                "message" => $t->getMessage()
            ], \http_response_code());
        }
    }
}