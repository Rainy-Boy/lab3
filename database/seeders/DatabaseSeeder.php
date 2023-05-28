<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Manufacturer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::create(['name' => 'Germany', 'code'=>'DE']);
        Country::create(['name' => 'Italy', 'code'=>'IT']);
        Country::create(['name' => 'France', 'code'=>'FR']);
        Country::create(['name' => 'Spain', 'code'=>'ES']);
        Country::create(['name' => 'Japan', 'code'=>'JP']);
        #approach #1 - create instance of manufacturer, call save on collection
        $france = Country::where('name', 'France')->first();
        $renault = new Manufacturer();
        $renault->name = 'Renault';
        $renault->founded = 1898;
        $renault->website = 'https://www.renault.lv';
        $france->manufacturers()->save($renault);

        #approach #2 - use "create" shortcut of collection
        $france->manufacturers()->create([
            'name' => 'Peugeot',
            'founded' => 1896,
            'website' => 'https://www.peugeot.lv/lv/'
        ]);

        $spain = Country::where('name', 'Spain')->first();
        $japan = Country::where('name', 'Japan')->first();
        $spain->manufacturers()->create([
            'name' => 'Seat',
            'founded' => 1950,
            'website' => 'https://www.seat.lv/home'
        ]);
        $japan->manufacturers()->create([
            'name' => 'Toyota',
            'founded' => 1937,
            'website' => 'https://www.toyota.lv/'
        ]);
        // $france->manufacturers()->create([
        //     'name' => 'Peugeot',
        //     'founded' => 1896,
        //     'website' => 'https://www.peugeot.lv/lv/'
        // ]);

        #approach #3 - calling "associate" on sub-object
        $germany = Country::where('name', 'Germany')->first();
        $germany->manufacturers()->create([
            'name' => 'Volkswagen',
            'founded' => 1937,
            'website' => 'https://www.volkswagen.lv/'
        ]);

        $volkswagen = Manufacturer::where('name', 'Volkswagen')->first();
        $volkswagen->carmodels()->create([
            'name' => 'Passat',
            'production_started' => 1973,
            'min_price' => 28.570
        ]);
        $volkswagen->carmodels()->create([
            'name' => 'Golf',
            'production_started' => 1974,
            'min_price' => 23.195
        ]);
        $volkswagen->carmodels()->create([
            'name' => 'Multivan',
            'production_started' => 2009,
            'min_price' => 66.490
        ]);

        $audi = new Manufacturer();
        $audi->name = 'Audi';
        $audi->founded = 1909;
        $audi->website = 'https://www.audi.lv';
        $audi->country()->associate($germany);
        $audi->save();

        $audi->carmodels()->create(['name' => 'A4', 'production_started' => 2009, 'min_price' => 66.490]);
        $audi->carmodels()->create(['name' => 'A6', 'production_started' => 2009, 'min_price' => 66.490]);
        $audi->carmodels()->create(['name' => 'Q3', 'production_started' => 2009, 'min_price' => 66.490]);
        $audi->carmodels()->create(['name' => 'Q4', 'production_started' => 2009, 'min_price' => 66.490]);
        $audi->carmodels()->create(['name' => 'Q5', 'production_started' => 2009, 'min_price' => 66.490]);

        $seat = Manufacturer::where('name', 'Seat')->first();
        $seat->carmodels()->create(['name' => 'Toledo', 'production_started' => 2009, 'min_price' => 66.490]);
        $seat->carmodels()->create(['name' => 'Ibiza', 'production_started' => 2009, 'min_price' => 66.490]);
    }
}
