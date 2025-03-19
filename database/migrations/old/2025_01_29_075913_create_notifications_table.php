<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // المستخدم المستلم للإشعار
            $table->unsignedBigInteger('notifier_id'); // المستخدم المرسل للإشعار

            $table->string('type'); // نوع الإشعار (like, comment, follow, mention)
            $table->morphs('notifiable'); // لتحديد الكيان المرتبط بالإشعار (post أو user)
            $table->boolean('is_read')->default(false); // هل تمت قراءة الإشعار؟
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
