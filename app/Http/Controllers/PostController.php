<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create',compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        foreach ($request->categories as $categoryId) {
            CategoryPost::insert([
                'post_id' => $post->id,
                'category_id' => $categoryId,
            ]);
        }

        session()->flash('success', 'A post was created successfully.');

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->update($request->only(['title', 'body']));

        if(count($request->categories) > 0) {
            CategoryPost::where('post_id', $post->id)->delete();
        }
        foreach ($request->categories as $categoryId) {
            CategoryPost::insert([
                'post_id' => $post->id,
                'category_id' => $categoryId,
            ]);
        }

        $request->session()->flash('success', 'A post was updated successful!');

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('/posts')->with('success', 'A post was deleted successful!');
    }
}
