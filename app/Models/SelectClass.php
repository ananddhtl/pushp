<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChildContent;
use App\Models\Testimonial;
use Illuminate\Cache\RateLimiting\Limit;

class SelectClass extends Model
{
    use HasFactory;
    public function selectAdventureIdeas()
    {
        $AdventureIdeas = ChildContent::join('child_pages', 'child_contents.childpage_id', '=', 'child_pages.id')->get(['child_contents.*', 'child_pages.child_title']);
        return  $AdventureIdeas;
    }

    public function SelectSimilarjobs($id)
    {
        $chlidepage = ChildContent::join('child_pages', 'child_contents.childpage_id', '=', 'child_pages.id')->get(['child_pages.parentpage_id']);
        $parentpageId = $chlidepage[0]->parentpage_id;
        $childcontents = \DB::table('child_contents')
            ->join('child_pages', 'child_contents.childpage_id', '=', 'child_pages.id')
            ->join('parent_pages', 'child_pages.parentpage_id', '=', 'parent_pages.id')
            ->select('child_contents.*', 'child_pages.child_title', 'parent_pages.id')->where('parent_pages.id', $parentpageId)
            ->get()
            ->random(3);
        return  $childcontents;
    }



    public function selectDownloads($heading)
    {
        $downloads = \DB::table('downloads')
            ->select('*')
            ->where('header',$heading)
            ->orderBy('id','desc')
            ->get();
            return $downloads;
    }
    public function publication($heading)
    {
        $publications = \DB::table('publications')
            ->select('*')
            ->where('header',$heading)
            ->orderBy('id','desc')
            ->get();
            return $publications;
    }
    public function notice($heading)
    {
        $notice = \DB::table('blogs')
            ->select('*')
            ->where('header',$heading)
            ->orderBy('id','desc')
            ->take(9)
            ->get();
            return $notice;
    }

    public function noticeList($heading)
    {
        $notice = \DB::table('blogs')
            ->select('*')
            ->where('header',$heading)
            ->orderBy('id','desc')
            ->get();
            return $notice;
    }
    public function noticeDetails($id)
    {
        $notice = \DB::table('blogs')
            ->select('*')
            ->where('id',$id)
            
            ->get();
            // dd($notice);
            return $notice;
    }

    public function gallery($heading)
    {
        $gallery = \DB::table('galleries')
            ->select('*')
            ->where('category',$heading)
            ->orderBy('id','desc')
            ->get();
            return $gallery;
    }

    public function achievements($heading)
    {
        $achievements = \DB::table('achievements')
            ->select('*')
            ->where('header',$heading)
            ->orderBy('id','desc')
            ->get();
            return $achievements;
    }

    public function selectSubHeading($heading)
    {
        $childcontents = \DB::table('child_contents')
            ->join('child_pages', 'child_contents.childpage_id', '=', 'child_pages.id')
            ->join('parent_pages', 'child_pages.parentpage_id', '=', 'parent_pages.id')
            ->select('child_contents.*', 'child_pages.child_title', 'child_contents.id', 'parent_pages.title')->where('parent_pages.title', $heading)
            ->get();

        return $childcontents;
    }
    public function selectBlog()
    {
        $selectBlog = Blog::where('header','blog')->Limit(3)->latest()->get();

        //dd($selectBlog);
        return  $selectBlog;
    }
    public function selectParentpage($pageheading)
    {
        $parentcontent = \DB::table('parent_contents')
            ->join('parent_pages', 'parent_contents.parentpage_id', '=', 'parent_pages.id')
            ->select('parent_contents.*', 'parent_pages.title', 'parent_contents.id', 'parent_pages.title')->where('parent_pages.title', $pageheading)
            ->get();
        return $parentcontent;
    }


    public function SimilarList($id)
    {
        // $selectsimilartrips = ChildContent::all()->random(3);
        $selectsimilartrips = \DB::table('child_contents')
            ->join('child_pages', 'child_pages.id', '=', 'child_contents.childpage_id')
            ->select('child_contents.*', 'child_title')
            ->where('child_contents.parentpage_id', $id)
            ->get();

        return $selectsimilartrips;
    }


    public function SelectSimilarTrips()
    {
        // $selectsimilartrips = ChildContent::all()->random(3);
        $selectsimilartrips = \DB::table('child_contents')
            ->join('child_pages', 'child_pages.id', '=', 'child_contents.childpage_id')
            ->select('child_contents.*', 'child_title')
            ->get()
            ->random(3);

        return $selectsimilartrips;
    }
    public function SelectReview()
    {
        $reviews = Testimonial::all();
        return  $reviews;
    }
}
