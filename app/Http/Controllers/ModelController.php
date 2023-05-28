<?php

namespace App\Http\Controllers;
use App\Models\Carmodel;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        $validator = $request->validate([
            'model_name' => ['required', Rule::unique('carmodels', 'name')],
            'production_started' => 'numeric|min:1900|max:2023',
            'min_price' => 'numeric|min:0.01'
        ]);

        $model = new Carmodel();
        $model->name = $request->model_name;
        $model->manufacturer_id = $request->manufacturer_id;
        $model->production_started = $request->production_started;
        $model->min_price = $request->min_price;
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
