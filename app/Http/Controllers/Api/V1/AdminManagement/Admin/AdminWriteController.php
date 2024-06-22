<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdminManagement\Admin\AdminStoreUpdateRequest;
use App\Mail\AdminManagement\Admin\AdminCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminWriteController extends Controller
{
    /**
     * Add a new admin.
     *
     * @param AdminStoreUpdateRequest $request
     * @return JsonResponse
     */
    public function store(AdminStoreUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $password = Str::random(16);
        $data['password'] = Hash::make($password);
        $user = User::create($data);
        $account = $user->adminAccount()->create($data);

        $user->assignRole($data['role']);

        Mail::to($user->email)->send(new AdminCreatedMail([
            'name' => $account->name,
            'username' => $user->email,
            'password' => $password
        ]));

        cache()->forget('admins');

        return response()->json(['id' => $user->id]);
    }

    /**
     * Update admin's info.
     *
     * @param User $user
     * @param AdminStoreUpdateRequest $request
     * @return Response
     */
    public function update(User $user, AdminStoreUpdateRequest $request): Response
    {
        $data = $request->validated();
        $user->update($data);
        $user->adminAccount()->update($data);
        $user->syncRoles([$data['role']]);

        cache()->forget('admins');

        return response()->noContent(Response::HTTP_OK);
    }

    /**
     * Delete the admin.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user): Response
    {
        $user->adminAccount()->delete();
        $user->delete();
        cache()->forget('admins');
        return response()->noContent(Response::HTTP_OK);
    }
}
