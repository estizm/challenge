<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'categories';
    /**
     * @var array
     */
    protected $fillable = ['name','parent_id'];
}
