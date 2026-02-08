<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart', compact('cart', 'total'));
    }

    // إضافة منتج للسلة
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $cart = session()->get('cart', []);
        
        // لو المنتج موجود في السلة، زود الكمية
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            // لو مش موجود، أضفه
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => $request->quantity ?? 1,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'تم إضافة المنتج للسلة');
    }

    // تحديث الكمية
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'تم تحديث السلة');
    }

    // حذف منتج من السلة
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    // إفراغ السلة
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'تم إفراغ السلة');
    }
}