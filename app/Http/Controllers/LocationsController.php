<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Location;

class LocationsController extends Controller
{
        public function __construct() {$this->middleware('auth');}

        //Returns a view of all Locations
        public function index() {return view('locations.index',[
            'locations' => Location::orderBy('id','ASC')->get(),
            'rName' => Auth::user()->role->title,
        ]);}

        //Returns a view showing a specific Location
        public function show(Location $location) {return view('locations.show',[
            'location' => $location,
            'rName' => Auth::user()->role->title,
        ]);}
    
        //Returns a view to create a Location
        public function create() {return view('locations.create');}
    
        //Stores the above  reated Location
        public function store() {
            Location::create(request()->validate([
                'address_line_1'=>'required',
                'city_town'=>'required',
                'county'=>'required',
                'postcode'=>'required',
                'lat'=>'required',
                'lng'=>'required'
            ]));

            return redirect('/locations');
        }
    
        //Returns a view to edit a specific Location
        public function edit(Location $location) {return view('locations.edit',['location'=>$location]);}
    
        //Updates the above edited Location
        public function update(Location $location) {
            $location->update(request()->validate([
                'address_line_1'=>'required',
                'city_town'=>'required',
                'county'=>'required',
                'postcode'=>'required',
                'lat'=>'required',
                'lng'=>'required',
                ]));
            return redirect('/locations/' . $location->id);
        }
    
        //Deletes a specific Location
        public function destroy(Location $location) {
            $location->delete();
            return redirect('/locations');
        }
}
