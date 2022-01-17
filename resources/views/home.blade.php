@extends('layout.app',["title"=>"Home"])

@section('content')
@foreach ($data as $item)
{{ $item["name"] }}
<img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $item['id'] }}.png"
    alt="Gambar Pokemon" style="width: 150px"> <br>
@endforeach
@endsection