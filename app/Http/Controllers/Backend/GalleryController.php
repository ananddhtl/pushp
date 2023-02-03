<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Image;

class GalleryController extends Controller
{
    public function gallery()
    {
        $galleryImage  = Gallery::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.galleryimage.all-galleryimage', compact('galleryImage'));
        // ->with('i', (request()->input('page', 1) - 1) * 5); 
    }

    public function GalleryStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'caption' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);
       
        $image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(600,600)->save('uploads/gallery/'.$name_gen);
        Image::make($image->getRealPath())->resize(
            1024,
            683,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )
            ->resizeCanvas(null, 683)
            ->save('uploads/gallery/' . $name_gen, 95);
        $save_url = 'uploads/gallery/' . $name_gen;
    	

       Gallery::insert([
        'name' => $request->name,
        'category' => $request->category,
        'caption' => $request->name,
        'image' => $save_url,

       ]);

        $notification = array(
			'message' => 'GalleryImage added successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('all.gallery')->with($notification);   
    }
    

    public function EditGallery($id)
    {
        $Gallery = Gallery::find($id);
        return view('admin.galleryimage.edit-gallery', compact('Gallery'));
    }

    public function  DeleteGallery($id)
    { {
           Gallery::find($id)->delete();
           $notification = array(
			'message' => 'GalleryImage Deleted Successfully',
			'alert-type' => 'success'
		);
            return redirect()->back()->with($notification);
        }
    }
    public function UpdateGallery(Request $request,$id)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

    	if ($request->file('image')) {
        @unlink($old_img);
    	$image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(600,600)->save('uploads/gallery/'.$name_gen);
        Image::make($image->getRealPath())->resize(
            1024,
            683,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )
            ->resizeCanvas(null, 683)
            ->save('uploads/gallery/' . $name_gen, 95);
        $save_url = 'uploads/gallery/' . $name_gen;
        
	     Gallery::findOrFail($brand_id)->update([
            'name' => $request->name,
            'category' => $request->category,
            'caption' => $request->name,
            'image' => $save_url,

    	]);
    $notification = array(
        'message' => 'GalleryImage Updated successfully',
        'alert-type' => 'info'
    );
    return Redirect()->route('all.gallery')->with($notification);

  }   else{

    Gallery::findOrFail($brand_id)->update([
    'name' => $request->name,
    'category' => $request->category,
    'caption'=> $request->caption,

    ]);
    $notification = array(
        'message' => 'GalleryImage Updated successfully',
        'alert-type' => 'info'
    );
    return Redirect()->route('all.gallery')->with($notification)
        ->with($notification);
}                   
}
}