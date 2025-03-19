<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle_manufacturer;



class Vehicle_manufacturerController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicle_manufacturers = \App\Models\FEERI\Vehicle_manufacturer::get();
   
   $data = $request->all();


  $vehicle_manufacturers = Vehicle_manufacturer::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                
  if(isset($data['image']) &&  $data['image'] != null ){
                   $query->where('image' , 'like'  , '%' .$data['image']. '%' );   
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

return view('FEERI.vehicle_manufacturers.vehicle_manufacturers')

->with('vehicle_manufacturers',$vehicle_manufacturers)
;

//searchfun


                        return view('FEERI.vehicle_manufacturers.vehicle_manufacturers' , compact('vehicle_manufacturers'));

    }





        public function create()
    {

          return view('FEERI.vehicle_manufacturers.vehicle_manufacturer_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',

       'image' => 'required',]);
    $vehicle_manufacturer = new Vehicle_manufacturer ();

         $vehicle_manufacturer->name = $request->name;
  $vehicle_manufacturer->en_name = $request->en_name;

  if ($request->hasFile('image')) {
  if ($request->file('image')->isValid()) {
  $file = $request->file('image');
  $destinationPath = 'images/vehicle_manufacturers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $vehicle_manufacturer->image = '/'.$destinationPath."/".$fileName;

      }}
  $vehicle_manufacturer->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $vehicle_manufacturer->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicle_manufacturers.show', $vehicle_manufacturer->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicle_manufacturers,id',]);

    $vehicle_manufacturer = Vehicle_manufacturer::find($id);
    $next = Vehicle_manufacturer::where('id','>',$id)->min('id');
    $previous = Vehicle_manufacturer::where('id','<',$id)->max('id');
       return view('FEERI.vehicle_manufacturers.vehicle_manufacturer_view')
        ->with('vehicle_manufacturer',$vehicle_manufacturer)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle_manufacturer = Vehicle_manufacturer::find($id); 

      $vehicle_manufacturer->name = $request->name;
  $vehicle_manufacturer->en_name = $request->en_name;

  if ($request->hasFile('image')) {
  if ($request->file('image')->isValid()) {
  $file = $request->file('image');
  $destinationPath = 'images/vehicle_manufacturers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $vehicle_manufacturer->image = '/'.$destinationPath."/".$fileName;

      }}
  $vehicle_manufacturer->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $vehicle_manufacturer->update();

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
    $model = Vehicle_manufacturer::find($id);

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
