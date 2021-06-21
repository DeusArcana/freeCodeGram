<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $guarded = [];

	public function profileImage()
	{
		$imagePath = ($this->image) ? $this->image : 'logo.jpg';

		return '/storage/' . $imagePath;
	}

	public function followers()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
	