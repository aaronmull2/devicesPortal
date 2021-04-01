<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Company;

class CompaniesController extends Controller
{
        public function __construct() {$this->middleware('auth');}

        //Returns a view of all Companies
        public function index() {return view('companies.index',[
            'companies' => Company::orderBy('id','ASC')->get(),
            'rName' => Auth::user()->role->title,
        ]);}

        //Returns a view showing a specific Company
        public function show(Company $company) {return view('companies.show',[
            'company' => $company,
            'rName' => Auth::user()->role->title,
        ]);}
    
        //Returns a view to create a Company
        public function create() {return view('companies.create');}
    
        //Stores the above  reated Company
        public function store() {
            Company::create(request()->validate(['name'=>'required']));
            return redirect('/companies');
        }
    
        //Returns a view to edit a specific Company
        public function edit(Company $company) {return view('companies.edit',['company'=>$company]);}
    
        //Updates the above edited Company
        public function update(Company $company) {
            $company->update(request()->validate(['name'=>'required']));
            return redirect('/companies/' . $company->id);
        }
    
        //Deletes a specific Company
        public function destroy(Company $company) {
            $company->delete();
            return redirect('/companies');
        }
}
