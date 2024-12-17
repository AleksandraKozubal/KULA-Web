<?php

namespace App\Http\Controllers;

use App\Models\Filling;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FillingController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode(Filling::all());
    }

    /**
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $filling = new Filling();
        $filling->name = $request->name;
        $filling->is_vegan = $request->is_vegan;
        $filling->is_gluten_free = $request->is_gluten_free;
        $filling->save();
    }

    /**
     * @param  Filling  $filling
     * @return Response
     */
    public function show(Filling $filling)
    {
        return json_encode($filling);
    }

    /**
     * @param  Request  $request
     * @param  Filling  $filling
     * @return void
     */
    public function update(Request $request, Filling $filling)
    {
        $filling->name ? $filling->name = $request->name : null;
        $filling->is_vegan ? $filling->is_vegan = $request->is_vegan : null;
        $filling->is_gluten_free ? $filling->is_gluten_free = $request->is_gluten_free : null;
        $filling->save();
    }

    /**
     * @param  Filling  $filling
     */
    public function destroy(Filling $filling)
    {
        $filling->delete();
    }
}
