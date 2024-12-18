<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SauceController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Sauce::all());
    }

    public function store(Request $request): JsonResponse
    {
        $sauce = new Sauce();
        $sauce->name = $request->name;
        $sauce->spiciness = $request->spiciness;
        $sauce->is_vegan = $request->is_vegan;
        $sauce->is_gluten_free = $request->is_gluten_free;
        $sauce->hex_color = $request->hex_color;
        $sauce->save();

        return response()->json_encode($sauce);
    }

    public function show(Sauce $sauce): JsonResponse
    {
        return response()->json($sauce);
    }

    public function update(Request $request, Sauce $sauce): JsonResponse
    {
        $sauce->name ? $sauce->name = $request->name : null;
        $sauce->spiciness ? $sauce->spicieness = $request->spiciness : null;
        $sauce->is_vegan ? $sauce->is_vegan = $request->is_vegan : null;
        $sauce->is_gluten_free ? $sauce->is_gluten_free = $request->is_gluten_free : null;
        $sauce->hex_color ? $sauce->hex_color = $request->hex_color : null;
        $sauce->save();

        return response()->json_encode("Zaktualizowano sos");
    }

    public function destroy(Sauce $sauce): JsonResponse
    {
        $sauce->delete();

        return response()->json_encode("Usunięto sos");
    }
}
