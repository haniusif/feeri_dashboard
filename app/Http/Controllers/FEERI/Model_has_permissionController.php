<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Model_has_permission;
use App\Models\FEERI\Permission;



class Model_has_permissionController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$model_has_permissions = \App\Models\FEERI\Model_has_permission::get();

$permissions = \App\Models\FEERI\Permission::get();
   
   $data = $request->all();


  $model_has_permissions = Model_has_permission::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['permission_id']) && $data['permission_id'] != 'all' ){
            
                 $query->where('permission_id' , $data['permission_id']);   
            }
 
  if(isset($data['model_type']) &&  $data['model_type'] != null ){
                   $query->where('model_type' , 'like'  , '%' .$data['model_type']. '%' );   
               }

                
  if(isset($data['model_id']) &&  $data['model_id'] != null ){
                   $query->where('model_id' , 'like'  , '%' .$data['model_id']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.model_has_permissions.model_has_permissions')

->with('model_has_permissions',$model_has_permissions)
->with('permissions',$permissions)
;

//searchfun


                        return view('FEERI.model_has_permissions.model_has_permissions' , compact('model_has_permissions'));

    }






        public function create()
    {

   $permissions = Permission::all();
       return view('FEERI.model_has_permissions.model_has_permission_add')->with('permissions' , $permissions)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'permission_id' => 'required',

       'model_type' => 'required',

       'model_id' => 'required',]);
    $model_has_permission = new Model_has_permission ();

         $model_has_permission->permission_id = $request->permission_id;
  $model_has_permission->model_type = $request->model_type;
  $model_has_permission->model_id = $request->model_id;


    $save = $model_has_permission->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('model_has_permissions.show', $model_has_permission->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:model_has_permissions,id',]);

    $model_has_permission = Model_has_permission::find($id);
    $next = Model_has_permission::where('id','>',$id)->min('id');
    $previous = Model_has_permission::where('id','<',$id)->max('id');
$permissions = Permission::all();
       return view('FEERI.model_has_permissions.model_has_permission_view')
        ->with('model_has_permission',$model_has_permission)
        ->with('next',$next)
        ->with('previous',$previous)->with('permissions' , $permissions)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $model_has_permission = Model_has_permission::find($id); 

      $model_has_permission->permission_id = $request->permission_id;
  $model_has_permission->model_type = $request->model_type;
  $model_has_permission->model_id = $request->model_id;

    $update = $model_has_permission->update();

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
    $model = Model_has_permission::find($id);

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
