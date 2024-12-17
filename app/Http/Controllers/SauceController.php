<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SauceController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Sauce::all());
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $sauce = new Sauce();
        $sauce->name = $request->name;
        $sauce->spiciness = $request->spiciness;
        $sauce->is_vegan = $request->is_vegan;
        $sauce->is_gluten_free = $request->is_gluten_free;
        $sauce->hex_color = $request->hex_color;
        $sauce->save();

        return json_encode($sauce);
    }

    /**
     * @param  Sauce  $sauce
     * @return JsonResponse
     */
    public function show(Sauce $sauce)
    {
        return response()->json($sauce);
    }

    /**
     * @param  Request  $request
     * @param  Sauce  $sauce
     * @return JsonResponse
     */
    public function update(Request $request, Sauce $sauce)
    {
        $sauce->name ? $sauce->name = $request->name : null;
        $sauce->spiciness ? $sauce->spicieness = $request->spiciness : null;
        $sauce->is_vegan ? $sauce->is_vegan = $request->is_vegan : null;
        $sauce->is_gluten_free ? $sauce->is_gluten_free = $request->is_gluten_free : null;
        $sauce->hex_color ? $sauce->hex_color = $request->hex_color : null;
        $sauce->save();

        return json_encode("Zaktualizowano sos");
    }

    /**
     * @param  Sauce  $sauce
     * @return JsonResponse
     */
    public function destroy(Sauce $sauce)
    {
        $sauce->delete();

        return json_encode("Usunięto sos");
    }
}
