<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::all();
        $subCategories = subcategory::all();
        // return "Product Created";
        return view('products.index', [
            'categories' => $categories,
            'subCategories' => $subCategories,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = subcategory::all();
    
        return view('products.create' , [
            'categories' => $categories,
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = request()->validate([
            'title' =>'required|min:1|max:300' ,
            'description' => 'required|min:1',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price' =>'required|integer|digits_between:1,10' ,
            'thumbnail' => 'image'
        ]);

        //// dd($validate_data);

        $product = Product::create(request()->except('_token' ,'category_id'));

        if(request()->hasFile('thumbnail'))
        {
            $ext = request()->file('thumbnail')->getClientOriginalExtension();
            $file_name = $product->id . '.' . $ext;
            request()->file('thumbnail')->move('uploads/products' , $file_name ); 

            $product->update([
                'thumbnail' => $file_name
            ]);
        }

        return redirect('/products')->with('success','Product Created Successfully');

        //////ajax  code below 
        // $validator = Validator::make(request()->all(),[
        //     'title' =>'required|min:1|max:300' ,
        //     'description' => 'required|min:1',
        //     // 'category_id' => 'required|exists:categories,id',
        //     'subcategory_id' => 'required|exists:subcategories,id',
        //     'price' =>'required|integer|digits_between:1,10' ,
        //     'thumbnail' => 'image'
        // ]);
        // if($validator->fails())
        // {
        //     // return $validator->errors();
        //     return ['status' =>false, 'message'=>'Data validation failed!'];
        // }

        // $product = Product::create(request()->all());

        // if(request()->hasFile('thumbnail'))
        // {
        //     $ext = request()->file('thumbnail')->getClientOriginalExtension();
        //     $file_name = $product->id . '.' . $ext;
        //     request()->file('thumbnail')->move('uploads/products' , $file_name ); 

        //     $product->update([
        //         'thumbnail' => $file_name
        //     ]);
        // }

        // return ['status' =>true, 'message'=>'Inserted data Successfully.'];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('success','Product deleted Successfully');
    }
}
