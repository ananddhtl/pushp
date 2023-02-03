<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\File;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonial()
    {
        $testimonials=Testimonial::orderBy('created_at','desc')->simplePaginate(10);

        return view('admin.testimonial.all-testimonial', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.add-testimonial');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Testimonialstore(Request $request)
    {
        //kdfjd
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input = $request->all();
     
        if ($image = $request->file('image')) 
        {
            $destinationPath = 'uploads/testimonial/';
            $testimonial = date('time') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $testimonial);
            $input['image'] = "$testimonial";
        }
    
        Testimonial::create($input);
        $notification = array(
			'message' => 'Testimonial  added successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('all.testimonial')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function EditTestimonial($id)
    {
        $testimonial= Testimonial::FindorFail($id);
        return view('admin.testimonial.edit-testimonial', compact('testimonial'));
    }

    public function Updateestimonial(Request $request,$id)
    {
        $testimonial = Testimonial::find($request->id);
        $testimonial->name = $request->name;
        $testimonial->description = $request->description;
        $testimonial->designation = $request->designation;

        if ($request->hasfile('image')) {
            $destination = 'uploads/testimonial/' . $testimonial->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/testimonial/', $filename);
            $testimonial->image = $filename;
        }

        $testimonial->update();
        $notification = array(
			'message' => 'Testimonial  added successfully',
			'alert-type' => 'info'
		);
        return redirect()->route('all.testimonial')->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */


