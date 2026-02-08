<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
class OrderController extends Controller
{
    public function checkout()
    {

    $cart = session()->get('cart',[]);
    
    if(count($cart) == 0){
        return redirect()->route('cart.index')->with('error', 'السله فارغة');
    }
    $total = 0;
    foreach($cart as $item){
        $total += $item['price'] * $item['quantity'];
    }
        return view('checkout',compact('cart','total'));
    }

    // حذف الطلب 
    public function store(Request $request)
    {
        $request -> validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);
        $cart = session()->get('cart',[]);
        if(count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }
                // حساب الإجمالي
        $total = 0;
        foreach($cart as $item) {
                $total += $item['price'] * $item['quantity'];
        }

            
        // إنشاء الطلب
        $order = Order::create([
            'user_id' => auth()->id() ?? null,
            'total_price' => $total,
            'status' => 'pending',
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'notes' => $request->notes,
        ]);
            // إنشاء عناصر الطلب
        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        // إفراغ السلة
        session()->forget('cart');
        
        return redirect()->route('order.success', $order->id);
    }

    // صفحة نجاح الطلب
    public function success($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('order-success', compact('order'));
    }


    }




