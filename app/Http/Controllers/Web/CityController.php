<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();

        return view('cities.index', compact('cities'));
    }

    public function show($id)
    {
        return response()->json(
            City::with(['city', 'category'])->findOrFail($id)
        );
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        City::create([
            'name' => $request->name,
        ]);

        return redirect('cities');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('cities.update', compact('city'));
    }

    public function update(Request $request, $id){
        $City= City::findorFail($id);
        $City->update([
            'name' => $request->name,
        ]);
        return redirect()->route('cities.index')->with('success', 'City updated sucessfully.');
    }

    public function destroy($id){
        $City= City::findorFail($id);
        $City->delete();
        return redirect()->route('cities.index')->with('success', 'City deleted successfully.');
    }
}
