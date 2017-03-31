<?php namespace Sirce\Models;

use Baum\Node;

class ComponentCategory extends Node
{

    public function components()
    {
        return $this->hasMany('Sirce\Models\Components');
    }

}
