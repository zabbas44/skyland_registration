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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['admin', 'client', 'supplier'])->default('client')->after('is_admin');
            $table->unsignedBigInteger('client_id')->nullable()->after('user_type');
            $table->unsignedBigInteger('supplier_id')->nullable()->after('client_id');
            
            // Add foreign key constraints
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropColumn(['user_type', 'client_id', 'supplier_id']);
        });
    }
};
