<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManagement\Business\BusinessStoreRequest;
use App\Mail\AdminManagement\Business\BusinessAcceptMail;
use App\Models\Business;
use App\Models\BusinessUser;
use App\Models\User;
use App\Traits\StorageTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\JsonResponse;

class BusinessWriteController extends Controller
{
    use StorageTrait;

    /**
     * Create a new business.
     *
     * @param BusinessStoreRequest $request
     * @return JsonResponse
     */
    public function store(BusinessStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['referral_code'] = Str::uuid()->toString();
        $data['password'] = Hash::make(Str::random());
        $data['verified'] = Carbon::now();
        $user = User::create($data);
        $user->assignRole('admin');
        if (!is_null($data['logo'])) {
            $data['logo'] = $this->storeFile('files/images/business/logos', $data['logo']);
        }
        $data['user_id'] = $user->id;
        $business = Business::create($data);
        $business->businessAccount()->create($data);
        BusinessUser::create(['user_id' => $user->id, 'business_id' => $business->id]);

        Mail::to($user->email)->send(new BusinessAcceptMail($data['name']));

        return response()->json($business->id);
    }
}
