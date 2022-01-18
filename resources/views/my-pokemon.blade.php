@extends('layout.app',["title"=>"My Pokemon"])

@section('content')
<p class="h1 my-2">My Pokemon</p>

<div class="d-flex flex-row justify-content-center flex-wrap">
    @if (!empty($data))
    @foreach ($data as $item)
    <a href="{{ url('detail/'.$item['id']) }}">
        <div class="card m-2" style="width: 18rem;">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $item['id'] }}.png"
                class="card-img-top" alt="{{ $item['name'] }}">
            <div class="card-body">
                <p class="card-text text-center h3">{{ $item["name"] }}</p>
            </div>
        </div>
    </a>
    @endforeach
    @else
    <p class="h1 text-center mt-5 text-black-50">You don't have any pokemon!</p>
    @endif
</div>


@endsection