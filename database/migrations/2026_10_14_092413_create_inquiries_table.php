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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code', 30)->unique();
            $table->string('sender_type')->default('student');
            $table->string('full_name');
            $table->string('national_id_or_student_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('inquiry_categories')->nullOnDelete();
            $table->string('priority')->default('normal');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            
            // Status & Reply
            $table->string('status')->default('new');
            $table->text('reply_message')->nullable();
            $table->foreignId('replied_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('replied_at')->nullable();
            $table->text('internal_notes')->nullable();

            $table->boolean('is_public_faq')->default(false);
            $table->string('faq_question')->nullable();
            $table->text('faq_answer')->nullable();

            $table->timestamp('viewed_by_student_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
