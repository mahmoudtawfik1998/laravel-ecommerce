<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم الطلب بنجاح</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>
                        </div>
                        
                        <h2 class="text-success mb-3">تم استلام طلبك بنجاح!</h2>
                        
                        <p class="lead">رقم الطلب: <strong>#{{ $order->id }}</strong></p>
                        
                        <div class="alert alert-info">
                            <p class="mb-0">سيتم التواصل معك قريباً لتأكيد الطلب والتوصيل</p>
                        </div>

                        <hr>

                        <h5 class="mb-3">تفاصيل الطلب</h5>
                        
                        <div class="row text-start">
                            <div class="col-md-6">
                                <p><strong>الاسم:</strong> {{ $order->customer_name }}</p>
                                <p><strong>الهاتف:</strong> {{ $order->customer_phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>العنوان:</strong> {{ $order->customer_address }}</p>
                                <p><strong>الحالة:</strong> 
                                    <span class="badge bg-warning">قيد الانتظار</span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <h5 class="mb-3">المنتجات</h5>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>المجموع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ $item->price * $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>الإجمالي:</strong></td>
                                    <td><strong>${{ $order->total_price }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="mt-4">
                            <a href="{{ url('/') }}" class="btn btn-primary btn-lg">العودة للرئيسية</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>