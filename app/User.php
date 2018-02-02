<?php

namespace App;

use App\Deal;
use App\Menu;
use App\Event;
use App\Profile;
use App\OpeningTime;
use App\BusinessInfo;
use App\ImageGallerie;
use App\SocialNetwork;
use App\PushNotification;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'app_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function businessInfo()
    {
        return $this->hasOne(BusinessInfo::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function openingTimes()
    {
        return $this->hasOne(OpeningTime::class);
    }

    public function socialNetworks()
    {
        return $this->hasOne(SocialNetwork::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function galleries()
    {
        return $this->hasMany(ImageGallerie::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function notifications()
    {
        return $this->hasMany(PushNotification::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
