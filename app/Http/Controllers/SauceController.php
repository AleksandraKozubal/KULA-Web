<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    public function index()
    {
        return json_encode(Sauce::all()->paginate(3));
    }

    public function store(Request $request)
    {
        $sauce = new Sauce();
        $sauce->name = $request->name;
        $sauce->spiciness = $request->spiciness;
        $sauce->is_vegan = $request->is_vegan;
        $sauce->is_gluten_free = $request->is_gluten_free;
        $sauce->hex_color = $request->hex_color;
        $sauce->save();
    }

    public function show(Sauce $sauce)
    {
        return json_encode($sauce);
    }

    public function update(Request $request, Sauce $sauce)
    {
        $sauce->name ? $sauce->name = $request->name : null;
        $sauce->spiciness ? $sauce->spicieness = $request->spiciness : null;
        $sauce->is_vegan ? $sauce->is_vegan = $request->is_vegan : null;
        $sauce->is_gluten_free ? $sauce->is_gluten_free = $request->is_gluten_free : null;
        $sauce->hex_color ? $sauce->hex_color = $request->hex_color : null;
        $sauce->save();
    }

    public function destroy(Sauce $sauce)
    {
        $sauce->delete();
    }
}
