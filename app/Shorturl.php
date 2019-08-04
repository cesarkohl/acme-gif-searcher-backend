<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shorturl extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'uri_code', 'uri'];

    protected $hidden = ['id', 'code', 'created_at', 'updated_at', 'deleted_at'];

    public function create($uri)
    {
        $shorturl = Shorturl::where('uri', $uri)->first();

        if (!$shorturl)
        {
            $code = hash('ripemd160', $uri);

            $shorturl = new Shorturl([
                'code' => $code,
                'uri_code' => url('/') .'/r/'. $code,
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

}
