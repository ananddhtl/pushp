<?php

namespace App\Http\Controllers;

use App\Models\GalleriesRoom;
use Illuminate\Http\Request;
use Image;

class GalleriesRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleriesRoom  $galleriesRoom
     * @return \Illuminate\Http\Response
     */
    public function show(GalleriesRoom $galleriesRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleriesRoom  $galleriesRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleriesRoom $galleriesRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleriesRoom  $galleriesRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleriesRoom $galleriesRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleriesRoom  $galleriesRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleriesRoom $galleriesRoom)
    {
        //
    }
    public function DeleteChildCOntentGallery(GalleriesRoom $galleriesRoom, $id)
    {
        {
            GalleriesRoom::find($id)->delete();
            $notification = array(
             'message' => 'GalleryImage Deleted Successfully',
             'alert-type' => 'success'
         );
             return redirect()->back()->with($notification);
         }
    }
    public function ChildContentGalleryStore(Request $request)
    {
       
       
       
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
            ->save('uploads/roomgallery/' . $name_gen, 95);
        $save_url = 'uploads/roomgallery/' . $name_gen;
    	

        GalleriesRoom::insert([
       
       
        'image' => $save_url,
        'child_content_id' => $request->child_content_id,
       ]);
        

        $notification = array(
			'message' => 'GalleryImage added successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('childcontentall.gallery')->with($notification);   
    }
    public function AddGalleryonChildContent(Request $request)
    
        {
            
            $galleryImage  = GalleriesRoom::orderBy('created_at', 'desc')->simplePaginate(10);
           
            return view('admin.childcontentgallery.all-childcontent', compact('galleryImage'));
            // ->with('i', (request()->input('page', 1) - 1) * 5); 
        }
    
    public function Viewchildcontentgallery(Request $request)
    {
      
        $childcontents = \DB::table('child_pages')
        ->join('galleries_rooms', 'child_pages.id', '=', 'galleries_rooms.child_content_id')
        ->select('child_pages.*', 'child_pages.child_title')
        ->get();

     
        $galleryImage  = GalleriesRoom::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.childcontentgallery.list', compact('galleryImage','childcontents'));
      
    }

}