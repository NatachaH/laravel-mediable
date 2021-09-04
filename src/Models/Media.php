<?php

namespace App\Models;

use Nh\Mediable\Traits\AsMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{

    use AsMedia,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position', 'name', 'mime', 'extension', 'type'
    ];

}
