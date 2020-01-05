<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = ['avatar','photo'];

    public function user()
    {
        $this->belongsTo(User::class);
    }


}
