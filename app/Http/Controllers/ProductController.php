<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show($prdocutId, Request $request)
    {
        $product = Product::with(['media', 'member', 'category'])->findOrFail($prdocutId);
        return response()->json($product);
    }

    //建立或更新商品資料
    public function store(Product $product, Request $request)
    {

        //檢查是否有新的
        $data = [
            'name' => $request->input('name'),
            'price' => (int) $request->input('price'),
            'description' => $request->input('description'),
            'member_id' => 1,
            'category_id' => 1,
        ];

        try {
            \DB::beginTransaction();
            if ($product->id > 0) {
                $data += ['id' => $product->id];
                //更新圖片 先刪除就圖片
                if ($request->file('file')) {
                    $product->removeImages();
                }
                $product->update($data);

            } else {
                $product = Product::create($data);
            };

            if ($request->file('file')) {
                saveFile($request->file('file'), function ($fullPath) use ($product) {
                    $product->addMedia($fullPath)
                        ->toMediaCollection(Product::MEDIA_COLLECT);
                }
                );
            }
            \DB::commit();
        } catch (Expection $e) {
            \DB::rollback();
            return response()->json([
                'status' => false,
                'message' => '請求失敗',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => '請求成功',
        ]);
    }

    public function destroy(Product $product)
    {
        if (!$product->id) {
            return response()->json([
                'status' => true,
                'message' => '此項目不存在',
            ]);
        }

        $product->removeImages();
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => '刪除成功',
        ]);
    }

}
