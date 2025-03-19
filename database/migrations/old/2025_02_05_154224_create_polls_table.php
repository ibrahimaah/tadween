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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->timestamp('expires_at');
            
            // الحقول الخاصة بالخيارات الأربعة
            $table->string('option1_text');
            $table->integer('option1_votes')->default(0);
            
            $table->string('option2_text');
            $table->integer('option2_votes')->default(0);
            
            // الخيار الثالث والرابع اختياريان (يمكن تركهما فارغين إذا لم يتم استخدامهما)
            $table->string('option3_text')->nullable();
            $table->integer('option3_votes')->default(0);
            
            $table->string('option4_text')->nullable();
            $table->integer('option4_votes')->default(0);
            $table->timestamps();

            // Foreign keys
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
