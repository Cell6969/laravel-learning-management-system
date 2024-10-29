<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
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

    public function delete(int $id): RedirectResponse
    {
        $category = Category::query()->findOrFail($id);
        $image = $category->image;
        unlink($image);

        $category->delete();

        $notification = [
            "message" => "Successfully delete category",
            "alert-type" => "success"
        ];

        return redirect()->back()->with($notification);
    }

    public function all_subcategory(): View
    {
        $subcategories = SubCategory::query()->with('category')->latest()->get();
        return view('admin.backend.subcategory.subcategory_all', compact('subcategories'));
    }

    public function add_subcategory(): View
    {
        $categories = Category::query()->latest()->get();
        return view('admin.backend.subcategory.subcategory_add', compact('categories'));
    }

    public function store_subcategory(Request $request): RedirectResponse
    {
        $request->validate([
            "subcategory_name" => ["required", "string", "max:100"],
        ]);

        SubCategory::query()->create([
            "category_id" => $request->input('category_id'),
            "subcategory_name" => $request->input('subcategory_name'),
            "subcategory_slug" => strtolower(str_replace(' ', '-', $request->input('subcategory_name'))),
        ]);

        $notification = [
            "message" => "Success add subcategory",
            "alert-type" => "success"
        ];

        return redirect()->route('subcategory.all')->with($notification);
    }

    public function edit_subcategory(int $id): View
    {
        $subcategory = SubCategory::query()->find($id);
        $categories = Category::query()->latest()->get();
        return view('admin.backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }

    public function update_subcategory(Request $request, int $id): RedirectResponse
    {
        try {
            $request->validate([
                "subcategory_name" => ["required", "string", "max:100"],
            ]);

            SubCategory::query()->find($id)->update([
                "category_id" => $request->input('category_id'),
                "subcategory_name" => $request->input('subcategory_name'),
                "subcategory_slug" => strtolower(str_replace(' ', '-', $request->input('subcategory_name'))),
            ]);

            $notification = [
                "message" => "Success update subcategory",
                "alert-type" => "success"
            ];

            return redirect()->route('subcategory.all')->with($notification);
        } catch (ValidationException $validationException) {
            $notification = [
                "message" => $validationException->errors(),
                "alert-type" => "error"
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function delete_subcategory(int $id): RedirectResponse
    {
        SubCategory::query()->find($id)->delete();

        $notification = [
            "message" => "Successfully delete subcategory",
            "alert-type" => "success"
        ];

        return redirect()->route('subcategory.all')->with($notification);
    }
}
