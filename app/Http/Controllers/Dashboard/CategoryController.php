<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $this->authorize('view', Category::class);

        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }



    public function create()
    {
        $this->authorize('create', Category::class);
        $categories = new Category();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'nullable|image',

        ]);
        // dd($request->all());
       

        // $img = $request->file('image')->store('uploads/categories', 'public');
        $img = $request->hasFile('image') ? $request->file('image')->store('uploads/categories', 'public') : null;

        Category::create([
            'image' => $img,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'slug' => $request->name_en,
        ]);
        return redirect()->route('dashboard.category.index')->with('success', __('admin. Iteam created successfully.'));
    }

    public function edit($id)
    {
        $this->authorize('edit', Category::class);
        $categories = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('categories'));
    }




    public function update(Request $request, $id)
    {
        $this->authorize('edit', Category::class);
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);

        $categories = Category::findOrFail($id);





        $img = $categories->image;
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($categories->image && Storage::exists($categories->image)) {
                Storage::delete($categories->image);
            }
            $img = $request->file('image')->store('uploads/categories', 'public');
        }


        $categories->update([
            'image' => $img,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,

        ]);



        return redirect()->route('dashboard.category.index')->with('success', __('Category updated successfully.'));
    }


    public function destroy($id)
    {

        $this->authorize('delete', Category::class);
        $categories = Category::findOrFail($id);
        if ($categories->image && Storage::exists($categories->image)) {
            Storage::delete($categories->image);
        }        
        $categories->delete();
        $request = request();
        if ($request->ajax()) {
            return response()->json(['message' => 'Item deleted successfully.']);
        }
        return redirect()->route('dashboard.category.index')->with('success', __('Item deleted successfully.'));
    }
}
