<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class HomeController extends Controller
{
    public function index(){
        $products = Product::with('category')->latest()->take(12)->get();
        $categories = Category::all();

        return view('welcome',compact('products','categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product-detail',compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $products = Product::with('category')
        ->where('name','LIKE',"%{$query}%")
        ->orwhere('description','LIKE',"%{$query}")
        ->orwhereHas('category', function($q) use ($query){
            $q->where('name', 'LIKE', "%{$query}%");

    })   

    ->get();
    
    $categories = Category::all();
    
    return view('search-results', compact('products', 'categories', 'query'));

    }

    public function products(Request $request)
    {
        $query = Product::with('category');
            // فلترة حسب الفئة
        if($request->has('category') && $request->category != ''){
            $query->where('category_id', $request->category);
        }  
        
            // ترتيب حسب السعر

        if($request->has('sort')){
            if($request->sort == 'price_asc'){
                $query->orderBy('price','asc');
            }elseif($request->sort == 'price_desc'){
                $query->orderBy('price','desc');
            }elseif($request->sort == 'name'){
                $query->orderBy('name','asc');
            }
        } else{
            $query->latest();
        }
        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products',compact('products','categories'));
    }
    


}