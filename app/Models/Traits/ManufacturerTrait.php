<?php namespace Sirce\Models\Traits;


trait ManufacturerTrait {

    public function manufacturer()
    {
        return $this->belongsTo('Sirce\Models\Manufacturer');
    }

}