<?php

namespace App\Http\Controllers;

use App\Post;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function index()
	{
		$users = auth()->user()->following()->pluck('profiles.user_id');

		$posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(2);

		return view('posts.index', compact('users', 'posts'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\StorePostRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StorePostRequest $request)
	{
		// Saving the image on the uploads folder
		$imagePath = request('image')->store('uploads', 'public');

		// Adjusting the image by cutting it
		Image::make(public_path("storage/{$imagePath}"))
					->fit(1200, 1200)
					->save();
		
		// Saving post data
		auth()->user()->posts()->create([
			'caption' => $request->input('caption'),
			'image' => $imagePath,
		]);

		return redirect()->route('profile.show', auth()->user()->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Post $post)
	{
		return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\StorePostRequest  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StorePostRequest $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
