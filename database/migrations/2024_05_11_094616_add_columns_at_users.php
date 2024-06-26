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
            $table->enum('role', ['admin', 'customer'])->after('id')->default('customer');
            $table->enum('status', ['pending', 'approved', 'rejected'])->after('id')->default('pending');
            $table->string('name', length: 100)->change();
            $table->string('phone', length: 20)->after('name')->nullable();
            $table->string('email', length: 100)->change();
            $table->string('company_name', length: 255)->after('password')->nullable();
            $table->string('company_address', length: 255)->after('company_name')->nullable();
            $table->string('company_phone', length: 20)->after('company_address')->nullable();
            $table->string('company_email', length: 100)->after('company_phone')->nullable();
            $table->string('company_NPWP', length: 20)->after('company_email')->nullable();
            $table->string('company_akta', length: 255)->after('company_NPWP')->nullable();
            $table->text('reason_rejected')->nullable();
            $table->timestampTz('rejected_at', precision: 0)->nullable();
            $table->timestampTz('approved_at', precision: 0)->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('phone');
            $table->dropColumn('company_name');
            $table->dropColumn('company_address');
            $table->dropColumn('company_phone');
            $table->dropColumn('company_email');
            $table->dropColumn('company_NPWP');
            $table->dropColumn('company_akta');
            $table->dropColumn('reason_rejected');
            $table->dropColumn('rejected_at');
            $table->dropColumn('approved_at');
            $table->dropColumn('deleted_at');
        });
    }
};
