<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            $table->unique(['sender_id', 'receiver_id', 'gift_id'], 'unique_user_gift');
        });
    }

    public function down(): void
    {
        Schema::table('user_gifts', function (Blueprint $table) {
            $table->dropUnique('unique_user_gift');
        });
    }
};
