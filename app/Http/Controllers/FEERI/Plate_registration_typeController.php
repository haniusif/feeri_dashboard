<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Plate_registration_type;



class Plate_registration_typeController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$plate_registration_types = \App\Models\FEERI\Plate_registration_type::get();
   
   $data = $request->all();


  $plate_registration_types = Plate_registration_type::orderby('id','DESC')

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

return view('FEERI.plate_registration_types.plate_registration_types')

->with('plate_registration_types',$plate_registration_types)
;

//searchfun


                        return view('FEERI.plate_registration_types.plate_registration_types' , compact('plate_registration_types'));

    }





        public function create()
    {

          return view('FEERI.plate_registration_types.plate_registration_type_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',]);
    $plate_registration_type = new Plate_registration_type ();

         $plate_registration_type->name = $request->name;
  $plate_registration_type->en_name = $request->en_name;
  $plate_registration_type->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $plate_registration_type->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('plate_registration_types.show', $plate_registration_type->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:plate_registration_types,id',]);

    $plate_registration_type = Plate_registration_type::find($id);
    $next = Plate_registration_type::where('id','>',$id)->min('id');
    $previous = Plate_registration_type::where('id','<',$id)->max('id');
       return view('FEERI.plate_registration_types.plate_registration_type_view')
        ->with('plate_registration_type',$plate_registration_type)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $plate_registration_type = Plate_registration_type::find($id); 

      $plate_registration_type->name = $request->name;
  $plate_registration_type->en_name = $request->en_name;
  $plate_registration_type->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $plate_registration_type->update();

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
    $model = Plate_registration_type::find($id);

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
