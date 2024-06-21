<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Create an authenticated session.
     *
     * @param LoginRequest $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function store(LoginRequest $request): JsonResponse|Response
    {
        $data = $request->validated();
        $request->authenticate();
        $loginType = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = User::where($loginType, $data['login'])->first();

        if (!is_null($user) && $user->hasRole(['admin', 'manager', 'accountant'])) {
            $token = $user->createToken('admin-management')->plainTextToken;
            return response()->json([
                'token' => $token,
            ]);
        }

        return response()->noContent(Response::HTTP_NOT_FOUND);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request): Response
    {
        $request->user('sanctum')->tokens()->where('name', 'admin-management')->delete();
        return response()->noContent();
    }
}
