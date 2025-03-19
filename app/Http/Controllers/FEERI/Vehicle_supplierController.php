<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle_supplier;
use App\Models\FEERI\Id_type;



class Vehicle_supplierController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicle_suppliers = \App\Models\FEERI\Vehicle_supplier::get();

$id_types = \App\Models\FEERI\Id_type::get();
   
   $data = $request->all();


  $vehicle_suppliers = Vehicle_supplier::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['supplier_name']) &&  $data['supplier_name'] != null ){
                   $query->where('supplier_name' , 'like'  , '%' .$data['supplier_name']. '%' );   
               }

                     if(isset($data['id_type_id']) && $data['id_type_id'] != 'all' ){
            
                 $query->where('id_type_id' , $data['id_type_id']);   
            }
 
  if(isset($data['id_number']) &&  $data['id_number'] != null ){
                   $query->where('id_number' , 'like'  , '%' .$data['id_number']. '%' );   
               }

                
  if(isset($data['id_image']) &&  $data['id_image'] != null ){
                   $query->where('id_image' , 'like'  , '%' .$data['id_image']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.vehicle_suppliers.vehicle_suppliers')

->with('vehicle_suppliers',$vehicle_suppliers)
->with('id_types',$id_types)
;

//searchfun


                        return view('FEERI.vehicle_suppliers.vehicle_suppliers' , compact('vehicle_suppliers'));

    }






        public function create()
    {

   $id_types = Id_type::all();
       return view('FEERI.vehicle_suppliers.vehicle_supplier_add')->with('id_types' , $id_types)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'supplier_name' => 'required',

       'id_type_id' => 'required',

       'id_number' => 'required',

       'id_image' => 'required',]);
    $vehicle_supplier = new Vehicle_supplier ();

         $vehicle_supplier->supplier_name = $request->supplier_name;
  $vehicle_supplier->id_type_id = $request->id_type_id;
  $vehicle_supplier->id_number = $request->id_number;

  if ($request->hasFile('id_image')) {
  if ($request->file('id_image')->isValid()) {
  $file = $request->file('id_image');
  $destinationPath = 'images/vehicle_suppliers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $vehicle_supplier->id_image = '/'.$destinationPath."/".$fileName;

      }}


    $save = $vehicle_supplier->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicle_suppliers.show', $vehicle_supplier->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicle_suppliers,id',]);

    $vehicle_supplier = Vehicle_supplier::find($id);
    $next = Vehicle_supplier::where('id','>',$id)->min('id');
    $previous = Vehicle_supplier::where('id','<',$id)->max('id');
$id_types = Id_type::all();
       return view('FEERI.vehicle_suppliers.vehicle_supplier_view')
        ->with('vehicle_supplier',$vehicle_supplier)
        ->with('next',$next)
        ->with('previous',$previous)->with('id_types' , $id_types)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle_supplier = Vehicle_supplier::find($id); 

      $vehicle_supplier->supplier_name = $request->supplier_name;
  $vehicle_supplier->id_type_id = $request->id_type_id;
  $vehicle_supplier->id_number = $request->id_number;

  if ($request->hasFile('id_image')) {
  if ($request->file('id_image')->isValid()) {
  $file = $request->file('id_image');
  $destinationPath = 'images/vehicle_suppliers';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $vehicle_supplier->id_image = '/'.$destinationPath."/".$fileName;

      }}

    $update = $vehicle_supplier->update();

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
    $model = Vehicle_supplier::find($id);

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
