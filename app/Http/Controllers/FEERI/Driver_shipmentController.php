<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Driver_shipment;
use App\Models\FEERI\Driver;
use App\Models\FEERI\Project;



class Driver_shipmentController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$driver_shipments = \App\Models\FEERI\Driver_shipment::get();

$projects = \App\Models\FEERI\Project::get();

$drivers = \App\Models\FEERI\Driver::get();
   
   $data = $request->all();


  $driver_shipments = Driver_shipment::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['project_id']) && $data['project_id'] != 'all' ){
            
                 $query->where('project_id' , $data['project_id']);   
            }
      if(isset($data['driver_id']) && $data['driver_id'] != 'all' ){
            
                 $query->where('driver_id' , $data['driver_id']);   
            }
 
  if(isset($data['total_orders']) &&  $data['total_orders'] != null ){
                   $query->where('total_orders' , 'like'  , '%' .$data['total_orders']. '%' );   
               }

                
  if(isset($data['delivered_orders']) &&  $data['delivered_orders'] != null ){
                   $query->where('delivered_orders' , 'like'  , '%' .$data['delivered_orders']. '%' );   
               }

                
  if(isset($data['not_delivered_orders']) &&  $data['not_delivered_orders'] != null ){
                   $query->where('not_delivered_orders' , 'like'  , '%' .$data['not_delivered_orders']. '%' );   
               }

                
  if(isset($data['return_reasons']) &&  $data['return_reasons'] != null ){
                   $query->where('return_reasons' , 'like'  , '%' .$data['return_reasons']. '%' );   
               }

                
  if(isset($data['orders_date']) &&  $data['orders_date'] != null ){
                   $query->where('orders_date' , 'like'  , '%' .$data['orders_date']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.driver_shipments.driver_shipments')

->with('driver_shipments',$driver_shipments)
->with('projects',$projects)
->with('drivers',$drivers)
;

//searchfun


                        return view('FEERI.driver_shipments.driver_shipments' , compact('driver_shipments'));

    }







        public function create()
    {

   $drivers = Driver::all();
$projects = Project::all();
       return view('FEERI.driver_shipments.driver_shipment_add')->with('drivers' , $drivers)
->with('projects' , $projects)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'project_id' => 'required',

       'driver_id' => 'required',

       'total_orders' => 'required',

       'delivered_orders' => 'required',

       'not_delivered_orders' => 'required',

       'return_reasons' => 'required',

       'orders_date' => 'required',]);
    $driver_shipment = new Driver_shipment ();

         $driver_shipment->project_id = $request->project_id;
  $driver_shipment->driver_id = $request->driver_id;
  $driver_shipment->total_orders = $request->total_orders;
  $driver_shipment->delivered_orders = $request->delivered_orders;
  $driver_shipment->not_delivered_orders = $request->not_delivered_orders;
  $driver_shipment->return_reasons = $request->return_reasons;
  $driver_shipment->orders_date = $request->orders_date;
  $driver_shipment->created_by = Auth::user()->id; 
  $driver_shipment->updated_by = Auth::user()->id; 


    $save = $driver_shipment->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('driver_shipments.show', $driver_shipment->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:driver_shipments,id',]);

    $driver_shipment = Driver_shipment::find($id);
    $next = Driver_shipment::where('id','>',$id)->min('id');
    $previous = Driver_shipment::where('id','<',$id)->max('id');
$drivers = Driver::all();
$projects = Project::all();
       return view('FEERI.driver_shipments.driver_shipment_view')
        ->with('driver_shipment',$driver_shipment)
        ->with('next',$next)
        ->with('previous',$previous)->with('drivers' , $drivers)
->with('projects' , $projects)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $driver_shipment = Driver_shipment::find($id); 

      $driver_shipment->project_id = $request->project_id;
  $driver_shipment->driver_id = $request->driver_id;
  $driver_shipment->total_orders = $request->total_orders;
  $driver_shipment->delivered_orders = $request->delivered_orders;
  $driver_shipment->not_delivered_orders = $request->not_delivered_orders;
  $driver_shipment->return_reasons = $request->return_reasons;
  $driver_shipment->orders_date = $request->orders_date;
  $driver_shipment->updated_by = Auth::user()->id; 

    $update = $driver_shipment->update();

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
    $model = Driver_shipment::find($id);

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
