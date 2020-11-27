<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {          

        DB::table('product')->insert([
            'name'      => "i5-1037 輕薄筆電" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "UX431FA ZenBook" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1359 , "originalPrice" => 1400 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://c.ecimg.tw/items/DHAX951900AWU5A/000002_1602059199.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "G14 日蝕灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1459 , "originalPrice" => 1500 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://d.ecimg.tw/items/DHAS4NA900ASA9N/000002_1596609201.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "FX506 幻影灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1559 , "originalPrice" => 1600 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://e.ecimg.tw/items/DHAS1UA900AWITA/000002_1603098141.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "S432F 超能綠" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1659 , "originalPrice" => 1700 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAFJAA900AIWC4/000002_1604311645.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))          
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037 極地白" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://d.ecimg.tw/items/DHAG4T1900AWLEL/000002_1601536349.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1800 , "originalPrice" => 1859 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))          
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037 星空灰色" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1200 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://c.ecimg.tw/items/DHAFL9A900AXR7R/000002_1604992597.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))         
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "Gaming 黑騎士" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://e.ecimg.tw/items/DHAG8N1900AU1B1/000002_1598251949.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "Slim 公爵黑" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 5999 , "originalPrice" => 6500 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "G512LV 黑" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 5800 , "originalPrice" => 600 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://e.ecimg.tw/items/DHAG4Q1900ASVJU/000002_1603447064.jpg" 
            ])) 
        ]);

        DB::table('product')->insert([
            'name'      => "G512LV 日蝕灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 7200 , "originalPrice" => 7500 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://f.ecimg.tw/items/DHAS4MA900AZ5SN/000002_1605077879.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
            ]))
 ]);

        DB::table('product')->insert([
            'name'      => "Slim 博墾地紅" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 6666 , "originalPrice" => 6700 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "FA703IU 幻影灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 15000 , "originalPrice" => 19000 ,
            "attachments"   => json_encode(array([
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([
                 "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                 ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "Slim 博墾地紅" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 6666 , "originalPrice" => 6700 ,
            "attachments"   => json_encode(array([ "alt" => "" , 
            "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]))
        ]);

        DB::table('product')->insert([
            'name'      => "FA703IU 幻影灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 15000 , "originalPrice" => 19000 ,
            "attachments"   => json_encode(array([ "alt" => "" , 
            "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode( array([ 
                "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array(
                [ "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]))
        ]);

        DB::table('product')->insert([
            'name'      => "Slim 博墾地紅" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 6666 , "originalPrice" => 6700 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "FA703IU 幻影灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 15000 , "originalPrice" => 19000 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" 
                ]))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(
                array([ 
                    "alt" => "" , 
                    "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
                ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(
                array([ 
                    "alt" => "" , 
                    "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
                ))
        ]);

        DB::table('product')->insert([
            'name'      => "Slim 博墾地紅" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 6666 , "originalPrice" => 6700 ,
            "attachments"   => json_encode(
                array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "FA703IU 幻影灰" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 15000 , "originalPrice" => 19000 ,
            "attachments"   => json_encode(
                array([ 
                "alt" => "" , 
                "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 1259 , "originalPrice" => 1300 ,
            "attachments"   => json_encode(
                array([ 
                    "alt" => "" , "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
            ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 13000 , "originalPrice" => 13599 ,
            "attachments"   => json_encode(
                array([ 
                    "alt" => "" , 
                    "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
                ))
        ]);

        DB::table('product')->insert([
            'name'      => "i5-1037" , 'introduce' => "<p>產品介紹</p>",
            'memberId'  => 0 , "discountPrice" => 13000 , "originalPrice" => 13599 ,
            "attachments"   => json_encode(
                array([ 
                    "alt" => "" , 
                    "src" => "https://b.ecimg.tw/items/DHAG4N1900AYO9A/000002_1604074332.jpg" ]
                ))
        ]);

    }
}
