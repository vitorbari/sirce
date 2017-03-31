<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;
use Sirce\Models\Interfaces\ManufacturableInterface;
use Sirce\Models\Traits\ImageableTrait;
use Sirce\Models\Traits\ManufacturerTrait;

class Mcu extends Model implements ManufacturableInterface
{

    use ManufacturerTrait, ImageableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'manufacturer_id',
        'mcu_family_id',
        'mcu'
    ];

    public function getPictureAttribute($value)
    {
        $picture = $this->pictures->first();

        return $picture ? asset('uploads/'.$picture->path) : asset('img/mcu.png');
    }

    public function family()
    {
        return $this->belongsTo('Sirce\Models\McuFamily', 'mcu_family_id');
    }

    public function boards()
    {
        return $this->hasMany('Sirce\Models\Board');
    }

}
