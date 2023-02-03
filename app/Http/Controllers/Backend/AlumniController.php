<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class AlumniController extends Controller
{
    public function Addteam()
    {
        return view('admin.team.add-team');
    }

    public function TeamStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',


        ]);
        $team = new Team();
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->gmail = $request->gmail;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('/uploads/teamimg'), $imageName);

            $team->image = $imageName;
        }
        $team->save();
        $notification = array(
            'message' => 'TeamMember Added successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.team')->with($notification);
    }

    public function teams()
    {
        $teams = Team::simplePaginate(5);

        return view('admin.team.all-team', compact('teams'));
    }
    public function EditTeam($id)
    {
        $team = Team::FindorFail($id);
        return view('admin.team.edit-teammember', compact('team'));
    }
    public function UpdateTeam(Request $request, $id)
    {
        $team = Team::find($request->id);
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->gmail = $request->gmail;

        if ($request->hasfile('image')) {
            $destination = 'uploads/teamimg/' . $team->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/teamimg/', $filename);
            $team->image = $filename;
        }

        $team->update();
        $notification = array(
            'message' => 'TeamMember  Updated successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.team')->with($notification);
    }

    public function DeleleTeam($id)
    {
        $team = Team::find($id);
        $team->delete();
        $notification = array(
            'message' => 'TeamMember Deleted successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
