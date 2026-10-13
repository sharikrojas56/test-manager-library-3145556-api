<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(
        private LoginService $loginService,
    ) {}

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 'VALIDATION_ERROR',
                'message' => 'Validation failed',
                'details' => $validator->errors()->toArray(),
            ], 422);
        }

        try {
            $result = $this->loginService->execute(
                $request->input('username'),
                $request->input('password')
            );

            return response()->json($result, 200);
        } catch (\DomainException $e) {
            return response()->json([
                'code' => 'INVALID_CREDENTIALS',
                'message' => 'Invalid credentials',
                'details' => [],
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 'INTERNAL_ERROR',
                'message' => 'An error occurred',
                'details' => [],
            ], 500);
        }
    }

    public function health(): JsonResponse
    {
        return response()->json(['status' => 'ok'], 200);
    }
}