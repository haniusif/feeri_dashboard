<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Driver_bank_account;
use App\Models\FEERI\Bank;
use App\Models\FEERI\Driver;



class Driver_bank_accountController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$driver_bank_accounts = \App\Models\FEERI\Driver_bank_account::get();

$drivers = \App\Models\FEERI\Driver::get();

$banks = \App\Models\FEERI\Bank::get();
   
   $data = $request->all();


  $driver_bank_accounts = Driver_bank_account::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['driver_id']) && $data['driver_id'] != 'all' ){
            
                 $query->where('driver_id' , $data['driver_id']);   
            }
      if(isset($data['bank_id']) && $data['bank_id'] != 'all' ){
            
                 $query->where('bank_id' , $data['bank_id']);   
            }
 
  if(isset($data['account_number']) &&  $data['account_number'] != null ){
                   $query->where('account_number' , 'like'  , '%' .$data['account_number']. '%' );   
               }

                
  if(isset($data['ipan']) &&  $data['ipan'] != null ){
                   $query->where('ipan' , 'like'  , '%' .$data['ipan']. '%' );   
               }

                     if(isset($data['is_default']) && $data['is_default'] != 'all' ){
            
                 $query->where('is_default' , $data['is_default']);   
            }
 
  if(isset($data['created_at']) &&  $data['created_at'] != null ){
                   $query->where('created_at' , 'like'  , '%' .$data['created_at']. '%' );   
               }

                
  if(isset($data['updated_at']) &&  $data['updated_at'] != null ){
                   $query->where('updated_at' , 'like'  , '%' .$data['updated_at']. '%' );   
               }

                
 
 })
  ->paginate(50);

return view('FEERI.driver_bank_accounts.driver_bank_accounts')

->with('driver_bank_accounts',$driver_bank_accounts)
->with('drivers',$drivers)
->with('banks',$banks)
;

//searchfun


                        return view('FEERI.driver_bank_accounts.driver_bank_accounts' , compact('driver_bank_accounts'));

    }







        public function create()
    {

   $banks = Bank::all();
$drivers = Driver::all();
       return view('FEERI.driver_bank_accounts.driver_bank_account_add')->with('banks' , $banks)
->with('drivers' , $drivers)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'driver_id' => 'required',

       'bank_id' => 'required',

       'account_number' => 'required',

       'ipan' => 'required',]);
    $driver_bank_account = new Driver_bank_account ();

         $driver_bank_account->driver_id = $request->driver_id;
  $driver_bank_account->bank_id = $request->bank_id;
  $driver_bank_account->account_number = $request->account_number;
  $driver_bank_account->ipan = $request->ipan;
  $driver_bank_account->is_default = ($request->is_default) ? $request->is_default : 0;
  $driver_bank_account->created_by = Auth::user()->id; 
  $driver_bank_account->updated_by = Auth::user()->id; 


    $save = $driver_bank_account->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('driver_bank_accounts.show', $driver_bank_account->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:driver_bank_accounts,id',]);

    $driver_bank_account = Driver_bank_account::find($id);
    $next = Driver_bank_account::where('id','>',$id)->min('id');
    $previous = Driver_bank_account::where('id','<',$id)->max('id');
$banks = Bank::all();
$drivers = Driver::all();
       return view('FEERI.driver_bank_accounts.driver_bank_account_view')
        ->with('driver_bank_account',$driver_bank_account)
        ->with('next',$next)
        ->with('previous',$previous)->with('banks' , $banks)
->with('drivers' , $drivers)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $driver_bank_account = Driver_bank_account::find($id); 

      $driver_bank_account->driver_id = $request->driver_id;
  $driver_bank_account->bank_id = $request->bank_id;
  $driver_bank_account->account_number = $request->account_number;
  $driver_bank_account->ipan = $request->ipan;
  $driver_bank_account->is_default = ($request->is_default) ? $request->is_default : 0;
  $driver_bank_account->updated_by = Auth::user()->id; 

    $update = $driver_bank_account->update();

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
    $model = Driver_bank_account::find($id);

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
