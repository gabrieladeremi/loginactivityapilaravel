<?php

namespace App\Http\Controllers;

use App\Services\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LogoutController
{
    public function logout(): JsonResponse
    {
        try {

            $loggedOutUser = LogoutService::userLogout();

            return response()->json([

                'data' => $loggedOutUser,
                'message' => 'User Logged Out'

            ], ResponseAlias::HTTP_OK);

        } catch (\Throwable $e) {

            return response()->json([

                'status' => $e->getCode(),

                'error' => $e->getMessage()
            ]);
        }
    }
}
