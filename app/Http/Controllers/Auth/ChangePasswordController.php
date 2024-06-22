<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    /**
     * Change auth password.
     *
     * @param ChangePasswordRequest $request
     * @return Response
     */
    public function store(ChangePasswordRequest $request): Response
    {
        $data = $request->validated();
        $request->user('sanctum')->update([
            'password' => Hash::make($data['password'])
        ]);

        return response()->noContent(Response::HTTP_OK);
    }
}
