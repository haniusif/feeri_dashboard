<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Order;
use App\Models\FEERI\City;
use App\Models\FEERI\Country;
use App\Models\FEERI\Neighbourhood;
use App\Models\FEERI\Order_status;
use App\Models\FEERI\User;



class OrderController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$orders = \App\Models\FEERI\Order::get();

$order_statuses = \App\Models\FEERI\Order_status::get();

$users = \App\Models\FEERI\User::get();

$countries = \App\Models\FEERI\Country::get();

$cities = \App\Models\FEERI\City::get();

$neighbourhoods = \App\Models\FEERI\Neighbourhood::get();

$countries = \App\Models\FEERI\Country::get();

$cities = \App\Models\FEERI\City::get();

$neighbourhoods = \App\Models\FEERI\Neighbourhood::get();
   
   $data = $request->all();


  $orders = Order::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['order_reference']) &&  $data['order_reference'] != null ){
                   $query->where('order_reference' , 'like'  , '%' .$data['order_reference']. '%' );   
               }

                     if(isset($data['order_status_id']) && $data['order_status_id'] != 'all' ){
            
                 $query->where('order_status_id' , $data['order_status_id']);   
            }
      if(isset($data['user_id']) && $data['user_id'] != 'all' ){
            
                 $query->where('user_id' , $data['user_id']);   
            }
 
  if(isset($data['cod_amount']) &&  $data['cod_amount'] != null ){
                   $query->where('cod_amount' , 'like'  , '%' .$data['cod_amount']. '%' );   
               }

                
  if(isset($data['pickup_reference']) &&  $data['pickup_reference'] != null ){
                   $query->where('pickup_reference' , 'like'  , '%' .$data['pickup_reference']. '%' );   
               }

                
  if(isset($data['pickup_name']) &&  $data['pickup_name'] != null ){
                   $query->where('pickup_name' , 'like'  , '%' .$data['pickup_name']. '%' );   
               }

                
  if(isset($data['pickup_phone_number']) &&  $data['pickup_phone_number'] != null ){
                   $query->where('pickup_phone_number' , 'like'  , '%' .$data['pickup_phone_number']. '%' );   
               }

                     if(isset($data['pickup_country_id']) && $data['pickup_country_id'] != 'all' ){
            
                 $query->where('pickup_country_id' , $data['pickup_country_id']);   
            }
      if(isset($data['pickup_city_id']) && $data['pickup_city_id'] != 'all' ){
            
                 $query->where('pickup_city_id' , $data['pickup_city_id']);   
            }
      if(isset($data['pickup_neighbourhood_id']) && $data['pickup_neighbourhood_id'] != 'all' ){
            
                 $query->where('pickup_neighbourhood_id' , $data['pickup_neighbourhood_id']);   
            }
 
  if(isset($data['pickup_address']) &&  $data['pickup_address'] != null ){
                   $query->where('pickup_address' , 'like'  , '%' .$data['pickup_address']. '%' );   
               }

                
  if(isset($data['pickup_latitude']) &&  $data['pickup_latitude'] != null ){
                   $query->where('pickup_latitude' , 'like'  , '%' .$data['pickup_latitude']. '%' );   
               }

                
  if(isset($data['pickup_longitude']) &&  $data['pickup_longitude'] != null ){
                   $query->where('pickup_longitude' , 'like'  , '%' .$data['pickup_longitude']. '%' );   
               }

                
  if(isset($data['pickup_time']) &&  $data['pickup_time'] != null ){
                   $query->where('pickup_time' , 'like'  , '%' .$data['pickup_time']. '%' );   
               }

                
  if(isset($data['dropoff_reference']) &&  $data['dropoff_reference'] != null ){
                   $query->where('dropoff_reference' , 'like'  , '%' .$data['dropoff_reference']. '%' );   
               }

                
  if(isset($data['dropoff_name']) &&  $data['dropoff_name'] != null ){
                   $query->where('dropoff_name' , 'like'  , '%' .$data['dropoff_name']. '%' );   
               }

                
  if(isset($data['dropoff_phone_number']) &&  $data['dropoff_phone_number'] != null ){
                   $query->where('dropoff_phone_number' , 'like'  , '%' .$data['dropoff_phone_number']. '%' );   
               }

                     if(isset($data['dropoff_country_id']) && $data['dropoff_country_id'] != 'all' ){
            
                 $query->where('dropoff_country_id' , $data['dropoff_country_id']);   
            }
      if(isset($data['dropoff_city_id']) && $data['dropoff_city_id'] != 'all' ){
            
                 $query->where('dropoff_city_id' , $data['dropoff_city_id']);   
            }
      if(isset($data['dropoff_neighbourhood_id']) && $data['dropoff_neighbourhood_id'] != 'all' ){
            
                 $query->where('dropoff_neighbourhood_id' , $data['dropoff_neighbourhood_id']);   
            }
 
  if(isset($data['dropoff_address']) &&  $data['dropoff_address'] != null ){
                   $query->where('dropoff_address' , 'like'  , '%' .$data['dropoff_address']. '%' );   
               }

                
  if(isset($data['dropoff_latitude']) &&  $data['dropoff_latitude'] != null ){
                   $query->where('dropoff_latitude' , 'like'  , '%' .$data['dropoff_latitude']. '%' );   
               }

                
  if(isset($data['dropoff_longitude']) &&  $data['dropoff_longitude'] != null ){
                   $query->where('dropoff_longitude' , 'like'  , '%' .$data['dropoff_longitude']. '%' );   
               }

                
  if(isset($data['dropoff_time']) &&  $data['dropoff_time'] != null ){
                   $query->where('dropoff_time' , 'like'  , '%' .$data['dropoff_time']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.orders.orders')

->with('orders',$orders)
->with('order_statuses',$order_statuses)
->with('users',$users)
->with('countries',$countries)
->with('cities',$cities)
->with('neighbourhoods',$neighbourhoods)
;

//searchfun
->with('countries',$countries)
->with('cities',$cities)
->with('neighbourhoods',$neighbourhoods)
;

//searchfun


                        return view('FEERI.orders.orders' , compact('orders'));

    }













        public function create()
    {

   $cities = City::all();
$countries = Country::all();
$neighbourhoods = Neighbourhood::all();
$order_statuses = Order_status::all();
$users = User::all();
       return view('FEERI.orders.order_add')->with('cities' , $cities)
->with('countries' , $countries)
->with('neighbourhoods' , $neighbourhoods)
->with('order_statuses' , $order_statuses)
->with('users' , $users)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'order_reference' => 'required',

       'order_status_id' => 'required',

       'user_id' => 'required',

       'cod_amount' => 'required',

       'pickup_reference' => 'required',

       'pickup_name' => 'required',

       'pickup_phone_number' => 'required',

       'pickup_country_id' => 'required',

       'pickup_city_id' => 'required',

       'pickup_neighbourhood_id' => 'required',

       'pickup_address' => 'required',

       'pickup_latitude' => 'required',

       'pickup_longitude' => 'required',

       'pickup_time' => 'required',

       'dropoff_reference' => 'required',

       'dropoff_name' => 'required',

       'dropoff_phone_number' => 'required',

       'dropoff_country_id' => 'required',

       'dropoff_city_id' => 'required',

       'dropoff_neighbourhood_id' => 'required',

       'dropoff_address' => 'required',

       'dropoff_latitude' => 'required',

       'dropoff_longitude' => 'required',

       'dropoff_time' => 'required',]);
    $order = new Order ();

         $order->order_reference = $request->order_reference;
  $order->order_status_id = $request->order_status_id;
  $order->user_id = $request->user_id;
  $order->cod_amount = $request->cod_amount;
  $order->pickup_reference = $request->pickup_reference;
  $order->pickup_name = $request->pickup_name;
  $order->pickup_phone_number = $request->pickup_phone_number;
  $order->pickup_country_id = $request->pickup_country_id;
  $order->pickup_city_id = $request->pickup_city_id;
  $order->pickup_neighbourhood_id = $request->pickup_neighbourhood_id;
  $order->pickup_address = $request->pickup_address;
  $order->pickup_latitude = $request->pickup_latitude;
  $order->pickup_longitude = $request->pickup_longitude;
  $order->pickup_time = $request->pickup_time;
  $order->dropoff_reference = $request->dropoff_reference;
  $order->dropoff_name = $request->dropoff_name;
  $order->dropoff_phone_number = $request->dropoff_phone_number;
  $order->dropoff_country_id = $request->dropoff_country_id;
  $order->dropoff_city_id = $request->dropoff_city_id;
  $order->dropoff_neighbourhood_id = $request->dropoff_neighbourhood_id;
  $order->dropoff_address = $request->dropoff_address;
  $order->dropoff_latitude = $request->dropoff_latitude;
  $order->dropoff_longitude = $request->dropoff_longitude;
  $order->dropoff_time = $request->dropoff_time;


    $save = $order->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('orders.show', $order->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:orders,id',]);

    $order = Order::find($id);
    $next = Order::where('id','>',$id)->min('id');
    $previous = Order::where('id','<',$id)->max('id');
$cities = City::all();
$countries = Country::all();
$neighbourhoods = Neighbourhood::all();
$order_statuses = Order_status::all();
$users = User::all();
       return view('FEERI.orders.order_view')
        ->with('order',$order)
        ->with('next',$next)
        ->with('previous',$previous)->with('cities' , $cities)
->with('countries' , $countries)
->with('neighbourhoods' , $neighbourhoods)
->with('order_statuses' , $order_statuses)
->with('users' , $users)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $order = Order::find($id); 

      $order->order_reference = $request->order_reference;
  $order->order_status_id = $request->order_status_id;
  $order->user_id = $request->user_id;
  $order->cod_amount = $request->cod_amount;
  $order->pickup_reference = $request->pickup_reference;
  $order->pickup_name = $request->pickup_name;
  $order->pickup_phone_number = $request->pickup_phone_number;
  $order->pickup_country_id = $request->pickup_country_id;
  $order->pickup_city_id = $request->pickup_city_id;
  $order->pickup_neighbourhood_id = $request->pickup_neighbourhood_id;
  $order->pickup_address = $request->pickup_address;
  $order->pickup_latitude = $request->pickup_latitude;
  $order->pickup_longitude = $request->pickup_longitude;
  $order->pickup_time = $request->pickup_time;
  $order->dropoff_reference = $request->dropoff_reference;
  $order->dropoff_name = $request->dropoff_name;
  $order->dropoff_phone_number = $request->dropoff_phone_number;
  $order->dropoff_country_id = $request->dropoff_country_id;
  $order->dropoff_city_id = $request->dropoff_city_id;
  $order->dropoff_neighbourhood_id = $request->dropoff_neighbourhood_id;
  $order->dropoff_address = $request->dropoff_address;
  $order->dropoff_latitude = $request->dropoff_latitude;
  $order->dropoff_longitude = $request->dropoff_longitude;
  $order->dropoff_time = $request->dropoff_time;

    $update = $order->update();

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
    $model = Order::find($id);

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
