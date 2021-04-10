<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function show($productId, Request $request)
    {
        $product = Product::with('media')->find($productId);
        return response()->json($product);
    }

    public function create(Request $request)
    {

        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => false,
                'message' => '參數錯誤',
            ]);
        }

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => (int) $request->input('price'),
            'description' => $request->input('description'),
            'member_id' => 1,
            'category_id' => 1,
        ]);

        $fullPath = saveFile($request->file('file'), function ($fullPath) use ($product) {
            $product->addMedia($fullPath)
                ->toMediaCollection(Product::MEDIA_COLLECT);
        }
        );

        return response()->json($fullPath);
    }
}
