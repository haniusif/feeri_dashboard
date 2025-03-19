<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Order_message;
use App\Models\FEERI\Order;
use App\Models\FEERI\User;



class Order_messageController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$order_messages = \App\Models\FEERI\Order_message::get();

$orders = \App\Models\FEERI\Order::get();

$users = \App\Models\FEERI\User::get();

$users = \App\Models\FEERI\User::get();
   
   $data = $request->all();


  $order_messages = Order_message::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['order_id']) && $data['order_id'] != 'all' ){
            
                 $query->where('order_id' , $data['order_id']);   
            }
      if(isset($data['sender_id']) && $data['sender_id'] != 'all' ){
            
                 $query->where('sender_id' , $data['sender_id']);   
            }
      if(isset($data['receiver_id']) && $data['receiver_id'] != 'all' ){
            
                 $query->where('receiver_id' , $data['receiver_id']);   
            }
 
  if(isset($data['message']) &&  $data['message'] != null ){
                   $query->where('message' , 'like'  , '%' .$data['message']. '%' );   
               }

                
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.order_messages.order_messages')

->with('order_messages',$order_messages)
->with('orders',$orders)
->with('users',$users)
;

//searchfun
->with('users',$users)
;

//searchfun


                        return view('FEERI.order_messages.order_messages' , compact('order_messages'));

    }








        public function create()
    {

   $orders = Order::all();
$users = User::all();
       return view('FEERI.order_messages.order_message_add')->with('orders' , $orders)
->with('users' , $users)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'order_id' => 'required',

       'sender_id' => 'required',

       'receiver_id' => 'required',

       'message' => 'required',]);
    $order_message = new Order_message ();

         $order_message->order_id = $request->order_id;
  $order_message->sender_id = $request->sender_id;
  $order_message->receiver_id = $request->receiver_id;
  $order_message->message = $request->message;


    $save = $order_message->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('order_messages.show', $order_message->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:order_messages,id',]);

    $order_message = Order_message::find($id);
    $next = Order_message::where('id','>',$id)->min('id');
    $previous = Order_message::where('id','<',$id)->max('id');
$orders = Order::all();
$users = User::all();
       return view('FEERI.order_messages.order_message_view')
        ->with('order_message',$order_message)
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

      $order_message = Order_message::find($id); 

      $order_message->order_id = $request->order_id;
  $order_message->sender_id = $request->sender_id;
  $order_message->receiver_id = $request->receiver_id;
  $order_message->message = $request->message;

    $update = $order_message->update();

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
    $model = Order_message::find($id);

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
