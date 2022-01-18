@extends('layout.app',["title"=>"My Pokemon","csrf"=>true])

@section('content')
<p class="h1 my-2">My Pokemon</p>

<div class="d-flex flex-row justify-content-center flex-wrap">
    @if (!empty($data))
    @foreach ($data as $item)
    <div class="card m-2" style="width: 18rem;">
        <a href="{{ url('detail/'.$item['id']) }}">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{{ $item['id'] }}.png"
                class="card-img-top" alt="{{ $item['name'] }}">
            <div class="card-body">
                <p class="card-text text-center h3">{{ $item["name"] }}</p>
            </div>
        </a>
        <button class="btn btn-info btn-rename" data-id="{{ $item['id_rename'] }}"
            data-name="{{ $item['name_origin'] }}">Rename</button>
    </div>
    @endforeach
    @else
    <p class="h1 text-center mt-5 text-black-50">You don't have any pokemon!</p>
    @endif
</div>


@endsection

@push('js')
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"

        $(".btn-rename").on("click",function(){
            event.preventDefault()

            let id = $(this).data("id");
            let name = $(this).data("name");

           if(name!=""){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:baseurl+"rename-pokemon",
                    dataType:"json",
                    data:{
                        id:id,
                        name:name
                    },
                    method:"post",
                    error:function(err){
                        console.log(err)
                    },success:function(res){
                        console.log(res)
                        if(res.success){
                            Swal.fire({
                            title: 'Renamed!',
                            text: 'Pokemon has renamed from ' + name +' to '+res.name,
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
           }else{
                Swal.fire({
                        title: 'Warning!',
                        text:  'Enter pokemon name!',
                        icon: 'warning',
                        })
           }
        })
    })
</script>
@endpush