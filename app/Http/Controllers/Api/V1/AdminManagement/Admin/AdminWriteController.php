<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdminManagement\Admin\AdminStoreUpdateRequest;
use App\Mail\AdminManagement\Admin\AdminCreatedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

        return response('', Response::HTTP_CREATED)->json(['id' => $user->id]);
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

        return response()->noContent(Response::HTTP_OK);
    }

    /**
     * Update admin's role.
     *
     * @param User $user
     * @param Request $request
     * @return Response
     */
    public function updateRole(User $user, Request $request): Response
    {
        if ($request->user('sanctum')->hasRole('admin') || ($request->user('sanctum')->hasRole('admin') || $request->user->id == $request->user('sanctum')->id)) {
            $data = $request->validate([
                'role' => ['required', Rule::exists('roles', 'name'), Rule::in(['admin', 'manager', 'accountant'])]
            ]);
            $user->syncRoles([$data['role']]);
            return response()->noContent(Response::HTTP_OK);
        }
        return response()->noContent(Response::HTTP_NOT_FOUND);
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
        return response()->noContent(Response::HTTP_OK);
    }
}
