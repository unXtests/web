<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Teacher extends Model implements SluggableInterface
{
    use SluggableTrait;

    public $timestamps = false;
    protected $fillable = [ 'name' ];
    protected $sluggable = [ 'build_from' => 'name', 'save_to'    => 'slug' ];
}
