<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use  App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::where('title', 'like', '%' . $request->search . '%')
                ->orderBy('id', 'desc')
                ->paginate(3);

        return view('posts.index', compact('posts'));
    }

    public function sendMail()
    {
        Mail::raw('mail send testing', function($mail) {
            $mail->to('scm.thinthinmoe@gmail.com')
            ->subject('mail send testing');
        });
        
        return "done";
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }


    public function store(PostRequest $request)
    {
        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        // upload multiple image
        foreach($request->file('images') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $dir = public_path('upload/images');
            $file->move($dir, $filename);

            PostImage::create([
                'post_id' => $post->id,
                'path' => '/upload/images/' . $filename,
            ]);
        }

        $post->categories()->attach($request->category_ids);

        return redirect('/posts')->with('success', 'A post was created successfully.');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $oldCategoryIds = $post->categories->pluck('id')->toArray();
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories', 'oldCategoryIds'));
    }

    public function update(PostRequest $request, $id)
    {
        // Get post by id
        $post = Post::findOrFail($id);

        // delete old image
        foreach($post->images as $image) {
            if(Storage::exists($image->path)) {
                unlink(public_path($image->path));
            }
            PostImage::where('post_id', $post->id)->delete();
        }

        // upload a image
        foreach($request->images as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $dir = public_path('upload/images');
            $file->move($dir, $filename);

            PostImage::create([
                'post_id' => $post->id,
                'path' => '/upload/images/' . $filename,
            ]);
        }

        // update post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $post->categories()->sync($request->category_ids);
        return redirect('/posts')->with('success', 'A post was updated successfully.');
    }

    public function show($id)
    {
        $post = Post::select(['posts.*', 'users.name as author'])
        ->join('users', 'users.id', 'posts.user_id')
        ->where('posts.id', $id)
        ->first();

        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('/posts')->with('success', 'A post was deleted successfully.');
    }
}
