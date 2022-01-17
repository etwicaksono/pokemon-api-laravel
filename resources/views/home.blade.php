@extends('layout.app',["title"=>"Home"])

@section('content')
<p class="h1 my-2">List Pokemon</p>

<div class="d-flex flex-row justify-content-between flex-wrap">
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
</div>


@endsection

@push('js')

@endpush