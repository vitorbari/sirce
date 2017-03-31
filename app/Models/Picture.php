<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	public function imageable()
	{
		return $this->morphTo();
	}

}
