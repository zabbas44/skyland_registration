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
        Schema::create('communication_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('entity_type', ['client', 'vendor']);
            $table->unsignedBigInteger('entity_id');
            $table->unsignedBigInteger('admin_user_id');
            $table->string('subject');
            $table->text('message_preview')->nullable();
            $table->enum('status', ['sent', 'failed']);
            $table->string('provider_message_id')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('admin_user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes
            $table->index(['entity_type', 'entity_id']);
            $table->index('admin_user_id');
            $table->index('status');
            $table->index('sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communication_logs');
    }
};
