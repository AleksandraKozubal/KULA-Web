<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{

    public function index()
    {
        return json_encode(Suggestion::all());
    }

    public function store(Request $request)
    {
        $suggestion = new Suggestion();
        $suggestion->name = $request->name;
        $suggestion->description = $request->description;
        $suggestion->status = $request->status;
        $suggestion->user_id = $request->user_id;
        $suggestion->kebab_place_id = $request->kebab_place_id;
        $suggestion->save();
    }

    public function updateState(Request $request, Suggestion $suggestion)
    {
        $suggestion->status = $request->status;
        $suggestion->save();
    }

    public function softDelete(Suggestion $suggestion)
    {
        $suggestion->delete();
    }

    public function restore(Suggestion $suggestion)
    {
        $suggestion->restore();
    }

    public function destroy(Suggestion $suggestion)
    {
        $suggestion->forceDelete();
    }
}
