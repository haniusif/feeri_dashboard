<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Vehicle_color;



class Vehicle_colorController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$vehicle_colors = \App\Models\FEERI\Vehicle_color::get();
   
   $data = $request->all();


  $vehicle_colors = Vehicle_color::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                
  if(isset($data['color_code']) &&  $data['color_code'] != null ){
                   $query->where('color_code' , 'like'  , '%' .$data['color_code']. '%' );   
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

return view('FEERI.vehicle_colors.vehicle_colors')

->with('vehicle_colors',$vehicle_colors)
;

//searchfun


                        return view('FEERI.vehicle_colors.vehicle_colors' , compact('vehicle_colors'));

    }





        public function create()
    {

          return view('FEERI.vehicle_colors.vehicle_color_add')
       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',

       'color_code' => 'required',]);
    $vehicle_color = new Vehicle_color ();

         $vehicle_color->name = $request->name;
  $vehicle_color->en_name = $request->en_name;
  $vehicle_color->color_code = $request->color_code;
  $vehicle_color->is_active = ($request->is_active) ? $request->is_active : 0;


    $save = $vehicle_color->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('vehicle_colors.show', $vehicle_color->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:vehicle_colors,id',]);

    $vehicle_color = Vehicle_color::find($id);
    $next = Vehicle_color::where('id','>',$id)->min('id');
    $previous = Vehicle_color::where('id','<',$id)->max('id');
       return view('FEERI.vehicle_colors.vehicle_color_view')
        ->with('vehicle_color',$vehicle_color)
        ->with('next',$next)
        ->with('previous',$previous)      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $vehicle_color = Vehicle_color::find($id); 

      $vehicle_color->name = $request->name;
  $vehicle_color->en_name = $request->en_name;
  $vehicle_color->color_code = $request->color_code;
  $vehicle_color->is_active = ($request->is_active) ? $request->is_active : 0;

    $update = $vehicle_color->update();

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
    $model = Vehicle_color::find($id);

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
