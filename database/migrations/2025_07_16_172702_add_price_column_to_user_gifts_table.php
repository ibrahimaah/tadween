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
        Schema::table('user_gifts', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->after('gift_id'); // store snapshot of gift price at time of sending
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            //
        });
    }
};
