<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\PathGenerator;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    const MEDIA_COLLECT = 'PRODUCT';

    public $timestamps = false;
    protected $fillable = ['id', 'name', 'price', 'description', 'is_enable', 'member_id', 'category_id'];

    protected $hidden = [
        'media',
    ];

    protected $appends = [
        'image',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(self::MEDIA_COLLECT)
            ->useDisk('media');
    }

    public function getPath(): string
    {
        dd($this->media->disk);
        return $this->media->disk === 'public' ? $this->getStoragePath() . '/' . $this->getPathRelativeToRoot() : $this->getPathRelativeToRoot();
    }

    public function getImageAttribute()
    {
        return $this->getFirstMedia(self::MEDIA_COLLECT)->getUrl();
    }
}
