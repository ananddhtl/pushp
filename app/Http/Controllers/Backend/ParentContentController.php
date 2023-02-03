<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentPage;
use App\Models\ParentContent;
use Illuminate\Support\Facades\File;

class ParentContentController extends Controller
{
    //

    public function AddParentContent()
    {
        $parentpages = ParentPage::where('ischild', 0);
        return view('backend.parentcontent.add-parentcontent', compact('parentpages'));
    }

    public function ParentContentStore(Request $request)
    {  
    
        $parentcontent = new ParentContent();
        $parentcontent->parentpage_id = $request->parentpage_id;
        $parentcontent->text = $request->text;
        // $parentcontent->Abouttext = $request->Abouttext;
        // $parentcontent->Itinerarytext = $request->Itinerarytext;
        // $parentcontent->Includedtext = $request->Includedtext;
        // $parentcontent->Reviewtext = $request->Reviewtext;

        if ($request->hasFile('thumbnailimg')) {

            $image = $request->file('thumbnailimg');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('/uploads/thumbnailimg'), $imageName);
            $parentcontent->thumbnailimg = $imageName;
        }

        $parentcontent->save();
        $notification = array(
			'message' => 'Menu Content added successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);

    }
    public function ParentContents()
    {
        $parentpages = ParentPage::where('ischild', 0)->get();
        $parentcontents = Parentcontent::simplePaginate(10);
        return view('admin.parentcontent.all-parentcontent', compact('parentcontents','parentpages'));
    }

    public function EditParentContent($id)
    {
        
        $parentcontent = ParentContent::FindorFail($id);
        $parentpages = ParentPage::where('ischild', 0)->get();

        return view('admin.parentcontent.edit-parentcontent', compact('parentcontent', 'parentpages'));
    }
    public function UpdateParentContent(Request $request)
    {
        $parentcontent = ParentContent::find($request->id);
        $parentcontent->parentpage_id = $request->parentpage_id;
        $parentcontent->text = $request->text;
        // $parentcontent->Abouttext = $request->Abouttext;
        // $parentcontent->Itinerarytext = $request->Itinerarytext;
        // $parentcontent->Includedtext = $request->Includedtext;
        // $parentcontent->Reviewtext = $request->Reviewtext;

        if($request->hasfile('thumbnailimg')) {
            $destination = 'uploads/thumbnailimg/' . $parentcontent->thumbnailimg;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('thumbnailimg');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/thumbnailimg/', $filename);
            $parentcontent->thumbnailimg = $filename;
        }

        $parentcontent->update();
        $notification = array(
			'message' => 'Menu Content Updated successfully',
			'alert-type' => 'info'
		);
        return redirect()->route('all.parentcontent')->with($notification);
    }
    public function DeleleParentContent($id)
    {
        $parentcontent = ParentContent::find($id);
        if (file_exists($parentcontent->thumbnailimg)) {
            unlink(public_path('/uploads/thumbnailimg') . '/' . $parentcontent->thumbnailimg);
        }
        $parentcontent->delete();
        return back()->with('parentcontent_deleted', '  ParentContent is delete successfully');
    }
    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {

            //getfilename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //getfilename with out extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file_extension
            $extension = $request->file('upload')->getClientOriginalExtension();
            //file name to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            //file upload
            $request->file('upload')->move(public_path('/uploads/thumbnailimg'), $filenametostore);
            echo json_encode(['fileName' => $filenametostore]);
        }
    }
    public function deleteparentcontentimage($id)
    {
        $parentcontent = ParentContent::FindorFail($id);
        $parentcontent->thumbnailimg = "";
        
        $parentcontent->update();
        $notification = array(
			'message' => 'Menu Content Deleted successfully',
			'alert-type' => 'warning'
		);
        return back()->with($notification);
           
    }
}
