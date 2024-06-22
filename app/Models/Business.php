<?php

namespace App\Models;

use App\Traits\model\ModelAttributeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory, ModelAttributeTrait, SoftDeletes;

    protected $getLogoAttributeTrait = true;

    protected $fillable = [
        'company_name', 'verified', 'logo', 'rejected_at', 'rejected_reason', 'approved_by_id'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function businessAdmins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'business_users');
    }

    public function businessAccount(): HasOne
    {
        return $this->hasOne(BusinessAccount::class);
    }
}
