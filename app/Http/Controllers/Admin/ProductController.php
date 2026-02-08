<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index',compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
        $data = $request->all();

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);
        $data['image'] = $imageName;
    }

    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit',compact('product','categories'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
            if ($request->hasFile('image')) {
        // حذف الصورة القديمة لو موجودة
        if ($product->image && file_exists(public_path('images/products/'.$product->image))) {
            unlink(public_path('images/products/'.$product->image));
        }
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);
        $data['image'] = $imageName;
    }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');

    }

    public function destroy(Product $product)
    {
            if ($product->image && file_exists(public_path('images/products/'.$product->image))) {
        unlink(public_path('images/products/'.$product->image));
    }
    
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
