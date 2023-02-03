<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildPage;
use App\Models\ParentPage;

class ChildPageController extends Controller
{
    public function  addChildPage()
    {

        $parentpages = ParentPage::where('ischild', 1)->get();
        return view('admin.childpage.all-childpage', compact('parentpages'));
    }

    public function  ChildPageStore(Request $request)
    {
        $childpage = new ChildPage();
        $childpage->child_title = $request->child_title;
        $childpage->parentpage_id = $request->parentpage_id;
        $childpage->save();
        $notification = array(
			'message' => 'SubMenu Added Successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);
    }
    public function Childpages()
    {
        $childpages = ChildPage::with('parentpage')->simplePaginate(10);
        $parentpages = ParentPage::where('ischild', 1)->get();
        return view('admin.childpage.all-childpage', compact('childpages', 'parentpages'));
    }
    public function editchildpage(Request $request)
    {
        $childpage = ChildPage::FindorFail($request->id);

        // $parentpages = ParentPage::where([
        //     ['ischild', 1], ['title', '!=', '$childpage->parentpage->title'],
        // ])->get();


        return json_encode($childpage);

        // return view('admin.childpage.edit-childpage', compact('childpage', 'parentpages'));
    }
    public function updatechildpage(Request $request)
    {
        //dd($request->all());

        $childpage = ChildPage::find($request->id);
        $childpage->child_title = $request->child_title;
        $childpage->parentpage_id = $request->parentpage_id;
        $childpage->update();

        $notification = array(
			'message' => 'SubMenu Updated Successfully',
			'alert-type' => 'success'
		);
        return back()->with($notification);
    }
    public function deletechildpage($id)
    {
        $childpage = ChildPage::find($id);

        $childpage->delete();
        $notification = array(
			'message' => 'SubMenu Deleted Successfully',
			'alert-type' => 'success'
		);
        return back()->with($notification);
    }
}
