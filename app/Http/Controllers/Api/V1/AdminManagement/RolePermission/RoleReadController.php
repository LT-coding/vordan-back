<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\RolePermission;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleReadController extends Controller
{
    /**
     * Get all admin management roles.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'admin', 'manager', 'accountant'
        ]);
    }
}
