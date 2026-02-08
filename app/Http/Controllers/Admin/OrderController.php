<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // عرض كل الطلبات
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // عرض تفاصيل طلب واحد
    public function show(Order $order)
    {
        $order->load('orderItems.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // تحديث حالة الطلب
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);
    
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب');
    }

    // حذف طلب
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'تم حذف الطلب');
    }
}