<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Customer_address;
use App\Models\FEERI\City;
use App\Models\FEERI\Country;
use App\Models\FEERI\Neighbourhood;
use App\Models\FEERI\User;



class Customer_addressController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$customer_addresses = \App\Models\FEERI\Customer_address::get();

$users = \App\Models\FEERI\User::get();

$countries = \App\Models\FEERI\Country::get();

$cities = \App\Models\FEERI\City::get();

$neighbourhoods = \App\Models\FEERI\Neighbourhood::get();
   
   $data = $request->all();


  $customer_addresses = Customer_address::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['user_id']) && $data['user_id'] != 'all' ){
            
                 $query->where('user_id' , $data['user_id']);   
            }
      if(isset($data['country_id']) && $data['country_id'] != 'all' ){
            
                 $query->where('country_id' , $data['country_id']);   
            }
      if(isset($data['city_id']) && $data['city_id'] != 'all' ){
            
                 $query->where('city_id' , $data['city_id']);   
            }
      if(isset($data['neighbourhood_id']) && $data['neighbourhood_id'] != 'all' ){
            
                 $query->where('neighbourhood_id' , $data['neighbourhood_id']);   
            }
 
  if(isset($data['location_lat']) &&  $data['location_lat'] != null ){
                   $query->where('location_lat' , 'like'  , '%' .$data['location_lat']. '%' );   
               }

                
  if(isset($data['location_lanf']) &&  $data['location_lanf'] != null ){
                   $query->where('location_lanf' , 'like'  , '%' .$data['location_lanf']. '%' );   
               }

                
  if(isset($data['zip_code']) &&  $data['zip_code'] != null ){
                   $query->where('zip_code' , 'like'  , '%' .$data['zip_code']. '%' );   
               }

                
  if(isset($data['address']) &&  $data['address'] != null ){
                   $query->where('address' , 'like'  , '%' .$data['address']. '%' );   
               }

                     if(isset($data['is_default']) && $data['is_default'] != 'all' ){
            
                 $query->where('is_default' , $data['is_default']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.customer_addresses.customer_addresses')

->with('customer_addresses',$customer_addresses)
->with('users',$users)
->with('countries',$countries)
->with('cities',$cities)
->with('neighbourhoods',$neighbourhoods)
;

//searchfun


                        return view('FEERI.customer_addresses.customer_addresses' , compact('customer_addresses'));

    }









        public function create()
    {

   $cities = City::all();
$countries = Country::all();
$neighbourhoods = Neighbourhood::all();
$users = User::all();
       return view('FEERI.customer_addresses.customer_address_add')->with('cities' , $cities)
->with('countries' , $countries)
->with('neighbourhoods' , $neighbourhoods)
->with('users' , $users)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'user_id' => 'required',

       'country_id' => 'required',

       'city_id' => 'required',

       'neighbourhood_id' => 'required',

       'location_lat' => 'required',

       'location_lanf' => 'required',

       'zip_code' => 'required',

       'address' => 'required',]);
    $customer_address = new Customer_address ();

         $customer_address->user_id = $request->user_id;
  $customer_address->country_id = $request->country_id;
  $customer_address->city_id = $request->city_id;
  $customer_address->neighbourhood_id = $request->neighbourhood_id;
  $customer_address->location_lat = $request->location_lat;
  $customer_address->location_lanf = $request->location_lanf;
  $customer_address->zip_code = $request->zip_code;
  $customer_address->address = $request->address;
  $customer_address->is_default = ($request->is_default) ? $request->is_default : 0;


    $save = $customer_address->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('customer_addresses.show', $customer_address->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:customer_addresses,id',]);

    $customer_address = Customer_address::find($id);
    $next = Customer_address::where('id','>',$id)->min('id');
    $previous = Customer_address::where('id','<',$id)->max('id');
$cities = City::all();
$countries = Country::all();
$neighbourhoods = Neighbourhood::all();
$users = User::all();
       return view('FEERI.customer_addresses.customer_address_view')
        ->with('customer_address',$customer_address)
        ->with('next',$next)
        ->with('previous',$previous)->with('cities' , $cities)
->with('countries' , $countries)
->with('neighbourhoods' , $neighbourhoods)
->with('users' , $users)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $customer_address = Customer_address::find($id); 

      $customer_address->user_id = $request->user_id;
  $customer_address->country_id = $request->country_id;
  $customer_address->city_id = $request->city_id;
  $customer_address->neighbourhood_id = $request->neighbourhood_id;
  $customer_address->location_lat = $request->location_lat;
  $customer_address->location_lanf = $request->location_lanf;
  $customer_address->zip_code = $request->zip_code;
  $customer_address->address = $request->address;
  $customer_address->is_default = ($request->is_default) ? $request->is_default : 0;

    $update = $customer_address->update();

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
    $model = Customer_address::find($id);

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
