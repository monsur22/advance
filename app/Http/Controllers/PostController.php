<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();

        //local scope
        // $publishedPosts = Post::published()->get();

        dd($data);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // $post = new Post();
    //     // $post->title = $request['title'];
    //     // $post->desc = $request['desc'];
    //     // $post->save();
    //     $post = Post::create([
    //         'title' => $request['title'],
    //         'desc' =>   $request['desc'],
    //         'slug' => Str::slug($request['title']),
    //         'is_published'=>$request['is_published'],

    //     ]);
    //     // $post = Post::create($request->all());

    //     dd($post);
    //     // $validatedData = $request->validate([
    //     //     'title' => 'required|string',
    //     //     'desc' => 'required|string',
    //     //     'is_published' => 'required|boolean',
    //     // ]);

    //     // $post = Post::create([
    //     //     'title' => $validatedData['title'],
    //     //     'desc' => $validatedData['desc'],
    //     //     'is_published' => $validatedData['is_published'],
    //     // ]);

    //     return response()->json($post);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
            'is_published' => 'required|boolean',
        ]);

        $slug = Str::slug($validatedData['title']);
        // $uniqueSlug = $this->makeSlugUnique($slug);

        $post = Post::create([
            'title' => $validatedData['title'],
            'desc' => $validatedData['desc'],
            'slug' => $slug,
            'is_published' => $validatedData['is_published'],
        ]);

        // dd($post);
        return response()->json($post);
    }

    private function makeSlugUnique($slug)
    {
        $count = 2;
        $originalSlug = $slug;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }


        /**
     * Display the specified resource.
     */

     public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
