<?php

namespace App\Http\Controllers;

use App\Exceptions\RegistrationFailedException;
use App\Services\RegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegistrationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function register(Request $request): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'firstname' => ['required', 'string', 'max:30'],
            'lastname' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'confirmPassword' => ['required', 'string', 'same:password'],
            'address' => ['string'],
            'phoneNumber' => ['required', 'string', 'max:13']
        ]);

        try {

            $registrationResponse = RegistrationService::registerUser(
                firstname: $validatedData['firstname'],
                lastname: $validatedData['lastname'],
                phoneNumber: $validatedData['phoneNumber'],
                email: $validatedData['email'],
                address: $validatedData['address'],
                password: $validatedData['confirmPassword'],

            );

            return response()->json([
                'user' => $registrationResponse->user,
                'token' => $registrationResponse->token,
            ], ResponseAlias::HTTP_CREATED);

        } catch (RegistrationFailedException $exception) {

            return response()->json([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage()
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => $e->getCode(),
                'message' => $e->getMessage()
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
