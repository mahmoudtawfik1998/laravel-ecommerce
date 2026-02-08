<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الطلب</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">إتمام الطلب</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- بيانات العميل -->
            <div class="col-md-7">
                <h4 class="mb-3">بيانات التوصيل</h4>
                
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف <span class="text-danger">*</span></label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">العنوان <span class="text-danger">*</span></label>
                        <textarea name="customer_address" class="form-control" rows="3" required>{{ old('customer_address') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ملاحظات (اختياري)</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100">تأكيد الطلب</button>
                </form>
            </div>

            <!-- ملخص الطلب -->
            <div class="col-md-5">
                <h4 class="mb-3">ملخص الطلب</h4>
                
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($cart as $id => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item['name'] }}</strong><br>
                                    <small>الكمية: {{ $item['quantity'] }} × ${{ $item['price'] }}</small>
                                </div>
                                <span>${{ $item['price'] * $item['quantity'] }}</span>
                            </li>
                            @endforeach
                        </ul>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <strong>الإجمالي:</strong>
                            <strong class="text-success">${{ $total }}</strong>
                        </div>
                    </div>
                </div>

                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary mt-3 w-100">العودة للسلة</a>
            </div>
        </div>
    </div>
</body>
</html>