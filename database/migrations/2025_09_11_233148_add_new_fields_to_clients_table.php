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
            // New Client & Company fields
            $table->string('company_name')->nullable()->after('client_type');
            $table->string('registration_number')->nullable()->after('company_name');
            $table->enum('id_type', ['emirates_id', 'passport', 'trade_license'])->nullable()->after('registration_number');
            $table->string('id_number')->nullable()->after('id_type');
            
            // New Project & Service Requirements fields
            $table->enum('project_type', ['residential_villa', 'commercial_retail', 'industrial_warehouse', 'fitout_renovation', 'maintenance', 'others'])->nullable()->after('id_number');
            $table->enum('service_needed', ['design_approval', 'civil_construction', 'mep_works', 'interior_joinery', 'landscaping', 'maintenance_amc'])->nullable()->after('project_type');
            $table->enum('estimated_budget', ['under_50k', '50k_100k', '100k_250k', '250k_500k', '500k_1m', '1m_5m', 'over_5m'])->nullable()->after('service_needed');
            
            // New Address fields
            $table->string('street')->nullable()->after('estimated_budget');
            $table->string('community')->nullable()->after('street');
            $table->enum('emirate', ['abu_dhabi', 'dubai', 'sharjah', 'ajman', 'umm_al_quwain', 'ras_al_khaimah', 'fujairah'])->nullable()->after('community');
            $table->string('plot_unit_number')->nullable()->after('emirate');
            
            // New Timeline fields
            $table->date('target_start_date')->nullable()->after('plot_unit_number');
            $table->enum('desired_timeline', ['urgent_0_4_weeks', 'short_1_3_months', 'medium_3_6_months', 'long_6_plus_months'])->nullable()->after('target_start_date');
            $table->text('project_brief')->nullable()->after('desired_timeline');
            
            // New File upload fields
            $table->string('site_plans_path')->nullable()->after('project_brief');
            $table->string('additional_documents_path')->nullable()->after('site_plans_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'registration_number',
                'id_type',
                'id_number',
                'project_type',
                'service_needed',
                'estimated_budget',
                'street',
                'community',
                'emirate',
                'plot_unit_number',
                'target_start_date',
                'desired_timeline',
                'project_brief',
                'site_plans_path',
                'additional_documents_path'
            ]);
        });
    }
};
