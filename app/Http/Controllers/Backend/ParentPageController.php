<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChildPage;
use Illuminate\Http\Request;
use App\Models\ParentPage;

class ParentPageController extends Controller
{
    public function  addParentPage()
    {
       return view('backend.parentpage.add-parentpage');
    }
    public function  ParentPageStore(Request $request)
    {   
        $request->validate(['title' => 'required']);
        $parentpage = new ParentPage();
        $parentpage->title =$request->title;
        $parentpage->ischild =$request->ischild;
        $parentpage->save();

        $notification = array(
			'message' => 'Menu Page added successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);      
    }
    public function Parentpages()
    {   
        $parentpageedit=ChildPage::all();
        $parentpages=ParentPage::simplePaginate(10);
        
        return view('backend.parentpage.all-parentpage',compact('parentpages','parentpageedit'));
    }
    public function editparentpage(Request $request)
    { 
        $id=$request->id;
        $parentpage = ParentPage::FindorFail($id);
        

        return json_encode($parentpage);
        // return view('dashboard.parentpage.edit-parentpage', compact('parentpage'));
    }
    public function updateParentpage(Request $request)
    {      
        $parentpage=ParentPage::find($request->id);
        $parentpage->title = $request->title;
        $parentpage->ischild = $request->ischild;
        $parentpage->update();
        $notification = array(
			'message' => 'Menu Page Updated successfully',
			'alert-type' => 'info'
		);
        return back()->with($notification);
    }
    public function deleteParentpage($id)
    {
       
        $parentpage = ParentPage::find($id);
        $parentpage->delete();
        $notification = array(
			'message' => 'Menu Page Deleted successfully',
			'alert-type' => 'warning'
		);
         return back()->with($notification);

    }
}
