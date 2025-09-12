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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            
            // General Information section fields
            $table->string('full_name');
            $table->string('org_name')->nullable();
            $table->enum('client_type', ['Individual', 'Corporate', 'Government', 'NGOs']);
            $table->string('industry')->nullable();
            $table->string('job_title')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email');
            $table->string('mobile');
            $table->string('office_phone')->nullable();
            $table->text('address');
            $table->string('website')->nullable();
            $table->text('nature_of_business')->nullable();
            $table->json('core_services')->nullable(); // JSON for multi-select
            $table->string('budget_range')->nullable();
            $table->string('referral_source')->nullable();
            $table->string('trade_license_number')->nullable();
            $table->string('tax_id')->nullable();
            
            // Contact Details section fields
            $table->string('primary_contact_person');
            $table->string('designation')->nullable();
            $table->string('official_email');
            $table->string('contact_mobile');
            $table->string('contact_landline')->nullable();
            $table->text('physical_address');
            $table->string('contact_website')->nullable();
            
            // Business/Service Details section fields
            $table->json('services_required'); // JSON for multi-select
            $table->string('expected_order_volume')->nullable();
            $table->string('business_budget_range')->nullable();
            $table->string('business_referral_source')->nullable();
            $table->text('selection_reason');
            
            // Compliance & Financial section fields
            $table->enum('preferred_payment_method', ['Bank Transfer', 'Cheques', 'Online']);
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
            
            // Common fields
            $table->enum('created_source', ['public_form', 'admin_console'])->default('public_form');
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('official_email');
            $table->index('client_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
