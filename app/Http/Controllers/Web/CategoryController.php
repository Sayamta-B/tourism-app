<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        return response()->json(
            Category::with(['city', 'category'])->findOrFail($id)
        );
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return redirect('categories');
    }

    public function edit($id)
    {
        $Category = Category::findOrFail($id);

        return view('categories.update', compact('Category'));
    }

    public function update(Request $request, $id){
        $Category= Category::findorFail($id);
        $Category->update([
            'name' => $request->name,
        ]);
        return redirect()->route('categories')->with('success', 'Category updated sucessfully.');
    }

    public function destroy($id){
        $Category= Category::findorFail($id);
        $Category->delete();
        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
    }
}
