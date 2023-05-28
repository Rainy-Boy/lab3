<?php
namespace App\Http\Controllers;
use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ManufacturerController extends Controller
{
/**
* Display a listing of the resource.
*/
    public function index($countryslug) {
        //look up the country by its 2-letter code
        $country = Country::where('code','=', $countryslug)->first();
        #use Eloquent relations to find all manufacturers in that country
        $manufacturers = $country->manufacturers()->get();
        return view('manufacturers', ['country' => $country, 'manufacturers' => $manufacturers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($countryslug)
    {
        $country = Country::where('code','=', $countryslug)->first();
        return view('manufacturer_new', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // dd($request);
        $validator = $request->validate([
            'manufacturer_name' => ['required', 'max:50', Rule::unique('manufacturers', 'name')],
            'website' => 'url',
            'founded' => ['integer', 'max:2023']
        ]);

        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->manufacturer_name;
        $manufacturer->country_id = $request->country_id;
        $manufacturer->founded = $request->founded;
        $manufacturer->website = $request->website;
        $manufacturer->save();
        #to perform a redirect back, we need country code from ID
        // Manufacturer::create($validator);
        $country = Country::findOrFail($request->country_id);
        $action = action([ManufacturerController::class, 'index'], ['countryslug' =>
        $country->code]);
        return redirect($action);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $manufacturer = Manufacturer::findOrFail($id);
        $carmodels = $manufacturer->carmodels()->get();
        return view('models', ['carmodels' => $carmodels, 'manufacturer_name' => $manufacturer->name]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('manufacturer_edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $validator = $request->validate([
            'manufacturer_name' => ['required', 'max:50'],
            'website' => 'url',
            'founded' => ['integer', 'max:2023']
        ]);

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->name = $request->manufacturer_name;
        $manufacturer->founded = $request->founded;
        $manufacturer->website = $request->website;
        $manufacturer->save();
        return redirect(action([ManufacturerController::class, 'index'],
        ['countryslug' => $manufacturer->country->code]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $manufacturer = Manufacturer::findOrFail($id);
        Manufacturer::findOrfail($id)->delete();
        return redirect(action([ManufacturerController::class, 'index'],
        ['countryslug' => $manufacturer->country->code]));
    }
}
