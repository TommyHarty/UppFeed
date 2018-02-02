<?php

namespace App;

use App\MenuItem;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'menu_slug';
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
