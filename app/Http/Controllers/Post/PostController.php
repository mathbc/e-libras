<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    public function getPosts()
    {
        $posts = Post::latest()->with(['user', 'groups', 'likes', 'dislikes'])->get();
        $authUser = auth()->user();
        return response()->json(['posts' => $posts, 'authUser' => $authUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'user_id'       =>  auth()->user()->id,
            'title'         =>  $request['title'],
            'iframe_video'  =>  str_replace('width="560" height="315"', 'width="95%" height="500"', $request['iframe_video']),
            'content'       =>  $request['content']
        ]);
        $post->groups()->sync($request['groups']);
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id)->update($request->all());
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return response()->json(['done']);
    }

    public function likePost($id)
    {
        $auth_user = auth()->user()->id;

        $dislike = Dislike::where('post_id', $id);
        $dislike->delete();

        // Caso não tenha curtida e clique no botão, ele curte o post
        $likePost = Like::create([
            'user_id'   =>  auth()->user()->id,
            'post_id'   =>  $id
        ]);
        return response()->json(['message' => 'Post Liked']);
    }

    public function dislikePost($id)
    {
        $like = Like::where('post_id', $id);
        $like->delete();

        $dislike = Dislike::create([
            'user_id'   =>  auth()->user()->id,
            'post_id'   =>  $id
        ]);

        return response()->json($dislike);
    }
}
