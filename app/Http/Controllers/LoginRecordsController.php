<?php

namespace App\Http\Controllers;

use App\Services\LoginRecordsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginRecordsController
{
    public function records(): JsonResponse
    {

        try{

            $loginRecords = LoginRecordsService::fetchUserLoginRecords();

            return response()->json([

                'data' => $loginRecords

            ], ResponseAlias::HTTP_OK);

        } catch (\Throwable $e) {

            return response()->json([

                'status' => $e->getCode(),

                'message' => $e->getMessage()

            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
