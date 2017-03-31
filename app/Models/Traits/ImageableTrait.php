<?php namespace Sirce\Models\Traits;


trait ImageableTrait
{

	public function getPictureAttribute($value)
	{
		$picture = $this->pictures->first();

		return $picture ? asset('uploads/'.$picture->path) : NULL;
	}

	public function pictures()
	{
		return $this->morphMany('Sirce\Models\Picture', 'imageable');
	}

}