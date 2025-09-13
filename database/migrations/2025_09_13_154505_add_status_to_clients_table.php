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
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('created_source');
            $table->text('status_reason')->nullable()->after('status');
            $table->timestamp('status_updated_at')->nullable()->after('status_reason');
            $table->unsignedBigInteger('status_updated_by')->nullable()->after('status_updated_at');
            
            // Add foreign key for who updated the status
            $table->foreign('status_updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['status_updated_by']);
            $table->dropColumn(['status', 'status_reason', 'status_updated_at', 'status_updated_by']);
        });
    }
};
