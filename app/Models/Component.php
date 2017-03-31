<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;
use Sirce\Models\Interfaces\ManufacturableInterface;
use Sirce\Models\Traits\ImageableTrait;
use Sirce\Models\Traits\ManufacturerTrait;

class Component extends Model implements ManufacturableInterface
{

    use ManufacturerTrait, ImageableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'component_category_id',
        'manufacturer_id',
        'component'
    ];
    public function getPictureAttribute($value)
    {
        $picture = $this->pictures->first();

        return $picture ? asset('uploads/'.$picture->path) : asset('img/mcu.png');
    }

    public function category()
    {
        return $this->belongsTo('Sirce\Models\ComponentCategory', 'component_category_id');
    }

    /**
     * Component __belongs_to_many__ References
     *
     * @return mixed
     */
    public function references()
    {
        return $this->hasMany('Sirce\Models\Reference', 'component_id');
    }
}
