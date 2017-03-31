<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;

class BoardFamily extends Model
{

    public function boards()
    {
        return $this->hasMany('Sirce\Models\Board');
    }

}
