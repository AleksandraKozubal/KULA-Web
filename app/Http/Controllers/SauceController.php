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
        $sauce = Sauce::query()->create([
            'name' => $request->name,
            'spiciness' => $request->spiciness,
            'is_vegan' => $request->is_vegan,
            'is_gluten_free' => $request->is_gluten_free,
            'hex_color' => $request->hex_color,
        ]);

        return response()->json_encode($sauce);
    }

    public function show(Sauce $sauce): JsonResponse
    {
        return response()->json($sauce);
    }

    public function update(Request $request, Sauce $sauce): JsonResponse
    {
        $sauce->update([
            'name' => $request->name,
            'spiciness' => $request->spiciness,
            'is_vegan' => $request->is_vegan,
            'is_gluten_free' => $request->is_gluten_free,
            'hex_color' => $request->hex_color,
        ]);

        return response()->json_encode("Zaktualizowano sos");
    }

    public function destroy(Sauce $sauce): JsonResponse
    {
        $sauce->delete();

        return response()->json_encode("Usunięto sos");
    }
}
