@extends('layouts.app')

@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                    <div class="card-header">{{ __('Country Add  (mosharaf111hossain@gmail.com)') }}
                        {{--for ajax   modal are created--}}
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                            Add New Country
                        </button>
                            <div class="card-body">

                                @include('partials.success_message')
            
                                <table class="table table-bordered table-hover table-striped">
                                    {{-- ajax code to show inseted data and delete but skipped --}}
                                    <tr>
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Action</th>
            
                                    </tr>
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Image</td>
                                        <td>Title</td>
                                        <td>Description</td>
                                        <td>Price</td>
                                        <td>Created At</td>
                                        <td><a href="" class="btn btn-danger btn-sm">Delete</a></td>
                                    </tr> --}}
                                </table>
                            </div>

                    </div>

                    <div class="card-body">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>

                                <div class="modal-body">
                                    <div id="validation_mesg" class="alert" role="alert">
                                        
                                    </div>
                                <form action="" id="product_add" >
                                    
                                    {{-- @csrf --}}
                                

                                    <div class="form-group">
                                        <label for="name">Conutry Name</label>
                                        <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror"  placeholder="Country Name">
                                        @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="capital">Conutry Capital</label>
                                        <input type="text" id="capital" name="capital"  class="form-control @error('capital') is-invalid @enderror"  placeholder="Country Capital">
                                        @error('capital')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="population">Conutry Population</label>
                                        <input type="text" id="population" name="population"  class="form-control @error('description') is-invalid @enderror"  placeholder="Country population">
                                        @error('population')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="thumbnail">Thumbnail</label>
                                        <input id="thumbnail" type="file" name="thumbnail"  class="form-control @error('thumbnail') is-invalid @enderror " 
                                        placeholder="thumbnail" >
                
                                        @error('thumbnail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div> --}}


                                </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Country</button>
                                </div>

                            </form>
                        </div>
                        </div>
                    </div>
                        {{-- end of file ajax code --}}
            </div>
        </div>
    </div>
</div>
@section('script')
<script>

    // ClassicEditor
    //         .create( document.querySelector( '#description' ) )
    //         .then( editor => {
    //                 console.log( editor );
    //         } )
    //         .catch( error => {
    //                 console.error( error );
    //         } );

//// ajax code  below

$(function(){
        // alert("Hello");
        $('#product_add').submit(function(e){
            e.preventDefault();

            // var title = $('input[name="title"]').val();
            // console.log(title );

            // console.log( $('#product_add').serialize() );

            var form_data =  $('#product_add').serialize();        

            $.ajax({
                url:"/products",
                method:'POST',
                data: form_data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(res){
                    // console.log(res,"success");
                    if(!res.status)
                    {
                        $('#validation_mesg').addClass('alert-danger').show().html(res.message);
                    }else{
                        $('#validation_mesg').addClass('alert-success').show().html(res.message);
                    }
                    hide_alert();
                },
                error:function(res){
                    console.log(res);

                }
            });
        });
        // ///////
    function hide_alert(){
        setTimeout(() => {
            $('.alert').removeClass('alert-danger').removeClass('alert-success').fadeOut();
        }, 3000);
    }

});


</script>
@endsection

@endsection