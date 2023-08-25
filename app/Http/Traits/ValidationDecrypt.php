<?php

namespace App\Http\Traits;

use App\Http\Traits\JsonResponse;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * 
 */
trait ValidationDecrypt
{
    use JsonResponse;
    function checkDecrypt($params = [])
    {
        try {
            foreach ($params as $value) {
                decrypt($value);
            }
        } catch (DecryptException $e) {
            return $this->json400('Data not found!');
        }
    }
}
