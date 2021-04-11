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

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(self::MEDIA_COLLECT)
            ->useDisk('media');
    }

    public function getImageAttribute()
    {
        $media = $this->getFirstMedia(self::MEDIA_COLLECT);
        return $media ? $media->getUrl() : '';
    }

    //移除商品圖片
    public function removeImages()
    {
        $mediaItem = $this->getMedia(Product::MEDIA_COLLECT);
        foreach ($mediaItem as $media) {
            $media->delete();
        };
    }
}
