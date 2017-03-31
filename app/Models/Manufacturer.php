<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;
use Sirce\Models\Traits\ImageableTrait;

class Manufacturer extends Model {

	use ImageableTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'manufacturer',
		'description',
		'website'
	];

	public function boards()
	{
		return $this->hasMany('Sirce\Models\Board');
	}

	public function components()
	{
		return $this->hasMany('Sirce\Models\Component');
	}

	public function mcus()
	{
		return $this->hasMany('Sirce\Models\Mcu');
	}

}
