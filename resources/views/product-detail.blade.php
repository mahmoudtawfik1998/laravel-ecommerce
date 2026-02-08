<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
</head>

<body>
    <div class="container mt-5 mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="row">
            <!-- صورة المنتج -->
            <div class="col-md-6">
                @if($product->image)
                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid"
                        style="width: 100%; border-radius: 10px;">
                @else
                    <img src="{{ asset('template/images/product-01.jpg') }}" alt="{{ $product->name }}" class="img-fluid">
                @endif
            </div>

            <!-- تفاصيل المنتج -->
            <div class="col-md-6">
                <h2 class="mb-3">{{ $product->name }}</h2>

                <p class="text-muted">الفئة: {{ $product->category->name }}</p>

                <div class="mb-4">
                    @if($product->discount_price)
                        <h3>
                            <span style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
                            <span style="color: #e65540; font-weight: bold;">${{ $product->discount_price }}</span>
                        </h3>
                        <span class="badge bg-danger">خصم
                            {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</span>
                    @else
                        <h3 style="color: #333;">${{ $product->price }}</h3>
                    @endif
                </div>

                <div class="mb-4">
                    <h5>الوصف:</h5>
                    <p>{{ $product->description ?? 'لا يوجد وصف متاح' }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>الكمية المتوفرة:</strong>
                        @if($product->quantity > 0)
                            <span class="text-success">{{ $product->quantity }} قطعة</span>
                        @else
                            <span class="text-danger">غير متوفر</span>
                        @endif
                    </p>
                </div>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label>الكمية:</label>
                        <input type="number" value="1" min="1" max="{{ $product->quantity }}" class="form-control"
                            style="width: 100px; display: inline-block;">
                    </div>

                    <div class="mb-3">
                        @if($product->quantity > 0)
                            <button class="btn btn-primary btn-lg">إضافة إلى السلة</button>
                        @else
                            <button class="btn btn-secondary btn-lg" disabled>غير متوفر</button>
                        @endif
                    </div>
                </form>
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">← العودة للرئيسية</a>
            </div>
        </div>
    </div>
</body>

</html>