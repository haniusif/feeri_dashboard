<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Bank;



class BankController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$banks = \App\Models\FEERI\Bank::get();
   
   $data = $request->all();


  $banks = Bank::orderby('id','DESC')

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

return view('FEERI.banks.banks')

->with('banks',$banks)
;

//searchfun


                        return view('FEERI.banks.banks' , compact('banks'));

    }





        public function create()
    {

          return view('FEERI.banks.bank_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',]);
    $bank = new Bank ();

         $bank->name = $request->name;
  $bank->en_name = $request->en_name;
  $bank->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $bank->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('banks.show', $bank->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:banks,id',]);

    $bank = Bank::find($id);
    $next = Bank::where('id','>',$id)->min('id');
    $previous = Bank::where('id','<',$id)->max('id');
       return view('FEERI.banks.bank_view')
        ->with('bank',$bank)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $bank = Bank::find($id); 

      $bank->name = $request->name;
  $bank->en_name = $request->en_name;
  $bank->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $bank->update();

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
    $model = Bank::find($id);

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
