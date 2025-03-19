<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Neighbourhood;
use App\Models\FEERI\City;



class NeighbourhoodController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$neighbourhoods = \App\Models\FEERI\Neighbourhood::get();

$cities = \App\Models\FEERI\City::get();
   
   $data = $request->all();


  $neighbourhoods = Neighbourhood::orderby('id','DESC')

  ->where(function ($query) use ($data) {

      if(isset($data['city_id']) && $data['city_id'] != 'all' ){
            
                 $query->where('city_id' , $data['city_id']);   
            }
 
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

return view('FEERI.neighbourhoods.neighbourhoods')

->with('neighbourhoods',$neighbourhoods)
->with('cities',$cities)
;

//searchfun


                        return view('FEERI.neighbourhoods.neighbourhoods' , compact('neighbourhoods'));

    }






        public function create()
    {

   $cities = City::all();
       return view('FEERI.neighbourhoods.neighbourhood_add')->with('cities' , $cities)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'city_id' => 'required',

       'name' => 'required',

       'en_name' => 'required',]);
    $neighbourhood = new Neighbourhood ();

         $neighbourhood->city_id = $request->city_id;
  $neighbourhood->name = $request->name;
  $neighbourhood->en_name = $request->en_name;
  $neighbourhood->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $neighbourhood->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('neighbourhoods.show', $neighbourhood->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:neighbourhoods,id',]);

    $neighbourhood = Neighbourhood::find($id);
    $next = Neighbourhood::where('id','>',$id)->min('id');
    $previous = Neighbourhood::where('id','<',$id)->max('id');
$cities = City::all();
       return view('FEERI.neighbourhoods.neighbourhood_view')
        ->with('neighbourhood',$neighbourhood)
        ->with('next',$next)
        ->with('previous',$previous)->with('cities' , $cities)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $neighbourhood = Neighbourhood::find($id); 

      $neighbourhood->city_id = $request->city_id;
  $neighbourhood->name = $request->name;
  $neighbourhood->en_name = $request->en_name;
  $neighbourhood->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $neighbourhood->update();

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
    $model = Neighbourhood::find($id);

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
