<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Id_type;



class Id_typeController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$id_types = \App\Models\FEERI\Id_type::get();
   
   $data = $request->all();


  $id_types = Id_type::orderby('id','DESC')

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

return view('FEERI.id_types.id_types')

->with('id_types',$id_types)
;

//searchfun


                        return view('FEERI.id_types.id_types' , compact('id_types'));

    }





        public function create()
    {

          return view('FEERI.id_types.id_type_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',]);
    $id_type = new Id_type ();

         $id_type->name = $request->name;
  $id_type->en_name = $request->en_name;
  $id_type->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $id_type->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('id_types.show', $id_type->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:id_types,id',]);

    $id_type = Id_type::find($id);
    $next = Id_type::where('id','>',$id)->min('id');
    $previous = Id_type::where('id','<',$id)->max('id');
       return view('FEERI.id_types.id_type_view')
        ->with('id_type',$id_type)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $id_type = Id_type::find($id); 

      $id_type->name = $request->name;
  $id_type->en_name = $request->en_name;
  $id_type->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $id_type->update();

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
    $model = Id_type::find($id);

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
