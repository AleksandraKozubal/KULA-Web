<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\SuggestionStatus;
use App\Http\Requests\SuggestionRequest;
use App\Models\Suggestion;
use Illuminate\Http\JsonResponse;

class SuggestionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Suggestion::all());
    }

    public function store(SuggestionRequest $request): JsonResponse
    {
        $request = $request->validated();

        Suggestion::query()->create([
            "name" => $request["name"],
            "description" => $request["description"],
            "kebab_place_id" => $request["kebabPlace"],
            "user_id" => auth()->user()->id,
            "status" => SuggestionStatus::Pending,
        ]);

        return response()->json("Dodano sugestie", 201);
    }
}
