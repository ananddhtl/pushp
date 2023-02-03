<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;

class CareerController extends Controller
{
    public function AddCareer()
    {
        return view('admin.career.add-career');
    }

    public function CareerStore(Request $request)
    {                
       // dd($request->all());
        $request->validate([
            'name'=>'required',
            'caption'=>'required',          
        ]);
       
        $Careers=new Career();
        $Careers->name=$request->name;
        $Careers->caption=$request->caption;
        $Careers->save();

        //  dd($input);
        $notification = array(
			'message' => 'Career Content Added successfully',
			'alert-type' => 'success'
		);

       return redirect()->back()->with($notification);    
    }

    

    public function Career()
    {
         $Careers = Career::all();
        return view('admin.career.all-career',compact('Careers'));
    }

    public function EditCareer($id)
    { 
    
        $careers = Career::FindorFail($id);
        return view('admin.career.edit-career', compact('careers'));

    }

    public function UpdateCareer(Request $request, $id)
    {   
        $brand_id = $request->id;
       Career::findOrFail($brand_id)->update([
            'name' => $request->name,
            'caption'=> $request->caption,
            ]);
            $notification = array(
                'message' => 'Career Content deleted  successfully',
                'alert-type' => 'success'
            );
      return redirect()->route('all.career')->with($notification);

    }

    public function DeleteCareer($id)
     {
        $post = Career::find($id);
        $post->delete();
        $notification = array(
			'message' => 'Career Content deleted  successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification); 

     }

    public function upload(Request $request)
    {
        
        //getfilename with extension
        $filenamewithextension=$request->file('upload')->getClientOriginalName();
            
        //getfilename with out extension
        $filename=pathinfo($filenamewithextension, PATHINFO_FILENAME);
        
        //get file_extension
        $extension =$request->file('upload')->getClientOriginalExtension();
        //file name to store
        $filenametostore =$filename.'_'.time().'.'.$extension;
        //file upload
        $request->file('upload')->storeAs('public/uploads',$filenametostore);
        //$request->file('upload')->storeAs('public/uploads/thumbnail',$filenametostore);

        //Resize the image here
        /*$thumbnailpath = public_path('storage/uploads/thumbnail'.$filenametostore);
        $image= Image::make($thumbnailpath)->resize(500,150, function($constraint)
        {
           $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
*/

        echo json_encode(['fileName'=> $filenametostore]);
        /*echo json_encode([
           'default'=>asset('storage/uploads/'.$filenametostore),
           '500'=>asset('storage/uploads/thumbnail'.$filenametostore),
        ]); 
        */
    }
}