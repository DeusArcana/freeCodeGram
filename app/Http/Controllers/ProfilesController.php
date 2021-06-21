<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreProfileRequest;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
	/**
     * Show the current profile of the auth user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
	{
		$follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

		$postsCount = Cache::remember(
			'count.posts.' . $user->id,
			now()->addSeconds(30), 
			function () use($user) {
				return $user->posts->count();
			});;

		$followersCount = Cache::remember(
			'count.followers.' .$user->id, 
			now()->addSeconds(30), 
			function () use($user) {
				return $user->profile->followers->count();
			});;

		$followingCount = Cache::remember(
			'count.following.' . $user->id, 
			now()->addSeconds(30), 
			function () use($user) {
				return $user->following->count();
			});;

		return view('profiles.show', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		$this->authorize('update', $user->profile);

		return view('profiles.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param App\Http\Requests\StoreProfileRequest $request
	 * @param  User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(StoreProfileRequest $request, User $user)
	{
		$this->authorize('update', $user->profile);

		if (request('image')) {
			// Saving the image on the uploads folder
			$imagePath = request('image')->store('profile', 'public');
			
			// Adjusting the image by cutting it
			Image::make(public_path("storage/{$imagePath}"))
					->fit(150, 150)
					->save();

			$imageArray = ['image' => $imagePath];
		}

		auth()->user()->profile->update(array_merge(
				$request->all(), 
				$imageArray ?? []
			));

		return redirect()->route('profile.show', compact('user'));
	}
}
