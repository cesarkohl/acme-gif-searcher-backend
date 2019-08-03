<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'keyword'];

    protected $hidden = [ 'id', 'user_id', 'updated_at', 'deleted_at' ];
}
