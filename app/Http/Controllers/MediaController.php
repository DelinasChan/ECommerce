<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
        $payload = $request->only('ids', 'id');
        if (isset($payload['id'])) {
            $request->member->Media()->where('id', $payload['id'])->delete();
        } else {
            $request->member->Media()->whereIn('id', $payload['ids'])->delete();
        }
        return [
            'status' => true,
            'message' => '更新成功',
        ];
    }

}
