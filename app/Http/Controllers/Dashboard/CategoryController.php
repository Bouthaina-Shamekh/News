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

        return view('dashboard.categories.index',compact('categories'));

    }



    public function create()
    {
        $this->authorize('create', Category::class);
        $categories = new Category();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required|image',
            
        ]);
        // dd($request->all());
        $request->merge([
            'slug' => Str::slug($request->post('name_en')),
        ]);


        $img = $request->file('image');
        $img_name = rand() . time() . $img->getClientOriginalName();
        $img->move(public_path('uploads/categories'), $img_name);

        Category::create([
            'image' => $img_name,
             'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'slug' => $request->name_en,

         ]);

      

        return redirect()->route('dashboard.category.index')->with('success', __('Category created successfully.'));
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

        

      

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($categories->image && Storage::exists('uploads/categories/' . $categories->image)) {
            Storage::delete('uploads/categories/' . $categories->image);
        }

        // توليد اسم جديد للصورة وتخزينها
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/categories'), $img_name);
    }


        $categories->update([
         'image' => $img_name,
          'name_en' => $request->name_en,
           'name_ar' => $request->name_ar,
       
       ]);


       
        return redirect()->route('dashboard.category.index')->with('success', __('Category updated successfully.'));
    }


    public function destroy($id)
    {

        $this->authorize('delete', Category::class);
        $categories = Category::findOrFail($id);
        File::delete(public_path('uploads/Categories/'.$categories->image));
        $categories->delete();
        $request = request();
        if ($request->ajax()) {
            return response()->json(['message' => 'Item deleted successfully.']);
        }
        return redirect()->route('dashboard.category.index')->with('success', __('Item deleted successfully.'));
    }
}
