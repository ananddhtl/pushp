<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildContent;
use App\Models\ChildPage;
use App\Models\ParentPage;
use Illuminate\Support\Facades\File;
use Image;

class ChildContentController extends Controller
{
    //
    public function AddChildContent()
    {
        $childpages = ChildPage::all();
        return view('admin.childcontent.add-childcontent', compact('childpages'));
    }

    public function ChildContentStore(Request $request)
    {
        $parentcontent = new ChildContent();
        $parentcontent->childpage_id = $request->childpage_id;
        $parentcontent->parentpage_id = $request->parentpage_id;
        $parentcontent->price = $request->price;
        $parentcontent->total_no_of_persons = $request->total_no_of_persons;
        $parentcontent->bedsize = $request->bedsize;
        $parentcontent->text = $request->text;
        if ($request->hasfile('thumbnailimg')) {
            $image = $request->file('thumbnailimg');
            $name_gen = time() . '.' . $image->extension();



            Image::make($image->getRealPath())->resize(
                1024,
                683,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )
                ->resizeCanvas(null, 683)
                ->save('uploads/childcontentimg/' . $name_gen, 95);





            // $image->move(public_path('/uploads/childcontentimg'), $imageName);

            $parentcontent->thumbnailimg = $name_gen;
        }
        $parentcontent->save();
        $notification = array(
            'message' => 'SubMenu Content Added Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }
    public function ChildContents()
    {
        $parentpages = ParentPage::where('ischild', '1')->get();

        //$childpages = ChildPage::all();
        $childcontents = ChildContent::with('childpage')->simplePaginate(10);

        return view('admin.childcontent.all-childcontent', compact('childcontents', 'parentpages'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('image'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('image/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
    public function EditChildContent($id)
    {

        $childcontent = ChildContent::FindorFail($id);
        $parentpages = ParentPage::where('ischild', '1')->get();
        $childpages = ChildPage::where([
            ['child_title', '!=', '$childpage->childpage->child_title'],
        ])->get();

        return view('admin.childcontent.edit-childcontent', compact('childcontent', 'childpages', 'parentpages'));
    }
    public function UpdateChildContent(Request $request)
    {
        // dd($request->all());


        $childcontent = ChildContent::find($request->id);
        $childcontent->childpage_id = $request->childpage_id;
        $childcontent->parentpage_id = $request->parentpage_id;
        $childcontent->price = $request->price;
        $childcontent->total_no_of_persons = $request->total_no_of_persons;
        $childcontent->bedsize = $request->bedsize;
        $childcontent->text = $request->text;
        if ($request->hasfile('thumbnailimg')) {
            $destination = 'uploads/childcontentimg/' . $childcontent->thumbnailimg;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $image = $request->file('thumbnailimg');
            $extension = $image->getClientOriginalExtension();
            $name_gen = time() . '.' . $extension;
            // $file->move('uploads/childcontentimg/', $filename);


            Image::make($image->getRealPath())->resize(
                1024,
                683,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )
                ->resizeCanvas(null, 683)
                ->save('uploads/childcontentimg/' . $name_gen, 95);



            $childcontent->thumbnailimg = $name_gen;
        }

        $childcontent->update();
        $notification = array(
            'message' => 'SubMenu Content Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.childcontent')->with($notification);
    }
    public function DeleleChildContent($id)
    {
        $childcontent = ChildContent::find($id);
        if (file_exists($childcontent->thumbnailimg)) {
            unlink(public_path('/uploads/childcontentimg') . '/' . $childcontent->thumbnailimg);
        }
        $childcontent->delete();
        return back()->with('childcontent_deleted', ' ChildContent is delete successfully');
    }
    public function deletechildcontentimage($id)
    {

        $childcontent = ChildContent::FindorFail($id);
        $childcontent->thumbnailimg = "";
        $childcontent->update();
        $notification = array(
            'message' => 'SubMenu Content added successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
