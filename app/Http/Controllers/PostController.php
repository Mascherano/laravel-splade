<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use App\Http\Requests\PostStoreRequest;
use ProtoneMedia\Splade\Facades\Toast;
use App\Tables\Posts;

class PostController extends Controller
{
    public function index()
    {

        return view('posts.index', [
            // 'posts' => SpladeTable::for($posts)
            //     ->column('title', sortable: true)
            //     ->withGlobalSearch(columns: ['title'])
            //     ->column('slug', sortable: true)
            //     ->column('action')
            //     ->selectFilter('category_id', $categories)
            //     ->paginate(5)

            'posts' => Posts::class
        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.create', compact('categories'));
    }

    public function store(PostStoreRequest $request)
    {
        Post::create($request->validated());
        Toast::title('New post created successfully');
        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostStoreRequest $request, Post $post)
    {

        $post->update($request->validated());
        Toast::title('Post updated successfully');

        return to_route('posts.index');

    }

    public function destroy(Post $post)
    {
        $post->delete();
        Toast::success('Post deleted successfully');
        return redirect()->back();
    }
}
