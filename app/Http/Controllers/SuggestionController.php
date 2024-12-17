<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SuggestionController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Suggestion::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
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

    /**
     * @param Request $request
     * @param Suggestion $suggestion
     * @return JsonResponse
     */
    public function updateState(Request $request, Suggestion $suggestion)
    {
        $suggestion->status = $request->status;
        $suggestion->save();
        return response()->json("Zaktualizowano status");
    }

    /**
     * @param Suggestion $suggestion
     * @return JsonResponse
     */
    public function softDelete(Suggestion $suggestion)
    {
        $suggestion->delete();

        return response()->json("Usunięto sugestię");
    }

    /**
     * @param Suggestion $suggestion
     * @return JsonResponse
     */
    public function restore(Suggestion $suggestion)
    {
        $suggestion->restore();

        return response()->json("Przywrócono sugestię");
    }

    /**
     * @param Suggestion $suggestion
     * @return JsonResponse
     */
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->forceDelete();

        return response()->json("Usunięto sugestię trwale");
    }
}
