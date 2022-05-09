@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Product Create  (mosharaf111hossain@gmail.com)') }}
                    {{--for ajax   modal are created--}}
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                        Add New Product
                    </button>
                    <div class="card-body">

                        @include('partials.success_message')
    
                        <table class="table table-bordered table-hover table-striped">
                            {{-- ajax code to show inseted data and delete but skipped --}}
                            <tr>
                                <th>#ID</th>
                                <th>Thumnail</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Created At</th>
                               
                                <th>Action</th>
    
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Image</td>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Price</td>
                                <td>Created At</td>
                                <td><a href="" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
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
                                <div id="validation_mesg" class="alert" role="alert"></div>

                               <form action="/products/create" method="POST" enctype="multipart/form-data" id="product_form" >
                           
                                <div class="form-group">
                                    <label for="title">Product Title</label>
                                    <input type="text" name="title"  class="form-control"  placeholder="Product Name">
                                   
                                    <span class="text-danger error-text title_error"></span>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="description">Product description</label>
                                    <input type="text" id="description" name="description"  class="form-control "  placeholder="Product description">
                                    
                                    <span class="text-danger error-text description_error"></span>
                                </div> --}}

                                <div class="form-group">
                                    <label for="description">Product description</label>
                                    <textarea id="description"  id="description" class="form-control" 
                                        name="description" placeholder="Product description" rows="4">
                                    </textarea>
                                    <span class="text-danger error-text description_error"></span>

                                    
                                </div>

                                {{-- Categories skipped --}}

                                {{-- <div class="form-group">
                                    <label for="category_id">Product Category</label>
            
                                    <select id="category_id" type="text" class="form-control " name="category_id" placeholder="Product category">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $category)
                                          <option value="{{ $category->id }}"> {{ $category->title }} </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text category_id_error"></span>
                                            
                                </div> --}}

                                {{-- subCategories --}}

                                <div class="form-group">
                                    <label for="subcategory_id">Product Sub Category</label>
            
                                    <select id="subcategory_id" type="text" class="form-control" 
                                    name="subcategory_id" placeholder="Product Sub category">
                                        <option value="">Select a Category</option>

                                        @foreach ($subCategories as $subCategory)
                                          <option value="{{ $subCategory->id }}"> {{ $subCategory->title }} </option>
                                        @endforeach

                                    </select>
            
                                    <span class="text-danger error-text subcategory_id_error"></span>
                                </div>
            
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" name="price"  class="form-control"  placeholder="Product Price">
                                   
                                    <span class="text-danger error-text price_error"></span>
                                
                                </div>
            
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail</label>
                                    <input id="thumbnail" type="file" name="thumbnail"  class="form-control" 
                                     placeholder="thumbnail" >

                                    <span class="text-danger error-text thumbnail_error"></span>
                                </div>


                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>

                         </form>

                       </div>
                    </div>
                </div>
                    {{-- end of  ajax code /////////////////////////////////////////--}}

                    {{--  Product create without ajax///////////// --}}

                <form action="/products/create" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" name="title"  class="form-control @error('title') is-invalid @enderror"  placeholder="Product Name">
                        @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description"  
                        id="description"
                        class="form-control @error('description') is-invalid @enderror" 
                        name="description" placeholder="description" rows="5">
                        </textarea>
                        @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Product Category</label>

                        <select id="category_id" type="text" class="form-control @error('category_id') is-invalid @enderror" name="category_id" placeholder="Product category">
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"> {{ $category->title }} </option>
                            @endforeach
                        </select>

                        @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                     </div> 


                     <div class="form-group"> 
                        <label for="subcategory_id">Product Sub Category</label>

                        <select id="subcategory_id" type="text" class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" placeholder="Product Sub category">
                            <option value="">Select a Category</option>
                            @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"> {{ $subCategory->title }} </option>
                            @endforeach
                        </select>

                        @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Product Price</label>
                        <input type="text" name="price"  class="form-control @error('price') is-invalid @enderror"  placeholder="Product Price">
                        @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input id="thumbnail" type="file" name="thumbnail"  class="form-control @error('thumbnail') is-invalid @enderror " 
                        placeholder="thumbnail" >

                        @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-sm" >Create Product</button>
                    
                </form>

       {{-- end of Product create without ajax --}}

                

                </div> 

            </div>
        </div>
    </div>
</div>

@section('script')
<script>

//// ajax code  below

$(document).ready(function(){
    alert("Hello");
   var form = '#product_form';

    $(form).on('submit', function(event){
        event.preventDefault();

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                url:"/products/create",
                method:'POST',
                data: new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                $(document).find('span.error-text').text('');
                 },
                success:function(res){
                    console.log(res,"success");
                    if(res.status == 0)
                    {
                        $('#validation_mesg').addClass('alert-danger').show().html(res.message);
                        $.each(res.error, function(prefix, val){
                                  $('span.'+prefix+'_error').text(val[0]);
                              });
                    }else{
                        $('#validation_mesg').addClass('alert-success').show().html(res.message);
                        $('#product_form')[0].reset();
                    }
                    hide_alert();
                }
                
            });
            function hide_alert(){
                setTimeout(() => {
                    $('.alert').removeClass('alert-danger').removeClass('alert-success').fadeOut();
                }, 3000);
            }
    });

});


    // ClassicEditor ck editor
// this create problem on ajax

.create( document.querySelector( '#description' ) )
    .then( editor => {
            console.log( editor );
    } )
    .catch( error => {
            console.error( error );
    } );

</script>
@endsection

@endsection