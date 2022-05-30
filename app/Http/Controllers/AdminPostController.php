<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index() {

        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['image'] = request()->file('image')->store('images');

        // dd(request()->all());

        Post::create($attributes);

        return redirect('/');

        
    }

    public function edit(Post $post) {

        return view('admin.posts.edit', [
                    'post' => $post,
                    'categories' => Category::all()
                ]);
    }

    public function update(Post $post) {

        $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['image'] = request()->file('image')->store('images');
        // dd($attributes);
       
        $post->update($attributes);

        return back();

    }

    public function destroy(Post $post){

        $post->delete();

        return back();
    }
}
