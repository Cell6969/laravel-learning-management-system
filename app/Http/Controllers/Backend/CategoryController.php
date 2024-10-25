<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function all(): View
    {
        $categories = Category::query()->latest()->get();
        return view('admin.backend.category.category_all', compact('categories'));
    }

    public function add(): View
    {
        return view('admin.backend.category.category_add');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                "category_name" => ["required", "string", "max:100"],
                "image" => ["required", "image", "mimes:jpg,png,jpeg"]
            ]);

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $url = 'upload/category/' . $name_gen;
            Image::make($image)->resize(370, 246)->save($url);

            Category::query()->insert([
                "category_name" => $request->input('category_name'),
                "category_slug" => strtolower(str_replace(' ', '-', $request->input('category_name'))),
                "image" => $url,
            ]);

            $notification = [
                "message" => "Success add category",
                "alert-type" => "success"
            ];

            return redirect()->route('category.all')->with($notification);
        } catch (ValidationException $validationException) {
            $notification = [
                "message" => $validationException->errors(),
                "alert-type" => "error"
            ];
            return redirect()->back()->with($notification);
        }

    }

    public function edit(int $id): View
    {
        $category = Category::query()->find($id);
        return view('admin.backend.category.category_edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $request->validate([
                "category_name" => ["required", "string", "max:100"],
                "image" => ["nullable", "image", "mimes:jpg,png,jpeg"]
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $url = 'upload/category/' . $name_gen;
                Image::make($image)->resize(370, 246)->save($url);

                Category::query()->find($id)->update([
                    "category_name" => $request->input('category_name'),
                    "category_slug" => strtolower(str_replace(' ', '-', $request->input('category_name'))),
                    "image" => $url,
                ]);

            } else {
                Category::query()->find($id)->update([
                    "category_name" => $request->input('category_name'),
                    "category_slug" => strtolower(str_replace(' ', '-', $request->input('category_name')))
                ]);
            }
            $notification = [
                "message" => "Success update category",
                "alert-type" => "success"
            ];

            return redirect()->route('category.all')->with($notification);

        } catch (ValidationException $validationException) {
            $notification = [
                "message" => $validationException->errors(),
                "alert-type" => "error"
            ];
            return redirect()->back()->with($notification);
        }
    }
}
