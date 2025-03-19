<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\User;



class UserController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$users = \App\Models\FEERI\User::get();
   
   $data = $request->all();


  $users = User::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['first_name']) &&  $data['first_name'] != null ){
                   $query->where('first_name' , 'like'  , '%' .$data['first_name']. '%' );   
               }

                
  if(isset($data['last_name']) &&  $data['last_name'] != null ){
                   $query->where('last_name' , 'like'  , '%' .$data['last_name']. '%' );   
               }

                
  if(isset($data['phone_number']) &&  $data['phone_number'] != null ){
                   $query->where('phone_number' , 'like'  , '%' .$data['phone_number']. '%' );   
               }

                
  if(isset($data['email']) &&  $data['email'] != null ){
                   $query->where('email' , 'like'  , '%' .$data['email']. '%' );   
               }

                
  if(isset($data['user_type']) &&  $data['user_type'] != null ){
                   $query->where('user_type' , 'like'  , '%' .$data['user_type']. '%' );   
               }

                     if(isset($data['is_active']) && $data['is_active'] != 'all' ){
            
                 $query->where('is_active' , $data['is_active']);   
            }
      if(isset($data['is_verified']) && $data['is_verified'] != 'all' ){
            
                 $query->where('is_verified' , $data['is_verified']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.users.users')

->with('users',$users)
;

//searchfun


                        return view('FEERI.users.users' , compact('users'));

    }





        public function create()
    {

          return view('FEERI.users.user_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'first_name' => 'required',

       'last_name' => 'required',

       'phone_number' => 'required',

       'email' => 'required',

       'password' => 'required',

       'user_type' => 'required',]);
    $user = new User ();

         $user->first_name = $request->first_name;
  $user->last_name = $request->last_name;
  $user->phone_number = $request->phone_number;
  $user->email = $request->email;
  $user->user_type = $request->user_type;
  $user->is_active = ($request->is_active) ? $request->is_active : 0;
  $user->is_verified = ($request->is_verified) ? $request->is_verified : 0;
  $user->created_by = Auth::user()->id; 
  $user->updated_by = Auth::user()->id; 


    $save = $user->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('users.show', $user->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:users,id',]);

    $user = User::find($id);
    $next = User::where('id','>',$id)->min('id');
    $previous = User::where('id','<',$id)->max('id');
       return view('FEERI.users.user_view')
        ->with('user',$user)
        ->with('next',$next)
        ->with('previous',$previous)            ;

     }

    public function my_profile()
    {
     // $user = User::find($id);
       $user = Auth::user();

       return view('FEERI.users.my_profile')
        ->with('user',$user)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $user = User::find($id); 

      $user->first_name = $request->first_name;
  $user->last_name = $request->last_name;
  $user->phone_number = $request->phone_number;
  $user->email = $request->email;
  $user->user_type = $request->user_type;
  $user->is_active = ($request->is_active) ? $request->is_active : 0;
  $user->is_verified = ($request->is_verified) ? $request->is_verified : 0;
  $user->updated_by = Auth::user()->id; 

    $update = $user->update();

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
    $model = User::find($id);

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
