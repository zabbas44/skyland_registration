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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            
            // Contact section fields
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('contact_company_name', 100);
            $table->string('contact_mobile');
            $table->string('contact_email');
            $table->string('contact_designation')->nullable();
            
            // Company Information section fields
            $table->string('company_contact_person');
            $table->string('company_designation');
            $table->string('company_email');
            $table->string('company_phone');
            $table->string('company_name');
            $table->string('trade_license_number', 50);
            $table->enum('business_type', ['Supplier', 'Contractor', 'Service Provider']);
            $table->text('nature_of_business');
            $table->integer('year_of_establishment');
            $table->string('website')->nullable();
            $table->text('address');
            $table->string('tax_id')->nullable();
            
            // Compliance & Financial section fields
            $table->enum('preferred_payment_method', ['Bank Transfer', 'Cheques', 'Online']);
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('iban')->nullable();
            $table->string('swift_code')->nullable();
            
            // Attachments (file paths)
            $table->string('trade_license_path')->nullable();
            $table->string('vat_certificate_path')->nullable();
            $table->string('company_profile_path')->nullable();
            
            // Other fields
            $table->enum('accepted_payment_terms', ['30', '60', '90']);
            $table->boolean('worked_with_us_before');
            $table->boolean('has_legal_dispute');
            
            // Common fields
            $table->enum('created_source', ['public_form', 'admin_console'])->default('public_form');
            $table->timestamps();
            
            // Indexes
            $table->index('contact_email');
            $table->index('company_email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
