<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;
use Sirce\Models\Interfaces\ManufacturableInterface;
use Sirce\Models\Traits\ImageableTrait;
use Sirce\Models\Traits\ManufacturerTrait;

class Board extends Model implements ManufacturableInterface
{

    use ManufacturerTrait, ImageableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manufacturer_id',
        'mcu_id',
        'board_family_id',
        'board',
        'description',
        'website'
    ];

    public function getPictureAttribute($value)
    {
        $picture = $this->pictures->first();

        return $picture ? asset('uploads/'.$picture->path) : asset('img/board.png');
    }

    public function family()
    {
        return $this->belongsTo('Sirce\Models\BoardFamily', 'board_family_id');
    }

    public function mcu()
    {
        return $this->belongsTo('Sirce\Models\Mcu');
    }

	/**
	 * Board __belongs_to_many__ References
	 *
	 * @return mixed
	 */
	public function references()
	{
		return $this->belongsToMany('Sirce\Models\Reference', 'reference_boards');
	}
}
