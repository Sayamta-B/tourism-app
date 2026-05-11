<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Place;
use App\Models\City;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Place::with(['city', 'category']);

        if ($request->city) {
            $query->where('city_id', $request->city);
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $places = $query->get();

        $cities = City::all();
        $categories = Category::all();

        return view('places.index', compact('places', 'cities', 'categories'));
    }

    public function show($id)
    {
        return response()->json(
            Place::with(['city', 'category'])->findOrFail($id)
        );
    }

    public function map(Request $request)
    {
        $query = Place::with(['city', 'category']);

        if ($request->city) {
            $query->where('city_id', $request->city);
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $places = $query->get();

        $cities = City::all();
        $categories = Category::all();

        return view('map', compact('places', 'cities', 'categories'));
    }

    public function create(){
        $cities=City::all();
        $categories= Category::all();

        return view('places.create', compact('cities', 'categories'));
    }

    public function store(Request $request)
    {
        Place::create([
            'name' => $request->name,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $request->image_url,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
        ]);

        return redirect('map');
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);

        $cities = City::all();
        $categories = Category::all();

        return view(
            'places.update',
            compact('place', 'cities', 'categories')
        );
    }

    public function update(Request $request, $id){
        $place= Place::findorFail($id);
        $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image_url' => $request->image_url,
            'city_id' => $request->city_id,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('places.index')->with('success', 'Place updated sucessfully.');
    }

    public function destroy($id){
        $place= Place::findorFail($id);
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Place deleted successfully.');
    }

}
