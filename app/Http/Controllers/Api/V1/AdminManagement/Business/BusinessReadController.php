<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Business;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminManagement\Business\BusinessIndexResource;
use App\Http\Resources\AdminManagement\Business\BusinessShowResource;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BusinessReadController extends Controller
{
    /**
     * Get all businesses.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $businesses = cache()->remember("businesses", 60 * 60 * 24, function () {
            return Business::all();
        });

        return BusinessIndexResource::collection($businesses->sortByDesc('id'));
    }

    /**
     * Show business info.
     *
     * @param Business $business
     * @return BusinessShowResource
     */
    public function show(Business $business): BusinessShowResource
    {
        return new BusinessShowResource($business);
    }
}
