<?php

namespace App\Http\Controllers;

use App\Models\Filling;
use Filament\Support\Assets\Js;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FillingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Filling::all());

    }

    public function store(Request $request): JsonResponse
    {
        $filling = new Filling();
        $filling->name = $request->name;
        $filling->is_vegan = $request->is_vegan;
        $filling->is_gluten_free = $request->is_gluten_free;
        $filling->save();

        return response()->json("Dodano wypełnienie", Response::HTTP_CREATED);
    }

    public function show(Filling $filling): JsonResponse
    {
        return response()->json($filling);

    }

    public function update(Request $request, Filling $filling): JsonResponse
    {
        $filling->name ? $filling->name = $request->name : null;
        $filling->is_vegan ? $filling->is_vegan = $request->is_vegan : null;
        $filling->is_gluten_free ? $filling->is_gluten_free = $request->is_gluten_free : null;
        $filling->save();

        return response()->json("Zaktualizowano wypełnienie");
    }

    public function destroy(Filling $filling): JsonResponse
    {
        $filling->delete();

        return response()->json("Usunięto wypełnienie");
    }
}
