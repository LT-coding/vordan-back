<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminManagement\Admin\AdminEditResource;
use App\Http\Resources\AdminManagement\Admin\AdminIndexResource;
use App\Models\AdminAccount;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminReadController extends Controller
{
    /**
     * Get all admins.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $admins = cache()->remember("admins", 60 * 60 * 24, function () {
            return AdminAccount::all();
        });
        return AdminIndexResource::collection($admins);
    }

    /**
     * Get admin info for data editing.
     *
     * @param AdminAccount $adminAccount
     * @return AdminEditResource
     */
    public function edit(AdminAccount $adminAccount): AdminEditResource
    {
        return new AdminEditResource($adminAccount);
    }
}
