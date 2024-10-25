<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
}
