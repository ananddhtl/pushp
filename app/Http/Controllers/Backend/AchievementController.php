<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function AddAchievement()
    {
        return view('admin.achievement.add-team');
    }

    public function AchievementStore(Request $request)
    {
        $request->validate([

        ]);

        $achivement = new Achievement();
        $achivement->header = $request->header;
        $achivement->student_name = $request->student_name;
        $achivement->exam_roll_no = $request->exam_roll_no;
        $achivement->faculty = $request->faculty;
        $achivement->level = $request->level;
        $achivement->year_of_completion = $request->year_of_completion;
        $achivement->CGPA = $request->CGPA;
        $achivement->semester = $request->semester;
        $achivement->year = $request->year;
        $achivement->Achievement = $request->Achievement;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('/uploads/achievement'), $imageName);

            $achivement->image = $imageName;
        }
        $achivement->save();
        $notification = array(
            'message' => 'Achievement Added successfully',
            'alert-type' => 'success');
        return redirect()->route('all.achievement')->with($notification);
    }

    public function Achievement()
    {
        $achievements = Achievement::simplePaginate(10);
        return view('admin.achievement.all-achievement', compact('achievements'));
    }
    public function EditAchievement($id)
    {
        $achievement = Achievement::FindorFail($id);
        return view('admin.achievement.edit-achievement', compact('achievement'));
    }
    public function UpdateAchievement(Request $request ,$id)
    {
        $achivement= Achievement::find($request->id);
        $achivement->header = $request->header;
        $achivement->student_name = $request->student_name;
        $achivement->exam_roll_no = $request->exam_roll_no;
        $achivement->faculty = $request->faculty;
        $achivement->level = $request->level;
        $achivement->year_of_completion = $request->year_of_completion;
        $achivement->CGPA = $request->CGPA;
        $achivement->semester = $request->semester;
        $achivement->year = $request->year;
        $achivement->Achievement = $request->Achievement;

        if ($request->hasfile('image')) {
            $destination = '/uploads/achievement/' . $achivement->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('/uploads/achievement/', $filename);
            $achivement->image = $filename;
        }

        $achivement->update();
        $notification = array(
            'message' => 'Achievement Page Updated successfully',
            'alert-type' => 'info');
        return redirect()->route('all.achievement')->with($notification);
    }

    public function DeleteAchivement($id)
    {
        $achievement = Achievement::find($id);
        $achievement->delete();
        $notification = array(
            'message' => 'Achievement Page Deleted successfully',
            'alert-type' => 'info');
        return redirect()->back()->with($notification);
    }
}
