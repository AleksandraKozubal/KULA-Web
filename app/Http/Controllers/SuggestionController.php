<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SuggestionController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json(Suggestion::all());
    }

    public function store(Request $request): JsonResponse
    {
        $suggestion = new Suggestion();
        $suggestion->name = $request->name;
        $suggestion->description = $request->description;
        $suggestion->status = 'pending';
        $suggestion->user_id = auth()->user()->id;
        $suggestion->kebab_place_id = $request->kebabPlace;
        $suggestion->save();
        return response()->json("Dodano sugestie", 201);
    }

    public function updateState(Request $request, Suggestion $suggestion): JsonResponse
    {
        $suggestion->status = $request->status;
        $suggestion->save();
        return response()->json("Zaktualizowano status");
    }

    public function softDelete(Suggestion $suggestion): JsonResponse
    {
        $suggestion->delete();

        return response()->json("Usunięto sugestię");
    }

    public function restore(Suggestion $suggestion): JsonResponse
    {
        $suggestion->restore();

        return response()->json("Przywrócono sugestię");
    }

    public function destroy(Suggestion $suggestion): JsonResponse
    {
        $suggestion->forceDelete();

        return response()->json("Usunięto sugestię trwale");
    }
}
