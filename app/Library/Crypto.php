<?php

namespace App\Library;

use Ahc\Jwt\JWT;

class Crypto
{

    /** JWT 加密  maxMag 秒為單位 */
    public static function JwtEncode($payload = [], $maxAge = 3600 * 30)
    {
        return (new JWT(config("app.jwt_secret"), "HS256", $maxAge))->encode($payload);
    }

    /** JWT 加密  */
    public static function JwtDecode($token = "")
    {
        try {
            return (new JWT(config("app.jwt_secret"), "HS256"))->decode($token);
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        };
    }

    /** sha256 單向加密 */
    public static function hash($hashStr = "", $algo = "sha256")
    {
        return base64_encode(hash($algo, $hashStr, config("app.salt")));
    }

}
