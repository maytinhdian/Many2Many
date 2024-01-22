<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  return $stores = Stores::with('regions')->get();
        // return view('home', compact('stores'));

        $stores = Stores::with('regions')->get();
        return response()->json([
            'stores' => $stores
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regions  = [1, 2, 3];

        $stores = new Stores();
        $stores->name = $request->name;
        $stores->save();
       return  $stores->regions()->attach($regions);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $regions  = [4, 5];
        $stores = Stores::find($id);
        $stores->regions()->sync($regions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stores = Stores::find($id);
        $stores->regions()->detach();

        $stores->delete();
    }
}
