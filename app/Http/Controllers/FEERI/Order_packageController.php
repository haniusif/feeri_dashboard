<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Order_package;
use App\Models\FEERI\Order;



class Order_packageController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$order_packages = \App\Models\FEERI\Order_package::get();

$orders = \App\Models\FEERI\Order::get();
   
   $data = $request->all();


  $order_packages = Order_package::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['order_id']) && $data['order_id'] != 'all' ){
            
                 $query->where('order_id' , $data['order_id']);   
            }
 
  if(isset($data['package_name']) &&  $data['package_name'] != null ){
                   $query->where('package_name' , 'like'  , '%' .$data['package_name']. '%' );   
               }

                
  if(isset($data['package_description']) &&  $data['package_description'] != null ){
                   $query->where('package_description' , 'like'  , '%' .$data['package_description']. '%' );   
               }

                
  if(isset($data['package_weight']) &&  $data['package_weight'] != null ){
                   $query->where('package_weight' , 'like'  , '%' .$data['package_weight']. '%' );   
               }

                
  if(isset($data['package_length']) &&  $data['package_length'] != null ){
                   $query->where('package_length' , 'like'  , '%' .$data['package_length']. '%' );   
               }

                
  if(isset($data['package_width']) &&  $data['package_width'] != null ){
                   $query->where('package_width' , 'like'  , '%' .$data['package_width']. '%' );   
               }

                
  if(isset($data['package_height']) &&  $data['package_height'] != null ){
                   $query->where('package_height' , 'like'  , '%' .$data['package_height']. '%' );   
               }

                
  if(isset($data['package_weight_vol']) &&  $data['package_weight_vol'] != null ){
                   $query->where('package_weight_vol' , 'like'  , '%' .$data['package_weight_vol']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.order_packages.order_packages')

->with('order_packages',$order_packages)
->with('orders',$orders)
;

//searchfun


                        return view('FEERI.order_packages.order_packages' , compact('order_packages'));

    }






        public function create()
    {

   $orders = Order::all();
       return view('FEERI.order_packages.order_package_add')->with('orders' , $orders)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'order_id' => 'required',

       'package_name' => 'required',

       'package_description' => 'required',

       'package_weight' => 'required',

       'package_length' => 'required',

       'package_width' => 'required',

       'package_height' => 'required',

       'package_weight_vol' => 'required',]);
    $order_package = new Order_package ();

         $order_package->order_id = $request->order_id;
  $order_package->package_name = $request->package_name;
  $order_package->package_description = $request->package_description;
  $order_package->package_weight = $request->package_weight;
  $order_package->package_length = $request->package_length;
  $order_package->package_width = $request->package_width;
  $order_package->package_height = $request->package_height;
  $order_package->package_weight_vol = $request->package_weight_vol;


    $save = $order_package->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('order_packages.show', $order_package->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:order_packages,id',]);

    $order_package = Order_package::find($id);
    $next = Order_package::where('id','>',$id)->min('id');
    $previous = Order_package::where('id','<',$id)->max('id');
$orders = Order::all();
       return view('FEERI.order_packages.order_package_view')
        ->with('order_package',$order_package)
        ->with('next',$next)
        ->with('previous',$previous)->with('orders' , $orders)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $order_package = Order_package::find($id); 

      $order_package->order_id = $request->order_id;
  $order_package->package_name = $request->package_name;
  $order_package->package_description = $request->package_description;
  $order_package->package_weight = $request->package_weight;
  $order_package->package_length = $request->package_length;
  $order_package->package_width = $request->package_width;
  $order_package->package_height = $request->package_height;
  $order_package->package_weight_vol = $request->package_weight_vol;

    $update = $order_package->update();

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
    $model = Order_package::find($id);

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
