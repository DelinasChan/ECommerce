<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Spatie\MediaLibrary\Media;

class MediaController extends Controller
{

    public function index(Request $request)
    {
        $mediaList = $request->member->getMedia('media')
            ->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ];
            })->toArray();
        return $mediaList;
    }

    public function create(Request $request)
    {
        $images = $request->file('images');
        $item = [];
        foreach ($images as $image) {
            $newImage = $request->member->addMedia($image)
                ->toMediaCollection('media');
            $item[] = [
                'id' => $newImage->id,
                'url' => $newImage->getUrl(),
            ];
        }

        return [
            'status' => true,
            'message' => 'SUCCESS',
            'images' => $item,
            'image' => $item[0],
        ];
    }

    public function destroy(Request $request)
    {
        dd(Media);
    }

}
