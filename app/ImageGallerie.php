<?php

namespace App;

use App\GalleryItem;
use Illuminate\Database\Eloquent\Model;

class ImageGallerie extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'gallery_slug';
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }
}
