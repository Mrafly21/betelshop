<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert the contact_number to string format before changing the column type
        DB::statement('UPDATE users SET contact_number = CAST(contact_number AS CHAR(20))');

        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally convert back to integer if needed
        DB::statement('UPDATE users SET contact_number = CAST(contact_number AS SIGNED)');

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('contact_number')->change();
        });
    }
};
