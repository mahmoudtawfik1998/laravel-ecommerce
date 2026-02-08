<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الفئة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>تعديل الفئة</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">اسم الفئة</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">الوصف</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">الصورة الحالية</label><br>
                @if($category->image)
                    <img src="{{ asset('images/categories/'.$category->image) }}" width="100" class="mb-2">
                @endif
                <input type="file" name="image" class="form-control">
                <small class="text-muted">اترك الحقل فارغاً إذا كنت لا تريد تغيير الصورة</small>
            </div>

            <button type="submit" class="btn btn-success">تحديث</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
</body>
</html>