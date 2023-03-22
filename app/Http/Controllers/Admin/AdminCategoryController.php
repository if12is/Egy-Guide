<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return view('admin.category', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'cat-img' => 'required|file|mimes:jpeg,png,mp4|max:6048',
        ]);
        dd($request->all());
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($request->hasFile('cat-img') && $request->file('cat-img')->isValid()) {
            $category->addMediaFromRequest('cat-img')
                ->usingName($category->name)
                ->toMediaCollection('category_image');
        }
        return back()->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $oldImage = $category->getMedia('category_image')->first(); // Get the old image item
        return view('admin.category-edit', compact('category', 'oldImage'));
    }


    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('cat-img')) {
            $category->clearMediaCollection('category_image');
            $category->addMediaFromRequest('cat-img')->toMediaCollection('category_image');
        }
        return redirect()->route('admin.categories')->with('success', 'Category update successfully');
    }

    public function destroy(Category $category)
    {
        // Delete the category's media items
        $category->clearMediaCollection('category_image');

        // Delete the category
        // Category::find($category)->delete();
        $category->delete();

        return back()->with('success', 'Category deleted successfully');
    }
}
