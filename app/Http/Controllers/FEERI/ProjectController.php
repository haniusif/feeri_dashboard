<?php

namespace App\Http\Controllers\FEERI;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\FEERI\Project;
use App\Models\FEERI\Project_status;



class ProjectController extends Controller
{



    public function index(Request $request)
    {

        // pure

                        
$projects = \App\Models\FEERI\Project::get();

$project_statuses = \App\Models\FEERI\Project_status::get();
   
   $data = $request->all();


  $projects = Project::orderby('id','DESC')

  ->where(function ($query) use ($data) {

 
  if(isset($data['name']) &&  $data['name'] != null ){
                   $query->where('name' , 'like'  , '%' .$data['name']. '%' );   
               }

                
  if(isset($data['en_name']) &&  $data['en_name'] != null ){
                   $query->where('en_name' , 'like'  , '%' .$data['en_name']. '%' );   
               }

                
  if(isset($data['logo']) &&  $data['logo'] != null ){
                   $query->where('logo' , 'like'  , '%' .$data['logo']. '%' );   
               }

                
  if(isset($data['contact_name']) &&  $data['contact_name'] != null ){
                   $query->where('contact_name' , 'like'  , '%' .$data['contact_name']. '%' );   
               }

                
  if(isset($data['contact_email']) &&  $data['contact_email'] != null ){
                   $query->where('contact_email' , 'like'  , '%' .$data['contact_email']. '%' );   
               }

                
  if(isset($data['contact_phone_number']) &&  $data['contact_phone_number'] != null ){
                   $query->where('contact_phone_number' , 'like'  , '%' .$data['contact_phone_number']. '%' );   
               }

                
  if(isset($data['tax_number']) &&  $data['tax_number'] != null ){
                   $query->where('tax_number' , 'like'  , '%' .$data['tax_number']. '%' );   
               }

                
  if(isset($data['cr_number']) &&  $data['cr_number'] != null ){
                   $query->where('cr_number' , 'like'  , '%' .$data['cr_number']. '%' );   
               }

                
  if(isset($data['address']) &&  $data['address'] != null ){
                   $query->where('address' , 'like'  , '%' .$data['address']. '%' );   
               }

                     if(isset($data['project_status_id']) && $data['project_status_id'] != 'all' ){
            
                 $query->where('project_status_id' , $data['project_status_id']);   
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

return view('FEERI.projects.projects')

->with('projects',$projects)
->with('project_statuses',$project_statuses)
;

//searchfun


                        return view('FEERI.projects.projects' , compact('projects'));

    }






        public function create()
    {

   $project_statuses = Project_status::all();
       return view('FEERI.projects.project_add')->with('project_statuses' , $project_statuses)

       ;
 }


 public function store(Request $request)
    {

       $validated = $request->validate([



       'name' => 'required',

       'en_name' => 'required',

       'logo' => 'required',

       'contact_name' => 'required',

       'contact_email' => 'required',

       'contact_phone_number' => 'required',

       'tax_number' => 'required',

       'cr_number' => 'required',

       'address' => 'required',

       'project_status_id' => 'required',]);
    $project = new Project ();

         $project->name = $request->name;
  $project->en_name = $request->en_name;

  if ($request->hasFile('logo')) {
  if ($request->file('logo')->isValid()) {
  $file = $request->file('logo');
  $destinationPath = 'images/projects';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $project->logo = '/'.$destinationPath."/".$fileName;

      }}
  $project->contact_name = $request->contact_name;
  $project->contact_email = $request->contact_email;
  $project->contact_phone_number = $request->contact_phone_number;
  $project->tax_number = $request->tax_number;
  $project->cr_number = $request->cr_number;
  $project->address = $request->address;
  $project->project_status_id = $request->project_status_id;
  $project->is_active = ($request->is_active) ? $request->is_active : 0;
  $project->created_by = Auth::user()->id; 
  $project->updated_by = Auth::user()->id; 


    $save = $project->save();

if ($save) {
    Session::flash('alert-success-link', true);
    Session::flash('alert-link', route('projects.show', $project->id));
    Session::flash('message', __('The record has been successfully added. You can view it here.'));
} else {
    Session::flash('alert-danger', true);
    Session::flash('message', __('An error occurred while saving the record. Please try again later.'));
}

return back();
}
    public function show($id,Request $request)
    {
   // $this->validate($request, ['id' => 'required|exists:projects,id',]);

    $project = Project::find($id);
    $next = Project::where('id','>',$id)->min('id');
    $previous = Project::where('id','<',$id)->max('id');
$project_statuses = Project_status::all();
       return view('FEERI.projects.project_view')
        ->with('project',$project)
        ->with('next',$next)
        ->with('previous',$previous)->with('project_statuses' , $project_statuses)
      ;

     }


    public function edit($id)
    {
    
}

     public function update(Request $request, $id)
    {

      $project = Project::find($id); 

      $project->name = $request->name;
  $project->en_name = $request->en_name;

  if ($request->hasFile('logo')) {
  if ($request->file('logo')->isValid()) {
  $file = $request->file('logo');
  $destinationPath = 'images/projects';
  $fileName = rand(11111,99999).'_file.'.$file->getClientOriginalExtension(); // renameing image
  $file->move($destinationPath,$fileName);
  $project->logo = '/'.$destinationPath."/".$fileName;

      }}
  $project->contact_name = $request->contact_name;
  $project->contact_email = $request->contact_email;
  $project->contact_phone_number = $request->contact_phone_number;
  $project->tax_number = $request->tax_number;
  $project->cr_number = $request->cr_number;
  $project->address = $request->address;
  $project->project_status_id = $request->project_status_id;
  $project->is_active = ($request->is_active) ? $request->is_active : 0;
  $project->updated_by = Auth::user()->id; 

    $update = $project->update();

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
    $model = Project::find($id);

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
