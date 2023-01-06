<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dynamicimage(){
        $seriesImage = Series::take(5)->get();
        $courseimage    = Course::take(6)->get();
        return view('welcome', [
            'seriesname' => $seriesImage,
            'courses'   => $courseimage
        ]);

    }
    public function dashboard(){
        if(Auth::user()->type === 1){
            return view('dashboard');

        }else {
                return redirect()->route('home');
        }
    }
    public function archive($archive_type, $slug){

        $allowed_archived_types = ['series','level', 'duration', 'platform', 'archive'];
            if( !in_array($archive_type, $allowed_archived_types)){

               return abort( 404);
            }

            if($archive_type === 'duration'){
                $allowed_duration = ['1-5-hours','5-10-hours', '10-plus-hours'];
                if(!in_array($slug, $allowed_duration)){

                   return abort(404);
                }
            }
        if($archive_type === 'level'){
            $allowed_level = ['beginner','intermediate', 'advanced'];
            if( !in_array($slug, $allowed_level)){

               return abort(404);
            }
        }
        if($archive_type === 'level'){
            $allowed_level = ['beginner','intermediate', 'advanced'];
            if( !in_array($slug, $allowed_level)){

                return abort(404);
            }
        }

        if($archive_type === 'series'){
            $item = Series::where('slug', $slug)->first();
            if(empty($item)){
                    dd('series not found');
             return abort(404);
            }
            $title = 'course on ' . $item->name;
            $courses = $item->course()->paginate(9);

        }elseif ($archive_type === 'duration'){
            if($slug == '1-5-hours'){
                $item = '1-5 hours';
                $duration_db_key = 0;

            }elseif($slug == '5-10-hours'){
                $item = '5-10 hours';
                $duration_db_key = 1;
            }else{
                $item = '10+ hours';
                $duration_db_key = 2;
            }

            $title = 'course on ' . $item;
            $courses = Course::where('duration', $duration_db_key)->paginate(12);
        }elseif($archive_type === 'level'){
            if($slug == 'beginner'){
                $dblevl_key = 0;
            }elseif($slug == 'intermediate'){
                $dblevl_key = 1;

            }else{
                $dblevl_key = 2;
            }
            $mm = 0;
            $title = 'course on '. $slug;
            $courses = Course::where('level', $dblevl_key)->paginate(9);
            }

        return view('archive.single',[
            'title' => $title,
            'courses'   => $courses,
        ]);
    }



}
