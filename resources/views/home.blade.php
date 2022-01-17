@extends('layout.app',["title"=>"Home"])

@section('content')
<p class="h1 my-2">List Pokemon</p>

<div class="d-flex flex-row justify-content-center flex-wrap" id="pokemon-wrapper">
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


<div class="row justify-content-center">
    <button class="btn btn-success my-5 align-self-center" id="btn-reload"><span class="fas fa-redo-alt"></span> Load
        More</button>
</div>
@endsection

@push('js')
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"
        let next = "{{ $next }}"

        $("#btn-reload").on("click",function(){
            $.ajax({
                url:next,
                method:"get",
                dataType:"json",
                error:function(err){
                    console.log(err);
                },success:function(res){
                    console.log(res);
                    next = res.next

                    let output=""
                    $.each(res.results,function(key, value){
                    let temp = value.url.slice(0,-1).split("/")
                    let id = temp[temp.length-1];
                    

                    output+=`
                    <a href="` + baseurl + `detail/`+ id +`">
                        <div class="card m-2" style="width: 18rem;">
                            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/` + id + `.png"
                                class="card-img-top" alt="` + value.name +`">
                            <div class="card-body">
                                <p class="card-text text-center h3">` + value.name +`</p>
                            </div>
                        </div>
                    </a>
                    `

                    })
                    $("#pokemon-wrapper").append(output)

                }
            })
        })
    })
</script>
@endpush