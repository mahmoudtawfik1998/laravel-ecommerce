<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>إضافة منتج جديد</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">الفئة</label>
                <select name="category_id" class="form-control" required>
                    <option value="">اختر الفئة</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">اسم المنتج</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">السعر</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">سعر الخصم (اختياري)</label>
                    <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ old('discount_price') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">الكمية</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الصورة</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">حفظ</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
</body>
</html>