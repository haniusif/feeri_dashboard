<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle_handover;
use App\Models\FEERI\Driver;
use App\Models\FEERI\Vehicle;



class Vehicle_handoverController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicle_handovers = \App\Models\FEERI\Vehicle_handover::get();

$drivers = \App\Models\FEERI\Driver::get();

$vehicles = \App\Models\FEERI\Vehicle::get();
   
   $data = $request->all();


  $vehicle_handovers = Vehicle_handover::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['driver_id']) && $data['driver_id'] != 'all' ){
            
                 $query->where('driver_id' , $data['driver_id']);   
            }
      if(isset($data['vehicle_id']) && $data['vehicle_id'] != 'all' ){
            
                 $query->where('vehicle_id' , $data['vehicle_id']);   
            }
 
  if(isset($data['meter_upon_handover']) &&  $data['meter_upon_handover'] != null ){
                   $query->where('meter_upon_handover' , 'like'  , '%' .$data['meter_upon_handover']. '%' );   
               }

                
  if(isset($data['authorization_start_date']) &&  $data['authorization_start_date'] != null ){
                   $query->where('authorization_start_date' , 'like'  , '%' .$data['authorization_start_date']. '%' );   
               }

                
  if(isset($data['authorization_end_date']) &&  $data['authorization_end_date'] != null ){
                   $query->where('authorization_end_date' , 'like'  , '%' .$data['authorization_end_date']. '%' );   
               }

                
  if(isset($data['front_right_image']) &&  $data['front_right_image'] != null ){
                   $query->where('front_right_image' , 'like'  , '%' .$data['front_right_image']. '%' );   
               }

                
  if(isset($data['back_left_image']) &&  $data['back_left_image'] != null ){
                   $query->where('back_left_image' , 'like'  , '%' .$data['back_left_image']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.vehicle_handovers.vehicle_handovers')

->with('vehicle_handovers',$vehicle_handovers)
->with('drivers',$drivers)
->with('vehicles',$vehicles)
;

//searchfun


                        return view('FEERI.vehicle_handovers.vehicle_handovers' , compact('vehicle_handovers'));

    }







        public function create()
    {

   $drivers = Driver::all();
$vehicles = Vehicle::all();
       return view('FEERI.vehicle_handovers.vehicle_handover_add')->with('drivers' , $drivers)
->with('vehicles' , $vehicles)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'driver_id' => 'required',

       'vehicle_id' => 'required',

       'meter_upon_handover' => 'required',

       'authorization_start_date' => 'required',

       'authorization_end_date' => 'required',

       'front_right_image' => 'required',

       'back_left_image' => 'required',]);
    $vehicle_handover = new Vehicle_handover ();

         $vehicle_handover->driver_id = $request->driver_id;
  $vehicle_handover->vehicle_id = $request->vehicle_id;
  $vehicle_handover->meter_upon_handover = $request->meter_upon_handover;
  $vehicle_handover->authorization_start_date = $request->authorization_start_date;
  $vehicle_handover->authorization_end_date = $request->authorization_end_date;
  $vehicle_handover->front_right_image = $request->front_right_image;
  $vehicle_handover->back_left_image = $request->back_left_image;
  $vehicle_handover->created_by = Auth::user()->id; 
  $vehicle_handover->updated_by = Auth::user()->id; 


    $save = $vehicle_handover->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicle_handovers.show', $vehicle_handover->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicle_handovers,id',]);

    $vehicle_handover = Vehicle_handover::find($id);
    $next = Vehicle_handover::where('id','>',$id)->min('id');
    $previous = Vehicle_handover::where('id','<',$id)->max('id');
$drivers = Driver::all();
$vehicles = Vehicle::all();
       return view('FEERI.vehicle_handovers.vehicle_handover_view')
        ->with('vehicle_handover',$vehicle_handover)
        ->with('next',$next)
        ->with('previous',$previous)->with('drivers' , $drivers)
->with('vehicles' , $vehicles)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle_handover = Vehicle_handover::find($id); 

      $vehicle_handover->driver_id = $request->driver_id;
  $vehicle_handover->vehicle_id = $request->vehicle_id;
  $vehicle_handover->meter_upon_handover = $request->meter_upon_handover;
  $vehicle_handover->authorization_start_date = $request->authorization_start_date;
  $vehicle_handover->authorization_end_date = $request->authorization_end_date;
  $vehicle_handover->front_right_image = $request->front_right_image;
  $vehicle_handover->back_left_image = $request->back_left_image;
  $vehicle_handover->updated_by = Auth::user()->id; 

    $update = $vehicle_handover->update();

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
    $model = Vehicle_handover::find($id);

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
