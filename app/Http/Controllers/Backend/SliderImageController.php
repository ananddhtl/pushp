<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Image;


class SliderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sliderImage()
    {

        $sliderimages = SliderImage::orderBy('created_at', 'desc')->simplePaginate(10);

        return view('admin.sliderimage.all-sliderimage', compact('sliderimages'));
        // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Addslider()
    {
        return view('admin.sliderimage.add-sliderimage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slideimageStore(Request $request)
    {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(600,600)->save('uploads/slider/'.$name_gen);
        Image::make($image->getRealPath())->resize(
            1575,
            883,
            function ($constraint) {
                $constraint->aspectRatio();
            }
        )
            ->resizeCanvas(null, null)
            ->save('uploads/slider/' . $name_gen, 95);
        $save_url = 'uploads/slider/' . $name_gen;

        SliderImage::insert([
            'name' => $request->name,
            'caption' => $request->name,
            'image' => $save_url,
        ]);
        $notification = array(
            'message' => 'SliderImage added successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.sliderimage')->with($notification);
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
    public function EditSliderImage($id)
    {
        $sliderimage = SliderImage::find($id);
        return view('admin.sliderimage.edit-sliderimage', compact('sliderimage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */
    public function UpdateSliderImage(Request $request, $id)
    {      // dd($request->caption);


        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            @unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            //Image::make($image)->resize(600,600)->save('uploads/slider/'.$name_gen);

            Image::make($image->getRealPath())->resize(
                1575,
                883,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )
                ->resizeCanvas(null, null)
                ->save('uploads/slider/' . $name_gen, 95);


            $save_url = 'uploads/slider/' . $name_gen;

            SliderImage::findOrFail($brand_id)->update([
                'name' => $request->name,
                'caption' => $request->caption,
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'SliderImage Updated successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('all.sliderimage')
                ->with($notification);
        } else {

            SliderImage::findOrFail($brand_id)->update([
                'name' => $request->name,
                'caption' => $request->caption,

            ]);
            $notification = array(
                'message' => 'SliderImage Updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.sliderimage')
                ->with($notification);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SliderImage  $sliderImage
     * @return \Illuminate\Http\Response
     */
    public function Deleleslider($id)
    {
        SliderImage::find($id)->delete();
        $notification = array(
            'message' => 'SliderImage deleted successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()
            ->with($notification);
    }
}
