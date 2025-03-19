<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle;
use App\Models\FEERI\Plate_registration_type;
use App\Models\FEERI\Vehicle_color;
use App\Models\FEERI\Vehicle_manufacturer;
use App\Models\FEERI\Vehicle_model;
use App\Models\FEERI\Vehicle_status;
use App\Models\FEERI\Vehicle_supplier;
use App\Models\FEERI\Vehicle_type;



class VehicleController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicles = \App\Models\FEERI\Vehicle::get();

$plate_registration_types = \App\Models\FEERI\Plate_registration_type::get();

$vehicle_manufacturers = \App\Models\FEERI\Vehicle_manufacturer::get();

$vehicle_models = \App\Models\FEERI\Vehicle_model::get();

$vehicle_colors = \App\Models\FEERI\Vehicle_color::get();

$vehicle_statuses = \App\Models\FEERI\Vehicle_status::get();

$vehicle_types = \App\Models\FEERI\Vehicle_type::get();

$vehicle_suppliers = \App\Models\FEERI\Vehicle_supplier::get();
   
   $data = $request->all();


  $vehicles = Vehicle::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['plate_number']) &&  $data['plate_number'] != null ){
                   $query->where('plate_number' , 'like'  , '%' .$data['plate_number']. '%' );   
               }

                
  if(isset($data['serial_number']) &&  $data['serial_number'] != null ){
                   $query->where('serial_number' , 'like'  , '%' .$data['serial_number']. '%' );   
               }

                
  if(isset($data['chassis_number']) &&  $data['chassis_number'] != null ){
                   $query->where('chassis_number' , 'like'  , '%' .$data['chassis_number']. '%' );   
               }

                
  if(isset($data['registration_number']) &&  $data['registration_number'] != null ){
                   $query->where('registration_number' , 'like'  , '%' .$data['registration_number']. '%' );   
               }

                
  if(isset($data['form_expiration']) &&  $data['form_expiration'] != null ){
                   $query->where('form_expiration' , 'like'  , '%' .$data['form_expiration']. '%' );   
               }

                     if(isset($data['plate_registration_type_id']) && $data['plate_registration_type_id'] != 'all' ){
            
                 $query->where('plate_registration_type_id' , $data['plate_registration_type_id']);   
            }
      if(isset($data['vehicle_manufacturer_id']) && $data['vehicle_manufacturer_id'] != 'all' ){
            
                 $query->where('vehicle_manufacturer_id' , $data['vehicle_manufacturer_id']);   
            }
 
  if(isset($data['vehicle_manufacturer_year']) &&  $data['vehicle_manufacturer_year'] != null ){
                   $query->where('vehicle_manufacturer_year' , 'like'  , '%' .$data['vehicle_manufacturer_year']. '%' );   
               }

                     if(isset($data['vehicle_model_id']) && $data['vehicle_model_id'] != 'all' ){
            
                 $query->where('vehicle_model_id' , $data['vehicle_model_id']);   
            }
      if(isset($data['vehicle_color_id']) && $data['vehicle_color_id'] != 'all' ){
            
                 $query->where('vehicle_color_id' , $data['vehicle_color_id']);   
            }
      if(isset($data['vehicle_status_id']) && $data['vehicle_status_id'] != 'all' ){
            
                 $query->where('vehicle_status_id' , $data['vehicle_status_id']);   
            }
      if(isset($data['vehicle_type_id']) && $data['vehicle_type_id'] != 'all' ){
            
                 $query->where('vehicle_type_id' , $data['vehicle_type_id']);   
            }
      if(isset($data['vehicle_supplier_id']) && $data['vehicle_supplier_id'] != 'all' ){
            
                 $query->where('vehicle_supplier_id' , $data['vehicle_supplier_id']);   
            }
 
  if(isset($data['ownership_date']) &&  $data['ownership_date'] != null ){
                   $query->where('ownership_date' , 'like'  , '%' .$data['ownership_date']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.vehicles.vehicles')

->with('vehicles',$vehicles)
->with('plate_registration_types',$plate_registration_types)
->with('vehicle_manufacturers',$vehicle_manufacturers)
->with('vehicle_models',$vehicle_models)
->with('vehicle_colors',$vehicle_colors)
->with('vehicle_statuses',$vehicle_statuses)
->with('vehicle_types',$vehicle_types)
->with('vehicle_suppliers',$vehicle_suppliers)
;

//searchfun


                        return view('FEERI.vehicles.vehicles' , compact('vehicles'));

    }












        public function create()
    {

   $plate_registration_types = Plate_registration_type::all();
$vehicle_colors = Vehicle_color::all();
$vehicle_manufacturers = Vehicle_manufacturer::all();
$vehicle_models = Vehicle_model::all();
$vehicle_statuses = Vehicle_status::all();
$vehicle_suppliers = Vehicle_supplier::all();
$vehicle_types = Vehicle_type::all();
       return view('FEERI.vehicles.vehicle_add')->with('plate_registration_types' , $plate_registration_types)
->with('vehicle_colors' , $vehicle_colors)
->with('vehicle_manufacturers' , $vehicle_manufacturers)
->with('vehicle_models' , $vehicle_models)
->with('vehicle_statuses' , $vehicle_statuses)
->with('vehicle_suppliers' , $vehicle_suppliers)
->with('vehicle_types' , $vehicle_types)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'plate_number' => 'required',

       'serial_number' => 'required',

       'chassis_number' => 'required',

       'registration_number' => 'required',

       'form_expiration' => 'required',

       'plate_registration_type_id' => 'required',

       'vehicle_manufacturer_id' => 'required',

       'vehicle_manufacturer_year' => 'required',

       'vehicle_model_id' => 'required',

       'vehicle_color_id' => 'required',

       'vehicle_status_id' => 'required',

       'vehicle_type_id' => 'required',

       'vehicle_supplier_id' => 'required',

       'ownership_date' => 'required',]);
    $vehicle = new Vehicle ();

         $vehicle->plate_number = $request->plate_number;
  $vehicle->serial_number = $request->serial_number;
  $vehicle->chassis_number = $request->chassis_number;
  $vehicle->registration_number = $request->registration_number;
  $vehicle->form_expiration = $request->form_expiration;
  $vehicle->plate_registration_type_id = $request->plate_registration_type_id;
  $vehicle->vehicle_manufacturer_id = $request->vehicle_manufacturer_id;
  $vehicle->vehicle_manufacturer_year = $request->vehicle_manufacturer_year;
  $vehicle->vehicle_model_id = $request->vehicle_model_id;
  $vehicle->vehicle_color_id = $request->vehicle_color_id;
  $vehicle->vehicle_status_id = $request->vehicle_status_id;
  $vehicle->vehicle_type_id = $request->vehicle_type_id;
  $vehicle->vehicle_supplier_id = $request->vehicle_supplier_id;
  $vehicle->ownership_date = $request->ownership_date;
  $vehicle->created_by = Auth::user()->id; 
  $vehicle->updated_by = Auth::user()->id; 


    $save = $vehicle->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicles.show', $vehicle->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicles,id',]);

    $vehicle = Vehicle::find($id);
    $next = Vehicle::where('id','>',$id)->min('id');
    $previous = Vehicle::where('id','<',$id)->max('id');
