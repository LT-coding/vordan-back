<?php

namespace App\Http\Controllers\Api\V1\AdminManagement\Business;

use App\Http\Controllers\Controller;
use App\Mail\AdminManagement\Business\BusinessAcceptMail;
use App\Mail\AdminManagement\Business\BusinessRejectMail;
use App\Models\Business;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class BusinessVerificationWriteController extends Controller
{
    /**
     * Business verification.
     *
     * @param Business $business
     * @param Request $request
     * @return Response
     */
    public function verification(Business $business, Request $request): Response
    {
        $data = $request->validate([
            'verified' => ['required', 'boolean'],
            'rejected_reason' => ['nullable', 'max:255']
        ]);

        $admin = $business->businessAdmins()->first();
        if ($data['verified'] == true) {
            $business->update([
                'verified' => Carbon::now(),
                'approved_by_id' => $request->user('sanctum')->adminAccount->id
            ]);
            Mail::to($admin->email)->send(new BusinessAcceptMail($admin->name));
        } else {
            $business->update([
                'rejected_at' => Carbon::now(),
                'rejected_reason' => $data['rejected_reason'],
                'approved_by_id' => $request->user('sanctum')->adminAccount->id
            ]);
            Mail::to($admin->email)->send(new BusinessRejectMail($admin->name));
        }

        return response()->noContent(Response::HTTP_OK);
    }
}
