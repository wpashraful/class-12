<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show($slug){
        $courses = Course::where('slug', $slug)->with(['platform', 'topics', 'authors', 'series', 'reviews'])->first();

//        return response()->json($courses);

        return  view('course.single', [
            'couresSingle' => $courses
        ]);
    }
    public function courses(Request $request){
//        $courses = Course::paginate(12);
        $search = $request->search;
        $level = $request->level;
        $courses = Course::where('name' , 'like', '%' . $search . '%')
        ->when($level, function($query) use ($level) {
            $query->where('level', $level);
        })->paginate(12);
        return view('courses',[
            'courses' => $courses
        ]);
    }
//    public function courses(Request $request){
//
//        $search = $request->search;
//        $level = $request->level;
//        $courses = Course::where(function($query) use ($search) {
//            if(!empty($search)) {
//                $query->where('name', 'like', '%' . $search . '%');
//            }
//        })->when($level, function ($query) use ($level) {
//            if($level == 'beginner') {
//                $field = 0;
//            } elseif($level == 'intermediate') {
//                $field = 1;
//            } else {
//                $field = 2;
//            }
//
//            $query->where('difficulty_level', $field);
//        })->paginate(12);
//
//        return view('courses', [
//            'courses' => $courses
//        ]);
//    }


}
