<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Permission;



class PermissionController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$permissions = \App\Models\FEERI\Permission::get();
   
   $data = $request->all();


  $permissions = Permission::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['guard_name']) &&  $data['guard_name'] != null ){
                   $query->where('guard_name' , 'like'  , '%' .$data['guard_name']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.permissions.permissions')

->with('permissions',$permissions)
;

//searchfun


                        return view('FEERI.permissions.permissions' , compact('permissions'));

    }





        public function create()
    {

          return view('FEERI.permissions.permission_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'guard_name' => 'required',]);
    $permission = new Permission ();

         $permission->name = $request->name;
  $permission->guard_name = $request->guard_name;


    $save = $permission->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('permissions.show', $permission->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:permissions,id',]);

    $permission = Permission::find($id);
    $next = Permission::where('id','>',$id)->min('id');
    $previous = Permission::where('id','<',$id)->max('id');
       return view('FEERI.permissions.permission_view')
        ->with('permission',$permission)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $permission = Permission::find($id); 

      $permission->name = $request->name;
  $permission->guard_name = $request->guard_name;

    $update = $permission->update();

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
    $model = Permission::find($id);

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
