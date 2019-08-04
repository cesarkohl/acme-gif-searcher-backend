<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shorturl extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'uri'];

    protected $hidden = [ 'id', 'created_at', 'updated_at', 'deleted_at' ];

    public function create($uri)
    {
        $shorturl = Shorturl::where('uri', $uri)->first();

        if (!$shorturl) {
            $shorturl = new Shorturl([
                'code' => hash('ripemd160', $uri),
                'uri' => $uri
            ]);
            $shorturl->save();
        }

        return $shorturl;
    }

    public function get($code)
    {
        return Shorturl::where('code', $code)->first();
    }

    public function getFullUriAttribute()
    {
        return url('/') .'/r/'. $this->code;
    }
}
