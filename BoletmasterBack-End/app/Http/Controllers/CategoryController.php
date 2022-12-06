<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = new Category;
        $category->nombre = Str::title($request->nombre);
        $category->save();
        return response()->json(['message' => 'Category created successfully.'], 200);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'nombre' => Str::title($request->nombre)
        ]);
        return response()->json(['message' => 'Category updated successfully.'], 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.'], 200);
    }
}
