<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Order_status;



class Order_statusController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$order_statuses = \App\Models\FEERI\Order_status::get();
   
   $data = $request->all();


  $order_statuses = Order_status::orderby('id','DESC')

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

return view('FEERI.order_statuses.order_statuses')

->with('order_statuses',$order_statuses)
;

//searchfun


                        return view('FEERI.order_statuses.order_statuses' , compact('order_statuses'));

    }





        public function create()
    {

          return view('FEERI.order_statuses.order_status_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',]);
    $order_status = new Order_status ();

         $order_status->name = $request->name;
  $order_status->en_name = $request->en_name;
  $order_status->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $order_status->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('order_statuses.show', $order_status->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:order_statuses,id',]);

    $order_status = Order_status::find($id);
    $next = Order_status::where('id','>',$id)->min('id');
    $previous = Order_status::where('id','<',$id)->max('id');
       return view('FEERI.order_statuses.order_status_view')
        ->with('order_status',$order_status)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $order_status = Order_status::find($id); 

      $order_status->name = $request->name;
  $order_status->en_name = $request->en_name;
  $order_status->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $order_status->update();

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
    $model = Order_status::find($id);

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
