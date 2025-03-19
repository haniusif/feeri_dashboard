<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\City;
use App\Models\FEERI\Country;



class CityController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$cities = \App\Models\FEERI\City::get();

$countries = \App\Models\FEERI\Country::get();
   
   $data = $request->all();


  $cities = City::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['country_id']) && $data['country_id'] != 'all' ){
            
                 $query->where('country_id' , $data['country_id']);   
            }
 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                     if(isset($data['is_active']) && $data['is_active'] != 'all' ){
            
                 $query->where('is_active' , $data['is_active']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.cities.cities')

->with('cities',$cities)
->with('countries',$countries)
;

//searchfun


                        return view('FEERI.cities.cities' , compact('cities'));

    }






        public function create()
    {

   $countries = Country::all();
       return view('FEERI.cities.city_add')->with('countries' , $countries)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'country_id' => 'required',

       'name' => 'required',

       'en_name' => 'required',]);
    $city = new City ();

         $city->country_id = $request->country_id;
  $city->name = $request->name;
  $city->en_name = $request->en_name;
  $city->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $city->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('cities.show', $city->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:cities,id',]);

    $city = City::find($id);
    $next = City::where('id','>',$id)->min('id');
    $previous = City::where('id','<',$id)->max('id');
$countries = Country::all();
       return view('FEERI.cities.city_view')
        ->with('city',$city)
        ->with('next',$next)
        ->with('previous',$previous)->with('countries' , $countries)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $city = City::find($id); 

      $city->country_id = $request->country_id;
  $city->name = $request->name;
  $city->en_name = $request->en_name;
  $city->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $city->update();

    if ($update) {
        Session::flash('alert-success', true);
        Session::flash('message', __('The record has been successfully updated.'));
    } else {
        Session::flash('alert-danger', true);
        Session::flash('message', __('Unable to update the record. Please try again.'));
    }

    return back();
}

public function destroy($id)
{
    $model = City::find($id);

    if ($model && $model->delete()) {
        Session::flash('alert-success', true);
        Session::flash('message', __('The record has been successfully deleted.'));
    } else {
        Session::flash('alert-danger', true);
        Session::flash('message', __('Failed to delete the record. Please try again.'));
    }

    return back();
}

}
