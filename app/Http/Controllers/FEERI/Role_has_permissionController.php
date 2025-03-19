<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Role_has_permission;
use App\Models\FEERI\Permission;
use App\Models\FEERI\Role;



class Role_has_permissionController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$role_has_permissions = \App\Models\FEERI\Role_has_permission::get();

$permissions = \App\Models\FEERI\Permission::get();

$roles = \App\Models\FEERI\Role::get();
   
   $data = $request->all();


  $role_has_permissions = Role_has_permission::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['permission_id']) && $data['permission_id'] != 'all' ){
            
                 $query->where('permission_id' , $data['permission_id']);   
            }
      if(isset($data['role_id']) && $data['role_id'] != 'all' ){
            
                 $query->where('role_id' , $data['role_id']);   
            }
 
 
 })
  ->paginate(50);

return view('FEERI.role_has_permissions.role_has_permissions')

->with('role_has_permissions',$role_has_permissions)
->with('permissions',$permissions)
->with('roles',$roles)
;

//searchfun


                        return view('FEERI.role_has_permissions.role_has_permissions' , compact('role_has_permissions'));

    }







        public function create()
    {

   $permissions = Permission::all();
$roles = Role::all();
       return view('FEERI.role_has_permissions.role_has_permission_add')->with('permissions' , $permissions)
->with('roles' , $roles)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'permission_id' => 'required',

       'role_id' => 'required',]);
    $role_has_permission = new Role_has_permission ();

         $role_has_permission->permission_id = $request->permission_id;
  $role_has_permission->role_id = $request->role_id;


    $save = $role_has_permission->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('role_has_permissions.show', $role_has_permission->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:role_has_permissions,id',]);

    $role_has_permission = Role_has_permission::find($id);
    $next = Role_has_permission::where('id','>',$id)->min('id');
    $previous = Role_has_permission::where('id','<',$id)->max('id');
$permissions = Permission::all();
$roles = Role::all();
       return view('FEERI.role_has_permissions.role_has_permission_view')
        ->with('role_has_permission',$role_has_permission)
        ->with('next',$next)
        ->with('previous',$previous)->with('permissions' , $permissions)
->with('roles' , $roles)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $role_has_permission = Role_has_permission::find($id); 

      $role_has_permission->permission_id = $request->permission_id;
  $role_has_permission->role_id = $request->role_id;

    $update = $role_has_permission->update();

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
    $model = Role_has_permission::find($id);

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
