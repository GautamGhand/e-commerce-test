<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.product.index', [
            'products' => $products
        ]);
    }
    public function create()
    {
        return view('admin.product.create');
    }
    public function store(ProductStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'image' => Storage::disk('public')->put('products', $request->file('image'))
        ];
        Product::create($data);
        return Redirect::route('admin.products.index')->withSuccess('Product Created Successfully');
    }
    public function edit($uuid)
    {
        $product = Product::where('uuid',$uuid)->firstOrFail();
        return view('admin.product.edit',[
            'product' => $product
        ]);
    }
    public function update(ProductUpdateRequest $request,$uuid)
    {
        $product = Product::where('uuid',$uuid)->firstOrFail();
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
        ];
        if($request->hasFile('image')){
            $data['image'] = Storage::disk('public')->put('products', $request->file('image'));
        }
        $product->update($data);
        return Redirect::route('admin.products.index')->withSuccess('Product Updated Successfully');
    }
    public function destroy($uuid)
    {
        $product = Product::where('uuid', $uuid)->firstOrFail();
        $product->delete();
        return Redirect::route('admin.products.index')->withSuccess('Product Deleted Successfully!');
    }
}
