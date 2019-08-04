<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'shorturl_id'];

    protected $hidden = ['user_id', 'shorturl_id', 'updated_at', 'deleted_at'];

    public function shorturl()
    {
        return $this->belongsTo('App\Shorturl');
    }

    public function create($data)
    {
        $favorite = Favorite::where($data)->first();

        if (!$favorite) {
            $favorite = new Favorite($data);
            $favorite->save();
        }

        $favorite = Favorite::with('shorturl')
            ->where('id', $favorite->id)
            ->first();

        return $favorite;
    }
}
