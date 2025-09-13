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
        Schema::create('chat_conversations', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type'); // 'client' or 'vendor'
            $table->unsignedBigInteger('entity_id'); // client_id or vendor_id
            $table->string('title')->nullable(); // conversation title
            $table->enum('status', ['active', 'archived', 'closed'])->default('active');
            $table->timestamp('last_message_at')->nullable();
            $table->unsignedBigInteger('last_message_by')->nullable(); // user_id who sent last message
            $table->text('last_message_preview')->nullable();
            $table->integer('unread_count_admin')->default(0);
            $table->integer('unread_count_client')->default(0);
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['entity_type', 'entity_id']);
            $table->index('last_message_at');
            $table->foreign('last_message_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_conversations');
    }
};
