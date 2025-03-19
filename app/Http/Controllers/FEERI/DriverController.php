<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Driver;
use App\Models\FEERI\Driver_contract_type;
use App\Models\FEERI\Nationality;



class DriverController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$drivers = \App\Models\FEERI\Driver::get();

$nationalities = \App\Models\FEERI\Nationality::get();

$driver_contract_types = \App\Models\FEERI\Driver_contract_type::get();
   
   $data = $request->all();


  $drivers = Driver::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['full_name']) &&  $data['full_name'] != null ){
                   $query->where('full_name' , 'like'  , '%' .$data['full_name']. '%' );   
               }

                
  if(isset($data['en_full_name']) &&  $data['en_full_name'] != null ){
                   $query->where('en_full_name' , 'like'  , '%' .$data['en_full_name']. '%' );   
               }

                
  if(isset($data['phone_number']) &&  $data['phone_number'] != null ){
                   $query->where('phone_number' , 'like'  , '%' .$data['phone_number']. '%' );   
               }

                
  if(isset($data['id_number']) &&  $data['id_number'] != null ){
                   $query->where('id_number' , 'like'  , '%' .$data['id_number']. '%' );   
               }

                
  if(isset($data['id_expiry_at']) &&  $data['id_expiry_at'] != null ){
                   $query->where('id_expiry_at' , 'like'  , '%' .$data['id_expiry_at']. '%' );   
               }

                
  if(isset($data['dob']) &&  $data['dob'] != null ){
                   $query->where('dob' , 'like'  , '%' .$data['dob']. '%' );   
               }

                
  if(isset($data['image']) &&  $data['image'] != null ){
                   $query->where('image' , 'like'  , '%' .$data['image']. '%' );   
               }

                
  if(isset($data['license_number']) &&  $data['license_number'] != null ){
                   $query->where('license_number' , 'like'  , '%' .$data['license_number']. '%' );   
               }

                
  if(isset($data['license_expiry_at']) &&  $data['license_expiry_at'] != null ){
                   $query->where('license_expiry_at' , 'like'  , '%' .$data['license_expiry_at']. '%' );   
               }

                     if(isset($data['nationality_id']) && $data['nationality_id'] != 'all' ){
            
                 $query->where('nationality_id' , $data['nationality_id']);   
            }
      if(isset($data['driver_contract_type_id']) && $data['driver_contract_type_id'] != 'all' ){
            
                 $query->where('driver_contract_type_id' , $data['driver_contract_type_id']);   
            }
 
  if(isset($data['current_vehicle_id']) &&  $data['current_vehicle_id'] != null ){
                   $query->where('current_vehicle_id' , 'like'  , '%' .$data['current_vehicle_id']. '%' );   
               }

                
  if(isset($data['current_project_id']) &&  $data['current_project_id'] != null ){
                   $query->where('current_project_id' , 'like'  , '%' .$data['current_project_id']. '%' );   
               }

                
  if(isset($data['address']) &&  $data['address'] != null ){
                   $query->where('address' , 'like'  , '%' .$data['address']. '%' );   
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

return view('FEERI.drivers.drivers')

->with('drivers',$drivers)
->with('nationalities',$nationalities)
->with('driver_contract_types',$driver_contract_types)
;

//searchfun


                        return view('FEERI.drivers.drivers' , compact('drivers'));

    }







        public function create()
    {

   $driver_contract_types = Driver_contract_type::all();
$nationalities = Nationality::all();
       return view('FEERI.drivers.driver_add')->with('driver_contract_types' , $driver_contract_types)
->with('nationalities' , $nationalities)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'full_name' => 'required',

       'en_full_name' => 'required',

       'phone_number' => 'required',

       'id_number' => 'required',

       'id_expiry_at' => 'required',

       'dob' => 'required',

       'image' => 'required',

       'license_number' => 'required',

       'license_expiry_at' => 'required',

       'nationality_id' => 'required',

       'driver_contract_type_id' => 'required',

       'current_vehicle_id' => 'required',

       'current_project_id' => 'required',

       'address' => 'required',]);
    $driver = new Driver ();

         $driver->full_name = $request->full_name;
  $driver->en_full_name = $request->en_full_name;
  $driver->phone_number = $request->phone_number;
  $driver->id_number = $request->id_number;
  $driver->id_expiry_at = $request->id_expiry_at;
  $driver->dob = $request->dob;

  if ($request->hasFile('image')) {
  if ($request->file('image')->isValid()) {
  $file = $request->file('image');
  $destinationPath = 'images/drivers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $driver->image = '/'.$destinationPath."/".$fileName;

      }}
  $driver->license_number = $request->license_number;
  $driver->license_expiry_at = $request->license_expiry_at;
  $driver->nationality_id = $request->nationality_id;
  $driver->driver_contract_type_id = $request->driver_contract_type_id;
  $driver->current_vehicle_id = $request->current_vehicle_id;
  $driver->current_project_id = $request->current_project_id;
  $driver->address = $request->address;
  $driver->created_by = Auth::user()->id; 
  $driver->updated_by = Auth::user()->id; 
  $driver->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $driver->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('drivers.show', $driver->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:drivers,id',]);

    $driver = Driver::find($id);
    $next = Driver::where('id','>',$id)->min('id');
    $previous = Driver::where('id','<',$id)->max('id');
$driver_contract_types = Driver_contract_type::all();
$nationalities = Nationality::all();
       return view('FEERI.drivers.driver_view')
        ->with('driver',$driver)
        ->with('next',$next)
        ->with('previous',$previous)->with('driver_contract_types' , $driver_contract_types)
->with('nationalities' , $nationalities)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $driver = Driver::find($id); 

      $driver->full_name = $request->full_name;
  $driver->en_full_name = $request->en_full_name;
  $driver->phone_number = $request->phone_number;
  $driver->id_number = $request->id_number;
  $driver->id_expiry_at = $request->id_expiry_at;
  $driver->dob = $request->dob;

  if ($request->hasFile('image')) {
  if ($request->file('image')->isValid()) {
  $file = $request->file('image');
  $destinationPath = 'images/drivers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $driver->image = '/'.$destinationPath."/".$fileName;

      }}
  $driver->license_number = $request->license_number;
  $driver->license_expiry_at = $request->license_expiry_at;
  $driver->nationality_id = $request->nationality_id;
  $driver->driver_contract_type_id = $request->driver_contract_type_id;
  $driver->current_vehicle_id = $request->current_vehicle_id;
  $driver->current_project_id = $request->current_project_id;
  $driver->address = $request->address;
  $driver->updated_by = Auth::user()->id; 
  $driver->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $driver->update();

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
    $model = Driver::find($id);

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
