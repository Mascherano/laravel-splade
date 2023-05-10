<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
//use ProtoneMedia\Splade\SpladeTable;
use App\Http\Requests\CategoryStoreRequest;
use ProtoneMedia\Splade\Facades\Toast;
use App\Tables\Categories;

class CategoryController extends Controller
{
    public function index()
    {

        return view('categories.index', [
            // 'categories' => SpladeTable::for(Category::class)
            //     ->column('name', sortable: true)
            //     ->withGlobalSearch(columns: ['name'])
            //     ->column('slug', sortable: true)
            //     ->column('action')
            //     ->paginate(5)

            'categories' => Categories::class
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->validated());
        Toast::title('New category created successfully');
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->update($request->validated());
        Toast::title('Category updated successfully');
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Toast::success('Category deleted successfully');
        return redirect()->back();
    }
}
