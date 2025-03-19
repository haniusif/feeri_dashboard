<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Driver_contract_type;



class Driver_contract_typeController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$driver_contract_types = \App\Models\FEERI\Driver_contract_type::get();
   
   $data = $request->all();


  $driver_contract_types = Driver_contract_type::orderby('id','DESC')

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
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.driver_contract_types.driver_contract_types')

->with('driver_contract_types',$driver_contract_types)
;

//searchfun


                        return view('FEERI.driver_contract_types.driver_contract_types' , compact('driver_contract_types'));

    }





        public function create()
    {

          return view('FEERI.driver_contract_types.driver_contract_type_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',]);
    $driver_contract_type = new Driver_contract_type ();

         $driver_contract_type->name = $request->name;
  $driver_contract_type->en_name = $request->en_name;
  $driver_contract_type->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $driver_contract_type->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('driver_contract_types.show', $driver_contract_type->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:driver_contract_types,id',]);

    $driver_contract_type = Driver_contract_type::find($id);
    $next = Driver_contract_type::where('id','>',$id)->min('id');
    $previous = Driver_contract_type::where('id','<',$id)->max('id');
       return view('FEERI.driver_contract_types.driver_contract_type_view')
        ->with('driver_contract_type',$driver_contract_type)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $driver_contract_type = Driver_contract_type::find($id); 

      $driver_contract_type->name = $request->name;
  $driver_contract_type->en_name = $request->en_name;
  $driver_contract_type->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $driver_contract_type->update();

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
    $model = Driver_contract_type::find($id);

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
