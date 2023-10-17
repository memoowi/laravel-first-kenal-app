<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::orderBy('id','desc')->paginate(5);
        return view('posts.index',['post' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=[
            'title' => 'required|unique:posts',
            'content' => 'required',
        ];
        $msg= [
            'title.required' => 'Title field cant be empty',
            'content.required' => 'Content field cant be empty',
        ];
        $request->validate($data, $msg);
        dd($request->all());
    }
    public function store2(PostRequest $request)
    {
        // $post = new Post();
        // $post->title = $request->title;
        // $post->content = $request->content;
        
        // $post->save();

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->file('image')->store('images-post'),
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('ok','Data Added Successfully');
        // dd($request->all());
        // return $request->file('image')->store('images-post');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('posts.show',[
            // 'post' => Post::find($id),
            'post' => Post::where('slug',$slug)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view('posts.edit',[
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title);

        if($request->file('image')){
            if(!empty($post->image)){
                Storage::delete($post->image);
            }
            $post->image = $request->file('image')->store('images-post');
        }
        $post->save();
        return redirect()->route('posts.index')->with('ok','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Methods to delete
        // Post::findOrFail($id)->delete();
        // Post::find($id)->delete();
        // Post::where('id',$id)->first()->delete();
        
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        if(!empty($post->image)){
            Storage::delete($post->image);
        }
        $post->delete();

        return redirect()->back()->with('ok','Data Deleted Successfully');

    }
}
