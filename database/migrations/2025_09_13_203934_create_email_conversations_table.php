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
        Schema::create('email_conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('subject');
            $table->text('admin_message');
            $table->text('client_reply')->nullable();
            $table->timestamp('admin_sent_at');
            $table->timestamp('client_replied_at')->nullable();
            $table->boolean('admin_read')->default(true); // Admin marks as read when sending
            $table->boolean('client_read')->default(false);
            $table->enum('status', ['pending_reply', 'replied', 'closed'])->default('pending_reply');
            $table->json('admin_attachments')->nullable(); // Store file paths as JSON
            $table->json('client_attachments')->nullable(); // Store file paths as JSON
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->index(['client_id', 'vendor_id']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_conversations');
    }
};