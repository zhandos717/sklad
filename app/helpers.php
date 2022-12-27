<?php

use Firebase\JWT\JWT;

if (function_exists('buildJWT')) {
    /**
     * @throws Exception
     */
    function buildJWT(): string
    {
        $token = [
            "sub" => config('moysklad.app_uid')->appUid,
            "iat" => time(),
            "exp" => time() + 300,
            "jti" => bin2hex(random_bytes(32))
        ];
        return JWT::encode($token, config('moysklad.secretKey'), 'HS256');
    }
}
