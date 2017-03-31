<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;

class McuFamily extends Model
{

    public function mcus()
    {
        return $this->hasMany('Sirce\Models\Mcu');
    }

}
