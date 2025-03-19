<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Order_activity;
use App\Models\FEERI\Order;
use App\Models\FEERI\User;



class Order_activityController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$order_activities = \App\Models\FEERI\Order_activity::get();

$orders = \App\Models\FEERI\Order::get();

$users = \App\Models\FEERI\User::get();
   
   $data = $request->all();


  $order_activities = Order_activity::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['order_id']) && $data['order_id'] != 'all' ){
            
                 $query->where('order_id' , $data['order_id']);   
            }
 
  if(isset($data['current_status']) &&  $data['current_status'] != null ){
                   $query->where('current_status' , 'like'  , '%' .$data['current_status']. '%' );   
               }

                
  if(isset($data['activity_type']) &&  $data['activity_type'] != null ){
                   $query->where('activity_type' , 'like'  , '%' .$data['activity_type']. '%' );   
               }

                
  if(isset($data['description']) &&  $data['description'] != null ){
                   $query->where('description' , 'like'  , '%' .$data['description']. '%' );   
               }

                     if(isset($data['user_id']) && $data['user_id'] != 'all' ){
            
                 $query->where('user_id' , $data['user_id']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.order_activities.order_activities')

->with('order_activities',$order_activities)
->with('orders',$orders)
->with('users',$users)
;

//searchfun


                        return view('FEERI.order_activities.order_activities' , compact('order_activities'));

    }







        public function create()
    {

   $orders = Order::all();
$users = User::all();
       return view('FEERI.order_activities.order_activity_add')->with('orders' , $orders)
->with('users' , $users)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'order_id' => 'required',

       'current_status' => 'required',

       'activity_type' => 'required',

       'description' => 'required',

       'user_id' => 'required',]);
    $order_activity = new Order_activity ();

         $order_activity->order_id = $request->order_id;
  $order_activity->current_status = $request->current_status;
  $order_activity->activity_type = $request->activity_type;
  $order_activity->description = $request->description;
  $order_activity->user_id = $request->user_id;


    $save = $order_activity->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('order_activities.show', $order_activity->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:order_activities,id',]);

    $order_activity = Order_activity::find($id);
    $next = Order_activity::where('id','>',$id)->min('id');
    $previous = Order_activity::where('id','<',$id)->max('id');
$orders = Order::all();
$users = User::all();
       return view('FEERI.order_activities.order_activity_view')
        ->with('order_activity',$order_activity)
        ->with('next',$next)
        ->with('previous',$previous)->with('orders' , $orders)
->with('users' , $users)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $order_activity = Order_activity::find($id); 

      $order_activity->order_id = $request->order_id;
  $order_activity->current_status = $request->current_status;
  $order_activity->activity_type = $request->activity_type;
  $order_activity->description = $request->description;
  $order_activity->user_id = $request->user_id;

    $update = $order_activity->update();

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
    $model = Order_activity::find($id);

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
