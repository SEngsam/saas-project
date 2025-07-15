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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'cancelled', 'expired'])->default('active');
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
            $table->index('user_id');
            $table->index('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
