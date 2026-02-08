<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة التسوق</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="mb-4">سلة التسوق</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>المنتج</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>المجموع</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                        <tr>
                            <td>
                                @if($item['image'])
                                    <img src="{{ asset('images/products/'.$item['image']) }}" width="80">
                                @else
                                    <img src="{{ asset('template/images/product-01.jpg') }}" width="80">
                                @endif
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ $item['price'] }}</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width: 60px;" class="form-control d-inline">
                                    <button type="submit" class="btn btn-sm btn-primary">تحديث</button>
                                </form>
                            </td>
                            <td>${{ $item['price'] * $item['quantity'] }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>الإجمالي:</strong></td>
                            <td colspan="2"><strong>${{ $total }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ url('/') }}" class="btn btn-secondary">متابعة التسوق</a>
                <a href="{{ route('checkout') }}" class="btn btn-success">إتمام الطلب</a>
                <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من إفراغ السلة؟')">إفراغ السلة</button>
                </form>
            </div>
        @else
            <div class="alert alert-info">
                <p>السلة فارغة</p>
                <a href="{{ url('/') }}" class="btn btn-primary">ابدأ التسوق</a>
            </div>
        @endif
    </div>
</body>
</html>