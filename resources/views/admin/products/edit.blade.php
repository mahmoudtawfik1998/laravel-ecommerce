<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتج</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>تعديل المنتج</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">الفئة</label>
                <select name="category_id" class="form-control" required>
                    <option value="">اختر الفئة</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم المنتج</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">السعر</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">سعر الخصم (اختياري)</label>
                    <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ old('discount_price', $product->discount_price) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">الكمية</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الصورة الحالية</label><br>
                @if($product->image)
                    <img src="{{ asset('images/products/'.$product->image) }}" width="100" class="mb-2">
                @endif
                <input type="file" name="image" class="form-control">
                <small class="text-muted">اترك الحقل فارغاً إذا كنت لا تريد تغيير الصورة</small>
            </div>

            <button type="submit" class="btn btn-success">تحديث</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
</body>
</html>