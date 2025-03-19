<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Model_has_role;
use App\Models\FEERI\Role;



class Model_has_roleController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$model_has_roles = \App\Models\FEERI\Model_has_role::get();

$roles = \App\Models\FEERI\Role::get();
   
   $data = $request->all();


  $model_has_roles = Model_has_role::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['role_id']) && $data['role_id'] != 'all' ){
            
                 $query->where('role_id' , $data['role_id']);   
            }
 
  if(isset($data['model_type']) &&  $data['model_type'] != null ){
                   $query->where('model_type' , 'like'  , '%' .$data['model_type']. '%' );   
               }

                
  if(isset($data['model_id']) &&  $data['model_id'] != null ){
                   $query->where('model_id' , 'like'  , '%' .$data['model_id']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.model_has_roles.model_has_roles')

->with('model_has_roles',$model_has_roles)
->with('roles',$roles)
;

//searchfun


                        return view('FEERI.model_has_roles.model_has_roles' , compact('model_has_roles'));

    }






        public function create()
    {

   $roles = Role::all();
       return view('FEERI.model_has_roles.model_has_role_add')->with('roles' , $roles)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'role_id' => 'required',

       'model_type' => 'required',

       'model_id' => 'required',]);
    $model_has_role = new Model_has_role ();

         $model_has_role->role_id = $request->role_id;
  $model_has_role->model_type = $request->model_type;
  $model_has_role->model_id = $request->model_id;


    $save = $model_has_role->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('model_has_roles.show', $model_has_role->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:model_has_roles,id',]);

    $model_has_role = Model_has_role::find($id);
    $next = Model_has_role::where('id','>',$id)->min('id');
    $previous = Model_has_role::where('id','<',$id)->max('id');
$roles = Role::all();
       return view('FEERI.model_has_roles.model_has_role_view')
        ->with('model_has_role',$model_has_role)
        ->with('next',$next)
        ->with('previous',$previous)->with('roles' , $roles)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $model_has_role = Model_has_role::find($id); 

      $model_has_role->role_id = $request->role_id;
  $model_has_role->model_type = $request->model_type;
  $model_has_role->model_id = $request->model_id;

    $update = $model_has_role->update();

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
    $model = Model_has_role::find($id);

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
