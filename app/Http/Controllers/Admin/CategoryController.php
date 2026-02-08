<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')){
            $imageName = time(). '.' .$request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $data['image']= $imageName;
        }

        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category created successfully');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }


    public function update(Request $request, Category $category)
    {
            $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة لو موجودة
        if ($category->image && file_exists(public_path('images/categories/'.$category->image))) {
            unlink(public_path('images/categories/'.$category->image));
        }
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/categories'), $imageName);
        $data['image'] = $imageName;
    }

    $category->update($data);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }


    public function destroy(Category $category)
    {
            // حذف الصورة لو موجودة
    if ($category->image && file_exists(public_path('images/categories/'.$category->image))) {
        unlink(public_path('images/categories/'.$category->image));
    }
    
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
