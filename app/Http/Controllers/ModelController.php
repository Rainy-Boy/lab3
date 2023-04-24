<?php

namespace App\Http\Controllers;
use App\Models\Carmodel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $manufacturer = Manufacturer::where('id','=', $id)->first();
        return view('model_new', compact('manufacturer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $model = new Carmodel();
        $model->name = $request->model_name;
        $model->manufacturer_id = $request->manufacturer_id;
        $model->save();
        $manufacturer = Manufacturer::findOrFail($request->manufacturer_id);
        $action = action([ManufacturerController::class, 'show'], ['id' =>
        $manufacturer->id]);
        return redirect($action);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
