<?php

namespace App\Utils;

use App\Constant;
use App\Log;
use App\Utils\ApiStatus;
use Illuminate\Http\JsonResponse;

class Api
{
    public static function respond(ApiStatus $apiStatus,array $payload = [], int $httpStatus=200){
        return response()->json([
            "status" => $apiStatus->getCode(),
            "message" => $apiStatus->getMessage(),
            "data"=>$payload
        ],$httpStatus);
    }

    public static function respondUnauthorized(string $message="Unauthorized"){
        return self::respond(ApiStatus::err("unauthorized"),["errors"=>["authorization"=>$message]],401);
    }

    public static function respondSuccess($data = [],string $message="ok"){
        return self::respond(ApiStatus::ok($message),$data);
    }

    public static function respondWithValidationErr(array $errors){
        return self::respond(
            ApiStatus::err(__("validation.error")),
            ["errors"=>$errors],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public static function respondWithToken(string $token,$data = []){
        return Api::respond(ApiStatus::ok("Login successfull"),array_merge([
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * Constant::TTLTOKEN,
        ],$data));
    }

     /**
     * Enregistrer un log dans le système
     */
    public static function createLog($action, $data=[], $user_id=null){
        Log::create([
            'user_id' => (is_null($user_id)) ? auth()->user()->id : $user_id,
            'action' => $action,
            'data' => json_encode($data),
            'time_action' => time(),
        ]);
    }
}