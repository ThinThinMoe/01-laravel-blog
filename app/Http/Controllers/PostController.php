<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('posts/create')->withErrors($validator)->withInput();
        }
        // $request->validate([
        //     'title' => 'required',
        //     'body' => 'required|min:5',
        // ], [
        //     'title.required' => "changed title required message",
        //     'body.required'  => "changed body required message",
        //     'body.min'       => "changed body text limitation message",
        // ]);

        $post = new Post();
        $post->title = $request->title;
        $post->body =  $request->body;
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();

        return redirect('/posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'body' => 'required|min:5',
        // ], [
        //     'title.required' => "changed title required message",
        //     'body.required'  => "changed body required message",
        //     'body.min'       => "changed body text limitation message",
        // ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->updated_at = now();
        $post->save();

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

        return redirect('/posts');
    }
}
