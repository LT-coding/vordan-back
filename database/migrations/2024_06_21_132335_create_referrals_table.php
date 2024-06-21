<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['account', 'business']);
            $table->foreignId('account_id')->nullable()->constrained('accounts');
            $table->foreignId('business_id')->nullable()->constrained('businesses');
            $table->foreignId('invited_by_account_id')->nullable()->constrained('accounts');
            $table->foreignId('invited_by_business_id')->nullable()->constrained('businesses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
