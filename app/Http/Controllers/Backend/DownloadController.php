<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function AddDownload()
    {
        return view('admin.blog.add-blog');
    }

    public function DownloadStore(Request $request)
    {                
        $request->validate([
            'header'=>'required',
            'title'=>'required',         
            'image' => 'required|max:2048',
    
        ]);
        
                $download = new Download();
                $download->title =$request->title;
                $download->header =$request->header;
               
                if ($image = $request->file('image'))
               {
                    $image=$request->file('image');
                    $imageName=time().'.'.$image->extension();
                    $image->move(public_path('/uploads/download'), $imageName); 
                    $download->image=$imageName;  
                }
                $download->save();
                $notification = array(
                    'message' => 'Download Content Added successfully',
                    'alert-type' => 'success');
                return redirect()->back()->with($notification ); 
           
    }

    public function Download()
    {
        $downloads = Download::simplePaginate(10);
        return view('admin.download.all-download',compact('downloads'));
    }

    public function EditDownload($id)
    { 
    
        $downloads = Download::FindorFail($id);
        return view('admin.download.edit-download', compact('downloads'));

    }

    public function UpdateDownload(Request $request, $id)
    {      
      $downlaods=Download::find($request->id); 
      $downlaods->title =$request->title;
      $downlaods->header =$request->header;
      if($request->hasfile('image'))
        {
            $destination ='/uploads/download/'. $downlaods->image;
            if(File::exists($destination))
            { 
                File::delete($destination);

            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('/uploads/download/',$filename); 
            $downlaods->image=$filename;

        } 
     
        $downlaods->update();
        $notification = array(
        'message' => 'Download Content Updated Successfully',
        'alert-type' => 'info');
      return redirect()->route('all.blogs')->with($notification);

    }

    public function DeleteDownload($id)
     {
        $download = Download::find($id);
        $download->delete();
        $notification = array(
            'message' => 'Download Content Deleted Successfully',
            'alert-type' => 'success');
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
