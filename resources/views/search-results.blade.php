<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نتائج البحث: {{ $query }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
    <style>
        .block2-pic img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    
    <div class="container mt-5 mb-5">
        <div class="mb-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">← العودة للرئيسية</a>
        </div>

        <h3 class="mb-4">نتائج البحث عن: "{{ $query }}"</h3>
        <p class="text-muted">تم العثور على {{ count($products) }} منتج</p>

        @if(count($products) > 0)
            <div class="row">
                @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            @if($product->image)
                                <img src="{{ asset('images/products/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('template/images/product-01.jpg') }}" alt="{{ $product->name }}">
                            @endif

                            <a href="{{ route('product.show', $product->id) }}"
                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                عرض التفاصيل
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="{{ route('product.show', $product->id) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $product->name }}
                                </a>

                                <span class="stext-105 cl3">
                                    @if($product->discount_price)
                                        <span style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
                                        <span style="color: #e65540; font-weight: bold;">${{ $product->discount_price }}</span>
                                    @else
                                        ${{ $product->price }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <p>لم يتم العثور على منتجات تطابق بحثك</p>
                <a href="{{ url('/') }}" class="btn btn-primary">تصفح جميع المنتجات</a>
            </div>
        @endif
    </div>
</body>
</html>