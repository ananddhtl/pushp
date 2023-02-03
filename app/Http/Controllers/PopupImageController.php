<?php

namespace App\Http\Controllers;

use App\Models\PopupImage;
use Illuminate\Http\Request;
use Image;

class PopupImageController extends Controller
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

    public function PopUpImage()
    {   
       
        $popupimages = PopupImage::orderBy('created_at', 'desc')->simplePaginate(5);

        return view('admin.popupimage.all-popupImage ', compact('popupimages'));
        // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Addslider()
    {
        return view('admin.popupimage.add-sliderimage');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function PopUpImageStore(Request $request)
    {     
     
        $image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	// Image::make($image)->resize(600,600)->save('uploads/slider/'.$name_gen);
        Image::make($image->getRealPath())->resize(
            1575,
            883,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )
            ->resizeCanvas(null, 883)
            ->save('uploads/slider/' . $name_gen, 95);
    	$save_url = 'uploads/slider/'.$name_gen;

       PopupImage::create([
        'image' => $save_url,
       ]);
        $notification = array(
			'message' => 'PopUpImage added successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('PopUpImage')->with($notification);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */
    public function PopUpImageEdit($id)
    {
        $sliderimage = PopupImage::find($id);
        return view('admin.popupimage.edit-sliderimage', compact('sliderimage'));
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */
    public function UpdatePopUpImage(Request $request, $id)
    {      // dd($request->caption);


        $brand_id = $request->id;
        $old_img = $request->old_image;

    	if ($request->file('image')) {
        @unlink($old_img);
    	$image = $request->file('image');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	//Image::make($image)->resize(600,600)->save('uploads/slider/'.$name_gen);

        Image::make($image->getRealPath())->resize(
            1575,
            883,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )
            ->resizeCanvas(null, 883)
            ->save('uploads/slider/' . $name_gen, 95);


    	$save_url = 'uploads/slider/'.$name_gen;

	     PopupImage::findOrFail($brand_id)->update([
		'name' => $request->name,
		'caption' => $request->caption,
		'image' => $save_url,

    	]);

	    $notification = array(
			'message' => 'PopUpImage Updated successfully',
			'alert-type' => 'info'
		);

		return redirect()->route('PopUpImage')
            ->with($notification);

    	
        
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */
    public function DelelePopUpImage($id)
    { 
        PopupImage::find($id)->delete();
        $notification = array(
			'message' => 'PopUpImage deleted successfully',
			'alert-type' => 'info'
		);
            return redirect()->back()
                ->with($notification);
        }
}
