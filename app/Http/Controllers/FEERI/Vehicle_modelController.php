<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle_model;
use App\Models\FEERI\Vehicle_manufacturer;



class Vehicle_modelController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicle_models = \App\Models\FEERI\Vehicle_model::get();

$vehicle_manufacturers = \App\Models\FEERI\Vehicle_manufacturer::get();
   
   $data = $request->all();


  $vehicle_models = Vehicle_model::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                     if(isset($data['is_active']) && $data['is_active'] != 'all' ){
            
                 $query->where('is_active' , $data['is_active']);   
            }
      if(isset($data['vehicle_manufacturer_id']) && $data['vehicle_manufacturer_id'] != 'all' ){
            
                 $query->where('vehicle_manufacturer_id' , $data['vehicle_manufacturer_id']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.vehicle_models.vehicle_models')

->with('vehicle_models',$vehicle_models)
->with('vehicle_manufacturers',$vehicle_manufacturers)
;

//searchfun


                        return view('FEERI.vehicle_models.vehicle_models' , compact('vehicle_models'));

    }






        public function create()
    {

   $vehicle_manufacturers = Vehicle_manufacturer::all();
       return view('FEERI.vehicle_models.vehicle_model_add')->with('vehicle_manufacturers' , $vehicle_manufacturers)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',

       'vehicle_manufacturer_id' => 'required',]);
    $vehicle_model = new Vehicle_model ();

         $vehicle_model->name = $request->name;
  $vehicle_model->en_name = $request->en_name;
  $vehicle_model->is_active = ($request->is_active) ? $request->is_active : 0;
  $vehicle_model->vehicle_manufacturer_id = $request->vehicle_manufacturer_id;


    $save = $vehicle_model->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicle_models.show', $vehicle_model->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicle_models,id',]);

    $vehicle_model = Vehicle_model::find($id);
    $next = Vehicle_model::where('id','>',$id)->min('id');
    $previous = Vehicle_model::where('id','<',$id)->max('id');
$vehicle_manufacturers = Vehicle_manufacturer::all();
       return view('FEERI.vehicle_models.vehicle_model_view')
        ->with('vehicle_model',$vehicle_model)
        ->with('next',$next)
        ->with('previous',$previous)->with('vehicle_manufacturers' , $vehicle_manufacturers)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle_model = Vehicle_model::find($id); 

      $vehicle_model->name = $request->name;
  $vehicle_model->en_name = $request->en_name;
  $vehicle_model->is_active = ($request->is_active) ? $request->is_active : 0;
  $vehicle_model->vehicle_manufacturer_id = $request->vehicle_manufacturer_id;

    $update = $vehicle_model->update();

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
    $model = Vehicle_model::find($id);

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
