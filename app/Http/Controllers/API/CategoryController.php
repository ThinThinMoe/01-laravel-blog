<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::latest('id')->paginate(5);
    }

    public function store(CategoryStoreRequest $request)
    {
        return Category::create($request->only('name'));
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        return $category->update($request->only('name'));
    }

    public function destroy($id)
    {
        return Category::find($id)->delete();
    }
}
