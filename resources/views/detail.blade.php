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

<button class="btn btn-info float-right" id="btn-catch" data-id="{{ $data['id'] }}"
    data-name="{{ $data['name'] }}"><span class="fas fa-circle" id="indicator"></span> Catch Pokemon</button>

<p class="h3 mt-5">Moves</p>
<p class="text-justify">{{ $data["move"] }}</p>

<p class="h3 mt-5">Types</p>
<p class="text-justify">{{ $data["type"] }}</p>

@endsection

@push('js')
<script>
    $(function(){
        let parameter = 0

        $("#btn-catch").on("click",function(){
            let id = $(this).data("id");
            let name = $(this).data("name");
            
            if(parameter % 2 == 0){
                Swal.fire({
                title: 'Catched!',
                text: name + ' has catched | ' + id,
                icon: 'success',
                })
            }else{
                Swal.fire({
                title: 'Failed!',
                text: name + ' failed to catch | ' + id,
                icon: 'warning',
                })
            }
        })


        setInterval(() => {
            parameter++;
            if(parameter % 2 == 0){
                $("#indicator").css("color","#00ff48")
            }else{
                $("#indicator").css("color","#ffffff")
            }

        }, 1000);
    })

</script>
@endpush