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
    
                        <table class="table table-bordered table-hover table-striped" >
                            {{-- ajax code to show inseted data and delete but skipped --}}
                            <thead>

                           
                            <tr>
                                <th>#ID</th>
                                <th>Thumnail</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Created At</th>
                            
                                <th>Action</th>
    
                            </tr>
                        </thead>
                        <tbody id="prouduct_tdata">

                        

                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        @if ($product->thumbnail)
                                            <img src="{{$product->thumbnail_path()}}" class="rounded-circle" 
                                            style=" float:left; margin-right:15px; " alt="Thumbnail" width="60">
                                        @endif
                                    </td>
                                    <td>{{$product->title}}</td>
                                    <td>{!!$product->description!!}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->created_at->diffForHumans()}}</td>

                                    <td><a href="/products/{{$product->id}}" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>
                            @endforeach

                        </tbody>
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

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <label for="title">Product Title</label>
                                    <input type="text" name="title"  class="form-control" 
                                      placeholder="Product Name">
                                   
                                    <span class="text-danger error-text title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="description">Product description</label>
                                    <textarea id="description"  id="description" class="form-control" 
                                        name="description" placeholder="Product description" rows="4">
                                         </textarea>
                                    <span class="text-danger error-text description_error"></span>

                                    
                                </div>

                                <div class="form-group">
                                    <label for="subcategory_id">Product Sub Category</label>
            
                                    <select id="subcategory_id" type="text" class="form-control" 
                                    name="subcategory_id" placeholder="Product Sub category">
                                        <option value="">Select a Category</option>

                                        @foreach ($subCategories as $subCategory)
                                          <option value="{{ $subCategory->id }}"  > {{ $subCategory->title }} </option>
                                        @endforeach

                                    </select>
            
                                    <span class="text-danger error-text subcategory_id_error"></span>
                                </div>
            
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="text" name="price"  class="form-control"   placeholder="Product Price">
                                   
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

                {{-- <form action="/products/create" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" name="title"  class="form-control @error('title') is-invalid @enderror" 
                             value="{{old('title')}}"  placeholder="Product Name">
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
                        name="description" placeholder="description" rows="4">
                          {{old('description')}} </textarea>
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
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} > {{ $category->title }} </option>
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
                            <option value="{{ $subCategory->id }}"  {{ old('subcategory_id') == $subCategory->id ? 'selected' : '' }} > {{ $subCategory->title }} </option>
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
                        <input type="text" name="price"  class="form-control @error('price') is-invalid @enderror"
                             value="{{old('price')}}"  placeholder="Product Price">
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
                    
                </form> --}}

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

                        var t_data = ` 
                            <tr>
                                <td>${res.data.id}</td>
                                <td>
                                    <img src="/uploads/products/${res.data.thumbnail}" class="rounded-circle" 
                                    style=" float:left; margin-right:15px; " alt="Thumbnail_Image" width="60">
                                </td>
                                <td>${res.data.title}</td>
                                <td>${res.data.description}</td>
                                <td>${res.data.price}</td>
                              
                                <td>{{$product->created_at->diffForHumans()}}</td>

                                <td><a href="/products/${res.data.id}" class="btn btn-danger btn-sm">Delete</a></td>

                            </tr>
                         `;
                        $('#prouduct_tdata').append(t_data);

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
// .create( document.querySelector( '#description' ) )
//     .then( editor => {
//             console.log( editor );
//     } )
//     .catch( error => {
//             console.error( error );
//     } );

</script>
@endsection

@endsection