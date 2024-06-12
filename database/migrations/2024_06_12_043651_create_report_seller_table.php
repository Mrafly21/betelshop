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
        Schema::create('report_sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The user who is reporting
            $table->unsignedBigInteger('seller_id'); // The seller being reported
            $table->text('message'); // The reason for reporting
            $table->string('status')->default('on-review');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_seller');
    }
};
