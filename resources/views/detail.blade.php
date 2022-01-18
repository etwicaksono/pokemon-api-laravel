@extends('layout.app',["title"=>"Detail Pokemon","csrf"=>true])

@section('content')
<p class="h1 mt-3" id="current-name">{{ $data["name"] }}</p>

<div class="d-flex flex-row justify-content-between flex-wrap mb-5">
    @foreach ($data["img"] as $item)
    <div class="card m-2" style="width: 18rem;">
        <img src="{{ $item }}" class="card-img-top" alt="{{ $data['name'] }}">
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col">
        @if (isset($data["my_pokemon"]) || $data["catched"])
        <button class="btn btn-info float-right ml-5" id="btn-release" data-id="{{ $data['id'] }}"
            data-name="{{ $data['name'] }}">Release Pokemon</button>

        <form class="form-inline my-2 my-lg-0 float-right" id="form-rename">
            <input class="form-control mr-sm-2" type="text" placeholder="Rename Pokemon" aria-label="Rename Pokemon"
                id="input-rename">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="btn-rename"
                data-id="{{ $data['id'] }}">Rename</button>
        </form>

        @else

        <button class="btn btn-info float-right" id="btn-catch" data-id="{{ $data['id'] }}"
            data-name="{{ $data['name'] }}"><span class="fas fa-circle" id="indicator"></span> Catch Pokemon</button>
        @endif
    </div>
</div>

<p class="h3 mt-5">Moves</p>
<p class="text-justify">{{ $data["move"] }}</p>

<p class="h3 mt-5">Types</p>
<p class="text-justify">{{ $data["type"] }}</p>

@endsection

@push('js')
@if (isset($data["my_pokemon"]) || $data["catched"])
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"

        // release pokemon
        $("#btn-release").on("click",function(){
            let id = $(this).data("id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:baseurl+"release-pokemon",
                dataType:"json",
                data:{
                    id:id
                },
                method:"post",
                error:function(err){
                    console.log(err)
                },success:function(res){
                    
                    if(res.success){
                        Swal.fire({
                        title: 'Released!',
                        text: name + ' has released, returned number '+ res.number + ' is prime number',
                        icon: 'success',
                        }).then(function(){
                            window.location.reload()
                        })
                    }else{
                        Swal.fire({
                        title: 'Failed!',
                        text: name + ' failed to release, returned number '+ res.number + ' is not prime number',
                        icon: 'warning',
                        })
                    }
                }
            })
        })

        // rename pokemon
        $("#btn-rename").on("click",function(){
            event.preventDefault()

            let id = $(this).data("id");
            let current_name= $("#current-name").html()
            let new_name = $("#input-rename").val()

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:baseurl+"rename-pokemon",
                dataType:"json",
                data:{
                    id:id,
                    name:new_name
                },
                method:"post",
                error:function(err){
                    console.log(err)
                },success:function(res){
                    console.log(res)
                    if(res.success){
                        Swal.fire({
                        title: 'Renamed!',
                        text: 'Pokemon has renamed from ' + current_name +' to '+res.name,
                        icon: 'success',
                        }).then(function(){
                            window.location.reload()
                        })
                    }else{
                        Swal.fire({
                        title: 'Failed!',
                        text: 'Failed to rename pokemon.',
                        icon: 'warning',
                        })
                    }
                }
            })
        })
    })

</script>
@else
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"
        let parameter = 0

        // catch pokemon
        $("#btn-catch").on("click",function(){
            let id = $(this).data("id");
            let name = $(this).data("name");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:baseurl+"catch-pokemon",
                dataType:"json",
                data:{
                    id:id,
                    name:name,
                    parameter:parameter,
                },
                method:"post",
                error:function(err){
                    console.log(err)
                },success:function(res){
                    if(res.success){
                        Swal.fire({
                        title: 'Catched!',
                        text: name + ' has catched',
                        icon: 'success',
                        }).then(function(){
                            window.location.reload()
                        })
                    }else{
                        Swal.fire({
                        title: 'Failed!',
                        text: name + ' failed to catch',
                        icon: 'warning',
                        })
                    }
                }
            })
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
@endif
@endpush