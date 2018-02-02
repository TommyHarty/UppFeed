<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'profile_slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