$plate_registration_types = Plate_registration_type::all();
$vehicle_colors = Vehicle_color::all();
$vehicle_manufacturers = Vehicle_manufacturer::all();
$vehicle_models = Vehicle_model::all();
$vehicle_statuses = Vehicle_status::all();
$vehicle_suppliers = Vehicle_supplier::all();
$vehicle_types = Vehicle_type::all();
       return view('FEERI.vehicles.vehicle_view')
        ->with('vehicle',$vehicle)
        ->with('next',$next)
        ->with('previous',$previous)->with('plate_registration_types' , $plate_registration_types)
->with('vehicle_colors' , $vehicle_colors)
->with('vehicle_manufacturers' , $vehicle_manufacturers)
->with('vehicle_models' , $vehicle_models)
->with('vehicle_statuses' , $vehicle_statuses)
->with('vehicle_suppliers' , $vehicle_suppliers)
->with('vehicle_types' , $vehicle_types)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle = Vehicle::find($id); 

      $vehicle->plate_number = $request->plate_number;
  $vehicle->serial_number = $request->serial_number;
  $vehicle->chassis_number = $request->chassis_number;
  $vehicle->registration_number = $request->registration_number;
  $vehicle->form_expiration = $request->form_expiration;
  $vehicle->plate_registration_type_id = $request->plate_registration_type_id;
  $vehicle->vehicle_manufacturer_id = $request->vehicle_manufacturer_id;
  $vehicle->vehicle_manufacturer_year = $request->vehicle_manufacturer_year;
  $vehicle->vehicle_model_id = $request->vehicle_model_id;
  $vehicle->vehicle_color_id = $request->vehicle_color_id;
  $vehicle->vehicle_status_id = $request->vehicle_status_id;
  $vehicle->vehicle_type_id = $request->vehicle_type_id;
  $vehicle->vehicle_supplier_id = $request->vehicle_supplier_id;
  $vehicle->ownership_date = $request->ownership_date;
  $vehicle->updated_by = Auth::user()->id; 

    $update = $vehicle->update();

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
    $model = Vehicle::find($id);

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
