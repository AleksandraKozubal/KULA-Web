<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Filling;
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
        $filling = Filling::query()->create([
            "name" => $request->name,
            "is_vegan" => $request->is_vegan,
            "hex_color" => $request->hex_color,
        ]);

        return response()->json("Dodano wypełnienie", Response::HTTP_CREATED);
    }

    public function show(Filling $filling): JsonResponse
    {
        return response()->json($filling);
    }

    public function update(Request $request, Filling $filling): JsonResponse
    {
        $filling->update([
            "name" => $request->name,
            "is_vegan" => $request->is_vegan,
            "hex_color" => $request->hex_color,
        ]);

        return response()->json("Zaktualizowano wypełnienie");
    }

    public function destroy(Filling $filling): JsonResponse
    {
        $filling->delete();

        return response()->json("Usunięto wypełnienie");
    }
}
