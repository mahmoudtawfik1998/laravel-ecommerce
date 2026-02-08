<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الطلب #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>تفاصيل الطلب #{{ $order->id }}</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">رجوع للطلبات</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- بيانات العميل -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>بيانات العميل</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>الاسم:</strong> {{ $order->customer_name }}</p>
                        <p><strong>الهاتف:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>العنوان:</strong> {{ $order->customer_address }}</p>
                        @if($order->notes)
                            <p><strong>ملاحظات:</strong> {{ $order->notes }}</p>
                        @endif
                        <p><strong>التاريخ:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- تحديث الحالة -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>تحديث حالة الطلب</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">الحالة الحالية:</label>
                                <p>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">قيد الانتظار</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">قيد المعالجة</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">مكتمل</span>
                                    @else
                                        <span class="badge bg-danger">ملغي</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">تغيير الحالة:</label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>قيد المعالجة</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>مكتمل</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">تحديث الحالة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- المنتجات -->
        <div class="card">
            <div class="card-header">
                <h5>المنتجات المطلوبة</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                @if($item->product->image)
                                    <img src="{{ asset('images/products/'.$item->product->image) }}" width="60">
                                @endif
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price * $item->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>الإجمالي:</strong></td>
                            <td><strong>${{ $order->total_price }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>