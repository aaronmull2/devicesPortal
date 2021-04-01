<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Site;
use App\Location;

class SitesController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    //Returns a view of all Sites
    public function index() {return view('sites.index',[
        'sites' => Site::orderBy('id','ASC')->get(),
        'rName' => Auth::user()->role->title,
    ]);}

    //Returns a view showing a specific Site
    public function show(Site $site) {return view('sites.show',[
        'site' => $site,
        'rName' => Auth::user()->role->title,
    ]);}

    //Returns a view to create a Site
    public function create() {return view('sites.create',['locations' => Location::orderBy('id','ASC')->get()]);}

    //Stores the above  reated Site
    public function store() {
        Site::create(request()->validate(['name'=>'required','location_id'=>'required']));
        return redirect('/sites');
    }

    //Returns a view to edit a specific Site
    public function edit(Site $site) {return view('sites.edit',['site'=>$site]);}

    //Updates the above edited Site
    public function update(Site $site) {
        $site->update(request()->validate(['name'=>'required']));
        return redirect('/sites/' . $site->id);
    }

    //Deletes a specific Site
    public function destroy(Site $site) {
        $site->delete();
        return redirect('/sites');
    }
}
