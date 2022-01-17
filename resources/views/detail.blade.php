@extends('layout.app',["title"=>"Detail Pokemon","csrf"=>true])

@section('content')
<p class="h1 mt-3">{{ $data["name"] }}</p>

<div class="d-flex flex-row justify-content-between flex-wrap">
    @foreach ($data["img"] as $item)
    <div class="card m-2" style="width: 18rem;">
        <img src="{{ $item }}" class="card-img-top" alt="{{ $data['name'] }}">
    </div>
    @endforeach
</div>

@if (isset($data["my_pokemon"]) || $data["catched"])
<button class="btn btn-info float-right" id="btn-release" data-id="{{ $data['id'] }}"
    data-name="{{ $data['name'] }}">Release Pokemon</button>
@else
<button class="btn btn-info float-right" id="btn-catch" data-id="{{ $data['id'] }}"
    data-name="{{ $data['name'] }}"><span class="fas fa-circle" id="indicator"></span> Catch Pokemon</button>
@endif

<p class="h3 mt-5">Moves</p>
<p class="text-justify">{{ $data["move"] }}</p>

<p class="h3 mt-5">Types</p>
<p class="text-justify">{{ $data["type"] }}</p>

@endsection

@push('js')
@if (isset($data["my_pokemon"]) || $data["catched"])

@else
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"
        let parameter = 0

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