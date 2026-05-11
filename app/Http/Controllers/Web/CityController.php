<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $categories = City::all();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        return response()->json(
            City::with(['city', 'category'])->findOrFail($id)
        );
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        City::create([
            'name' => $request->name,
        ]);

        return redirect('categories');
    }

    public function edit($id)
    {
        $City = City::findOrFail($id);

        return view('categories.update', compact('City'));
    }

    public function update(Request $request, $id){
        $City= City::findorFail($id);
        $City->update([
            'name' => $request->name,
        ]);
        return redirect()->route('categories.index')->with('success', 'City updated sucessfully.');
    }

    public function destroy($id){
        $City= City::findorFail($id);
        $City->delete();
        return redirect()->route('categories.index')->with('success', 'City deleted successfully.');
    }
}
