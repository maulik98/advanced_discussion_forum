<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Watcher extends Model
{
    protected $fillable = ['discussion_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }
}
