<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الطلبات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>الطلبات</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">إدارة الفئات</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم العميل</th>
                    <th>الهاتف</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>${{ $order->total_price }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning">قيد الانتظار</span>
                        @elseif($order->status == 'processing')
                            <span class="badge bg-info">قيد المعالجة</span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success">مكتمل</span>
                        @else
                            <span class="badge bg-danger">ملغي</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">عرض</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">لا توجد طلبات</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>