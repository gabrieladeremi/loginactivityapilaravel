<?php

namespace App\Http\Controllers;

use App\Exceptions\LoginException;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $validatedInput = $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        try {

            $validatedUser = LoginService::loginUser($validatedInput);

            return response()->json([

                'user' => $validatedUser

            ], ResponseAlias::HTTP_OK);

        } catch (LoginException $e) {

            return response()->json([

                'status' => $e->getCode(),

                'message' => $e->getMessage()

            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        } catch (\Throwable $e) {

            return response()->json([

                'status' => $e->getCode(),

                'message' => $e->getMessage()

            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
