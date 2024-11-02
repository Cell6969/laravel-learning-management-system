<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseGoal;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    public function InstructorCourse(): View
    {
        $instructor_id = Auth::user()->id;
        $courses = Course::query()
            ->where('instructor_id', $instructor_id)
            ->orderBy('id', 'desc')
            ->get();
        return view('instructor.course.course_all', compact('courses'));
    }

    public function InstructorCourseAdd(): View
    {
        $categories = Category::query()->latest()->get();
        return view('instructor.course.course_add', compact('categories'));
    }

    public function InstructorCourseStore(Request $request): RedirectResponse
    {
        $request->validate([
            "video" => ["required", "mimes:mp4", "max:10000"],
            "course_image" => ["nullable", "mimes:jpg,png"]
        ]);

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid() . '.' . $image->getClientOriginalExtension());
        $url_image = "upload/course/thumbnail/$name_gen";
        Image::make($image)->resize(370, 246)->save($url_image);

        $video = $request->file('video');
        $video_name = time() . "." . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video'), $video_name);
        $url_video = "upload/course/video/$video_name";

        $course_id = Course::query()->insertGetId([
            "category_id" => $request->input("category_id"),
            "subcategory_id" => $request->input("subcategory_id"),
            "instructor_id" => Auth::user()->id,
            "course_title" => $request->input("course_title"),
            "course_name" => $request->input("course_name"),
            "course_name_slug" => strtolower(str_replace(" ", "-", $request->input("course_name"))),
            "description" => $request->input("description"),
            "course_image" => $url_image,
            "video" => $url_video,
            "label" => $request->input("label"),
            "duration" => $request->input("duration"),
            "resources" => $request->input("resources"),
            "certificate" => $request->input("certificate"),
            "selling_price" => $request->input("selling_price"),
            "discount_price" => $request->input("discount_price"),
            "prerequisites" => $request->input("prerequisites"),
            "bestseller" => $request->input("bestseller"),
            "featured" => $request->input("featured"),
            "highestrated" => $request->input("highestrated"),
            "status" => 1,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        $count_goles = Count($request->input('course_goals'));
        if ($count_goles != null) {
            for ($i = 0; $i < $count_goles; $i++) {
                $goal = new CourseGoal();
                $goal->course_id = $course_id;
                $goal->goal_name = $request->input('course_goals')[$i];
                $goal->save();
            }
        }

        $notification = [
            "message" => "Success add Course",
            "alert-type" => "success"
        ];

        return redirect()->route('instructor.course')->with($notification);
    }

    public function GetSubcategory(int $category_id): bool|string
    {
        $subcategories = SubCategory::query()
            ->where('category_id', $category_id)
            ->orderBy('subcategory_name', 'asc')
            ->get();
        return json_encode($subcategories);
    }
}
