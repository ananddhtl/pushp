<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class PublicationController extends Controller
{
    public function Addpublication()
    {
        return view('admin.Publication.add-Publication');
    }

    public function publicationStore(Request $request)
    {                
        $request->validate([
            'header'=>'required',
            // 'text' => 'required',
            'title'=>'required',         
            // 'image' => 'required|max:2048',
    
        ]);
                $post = new Publication();
                $post->title =$request->title;
                $post->header =$request->header;
                $post->description =$request->text;

               if ($image = $request->file('image'))
               {
                    $image=$request->file('image');
                    $imageName=time().'.'.$image->extension();
                    $image->move(public_path('uploads/Publicationfile'), $imageName); 
                    $post->image=$imageName;
                    
                }
                $post->save();
                $notification = array(
                    'message' => 'Publication added successfully',
                    'alert-type' => 'success'
                );

                return Redirect()->route('all.publication')->with($notification);
           
    }

    public function publications()
    {
         $publications = Publication::all();
        return view('admin.Publication.all-Publication',compact('publications'));
    }

    public function Editpublication($id)
    { 
    
        $publication = Publication::FindorFail($id);
        return view('admin.Publication.edit-Publication', compact('publication'));

    }

    public function Updatepublication(Request $request, $id)
    {      
      $post=Publication::find($request->id); 
      $post->title =$request->title;
      $post->header =$request->header;
      $post->description =$request->text;
      if($request->hasfile('image'))
        {
            $destination ='uploads/Publicationfile'. $post->image;
            if(File::exists($destination))
            { 
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/Publicationfile',$filename); 
            $post->image=$filename;

        } 
      $post->update();
      $notification = array(
        'message' => 'Publication Updated successfully',
        'alert-type' => 'info'
    );
      return Redirect()->route('all.publication')->with($notification);

    }

    public function Deletepublication($id)
     {
        $post = Publication::find($id);
        $post->delete();
        $notification = array(
            'message' => 'Publication deleted successfully',
            'alert-type' => 'info'
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
