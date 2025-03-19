<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Country;



class CountryController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$countries = \App\Models\FEERI\Country::get();
   
   $data = $request->all();


  $countries = Country::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                
  if(isset($data['iso_code']) &&  $data['iso_code'] != null ){
                   $query->where('iso_code' , 'like'  , '%' .$data['iso_code']. '%' );   
               }

                
  if(isset($data['country_code']) &&  $data['country_code'] != null ){
                   $query->where('country_code' , 'like'  , '%' .$data['country_code']. '%' );   
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

return view('FEERI.countries.countries')

->with('countries',$countries)
;

//searchfun


                        return view('FEERI.countries.countries' , compact('countries'));

    }





        public function create()
    {

          return view('FEERI.countries.country_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',

       'iso_code' => 'required',

       'country_code' => 'required',]);
    $country = new Country ();

         $country->name = $request->name;
  $country->en_name = $request->en_name;
  $country->iso_code = $request->iso_code;
  $country->country_code = $request->country_code;
  $country->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $country->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('countries.show', $country->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:countries,id',]);

    $country = Country::find($id);
    $next = Country::where('id','>',$id)->min('id');
    $previous = Country::where('id','<',$id)->max('id');
       return view('FEERI.countries.country_view')
        ->with('country',$country)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $country = Country::find($id); 

      $country->name = $request->name;
  $country->en_name = $request->en_name;
  $country->iso_code = $request->iso_code;
  $country->country_code = $request->country_code;
  $country->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $country->update();

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
    $model = Country::find($id);

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
