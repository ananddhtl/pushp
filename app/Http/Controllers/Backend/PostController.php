<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Image;

class PostController extends Controller
{

    public function Addpost()
    {
        return view('admin.blog.add-blog');
    }

    public function BlogStore(Request $request)
    {
        $request->validate([
            'header' => 'required',
            'title' => 'required',
            // 'image' => 'required|max:2048',

        ]);
        $save_url = "";
        $image = $request->file('image');

        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // Image::make($image)->resize(600,600)->save('uploads/Postimg/'.$name_gen);


            if ($image->getClientOriginalExtension() == "pdf") {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('/uploads/Postimg'), $imageName);
                $save_url = 'uploads/Postimg/' . $imageName;
            } else {
                Image::make($image->getRealPath())->resize(
                    1024,
                    683,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )
                    ->resizeCanvas(null, 683)
                    ->save('uploads/Postimg/' . $name_gen, 100);

                $save_url = 'uploads/Postimg/' . $name_gen;
            }
        }

        Blog::create([
            'header' => $request->header,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Post Added successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function blogs()
    {
        $posts = Blog::orderBy('id','desc')->simplePaginate(10);
        return view('admin.blog.all-blog', compact('posts'));
    }

    public function EditBlog($id)
    {

        $post = Blog::FindorFail($id);
        return view('admin.blog.edit-blog', compact('post'));
    }

    public function UpdateBlog(Request $request, $id)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            @unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // Image::make($image)->resize(600, 600)->save('uploads/Postimg/' . $name_gen);
            // Image::make($image->getRealPath())->resize(
            //     1024,
            //     683,
            //     function ($constraint) {
            //         $constraint->aspectRatio();
            //     }
            // )
            //     ->resizeCanvas(null, 683)
            //     ->save('uploads/Postimg/' . $name_gen, 95);
            // $save_url = 'uploads/Postimg/' . $name_gen;


            // $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            // Image::make($image)->resize(600,600)->save('uploads/Postimg/'.$name_gen);


            if ($image->getClientOriginalExtension() == "pdf") {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('/uploads/Postimg'), $imageName);
                $save_url = 'uploads/Postimg/' . $imageName;
            } else {
                Image::make($image->getRealPath())->resize(
                    1024,
                    683,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )
                    ->resizeCanvas(null, 683)
                    ->save('uploads/Postimg/' . $name_gen, 100);

                $save_url = 'uploads/Postimg/' . $name_gen;
            }





            Blog::findOrFail($brand_id)->update([
                'header' => $request->header,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Post Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.posts')->with($notification);
        } else {

            Blog::findOrFail($brand_id)->update([
                'header' => $request->header,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            $notification = array(
                'message' => 'Post Updated Successfully',
                'alert-type' => 'info'
            );
            return Redirect()->route('all.posts')->with($notification)
                ->with($notification);
        }
    }

    public function DeleteBlog($id)
    {
        $post = Blog::find($id);
        $post->delete();
        $notification = array(
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function upload(Request $request)
    {

        //getfilename with extension
        $filenamewithextension = $request->file('upload')->getClientOriginalName();

        //getfilename with out extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file_extension
        $extension = $request->file('upload')->getClientOriginalExtension();
        //file name to store
        $filenametostore = $filename . '_' . time() . '.' . $extension;
        //file upload
        $request->file('upload')->storeAs('public/uploads', $filenametostore);
        //$request->file('upload')->storeAs('public/uploads/thumbnail',$filenametostore);

        //Resize the image here
        /*$thumbnailpath = public_path('storage/uploads/thumbnail'.$filenametostore);
        $image= Image::make($thumbnailpath)->resize(500,150, function($constraint)
        {
           $constraint->aspectRatio();
        });
        $img->save($thumbnailpath);
*/

        echo json_encode(['fileName' => $filenametostore]);
        /*echo json_encode([
           'default'=>asset('storage/uploads/'.$filenametostore),
           '500'=>asset('storage/uploads/thumbnail'.$filenametostore),
        ]); 
        */
    }
}
