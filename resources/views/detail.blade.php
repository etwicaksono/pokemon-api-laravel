@extends('layout.app',["title"=>"Detail Pokemon"])

@section('content')
<p class="h1 mt-3">{{ $data["name"] }}</p>

<div class="d-flex flex-row justify-content-between flex-wrap">
    @foreach ($data["img"] as $item)
    <div class="card m-2" style="width: 18rem;">
        <img src="{{ $item }}" class="card-img-top" alt="{{ $data['name'] }}">
    </div>
    @endforeach
</div>

<button class="btn btn-info float-right" id="btn-catch">Catch Pokemon</button>

<p class="h3 mt-5">Moves</p>
<p class="text-justify">{{ $data["move"] }}</p>

<p class="h3 mt-5">Types</p>
<p class="text-justify">{{ $data["type"] }}</p>

@endsection