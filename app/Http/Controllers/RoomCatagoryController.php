<?php

namespace App\Http\Controllers;

use App\Models\RoomCatagory;
use Illuminate\Http\Request;

use Image;


class RoomCatagoryController extends Controller
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
    public function AddGalleryonChildContent(Request $request)
    
        {
            
            $galleryImage  = RoomCatagory::orderBy('created_at', 'desc')->simplePaginate(10);
           
            return view('admin.childcontentgallery.all-childcontent', compact('galleryImage'));
            // ->with('i', (request()->input('page', 1) - 1) * 5); 
        }
    
    public function Viewchildcontentgallery(Request $request)
    {
       
        $galleryImage  = RoomCatagory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('admin.childcontentgallery.list', compact('galleryImage'));
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomCatagory  $roomCatagory
     * @return \Illuminate\Http\Response
     */
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
            ->save('uploads/roomcatagory/' . $name_gen, 95);
        $save_url = 'uploads/roomcatagory/' . $name_gen;
    	

        RoomCatagory::insert([
        'name' => $request->name,
        'category' => $request->category,
        'caption' => $request->name,
        'image' => $save_url,
        'child_pages_id' => $request->child_pages_id,
       ]);
        

        $notification = array(
			'message' => 'GalleryImage added successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('childcontentall.gallery')->with($notification);   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomCatagory  $roomCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomCatagory $roomCatagory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomCatagory  $roomCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomCatagory $roomCatagory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomCatagory  $roomCatagory
     * @return \Illuminate\Http\Response
     */
    public function DeleteChildCOntentGallery(RoomCatagory $roomCatagory, $id)
    {
        {
            RoomCatagory::find($id)->delete();
            $notification = array(
             'message' => 'GalleryImage Deleted Successfully',
             'alert-type' => 'success'
         );
             return redirect()->back()->with($notification);
         }
    }
}