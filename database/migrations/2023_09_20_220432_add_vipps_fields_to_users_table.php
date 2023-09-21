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

            $table->after('id', function ($table) {
                $table->string('vipps_id')->nullable()->index();
            });

            $table->after('name', function ($table) {
                $table->string('family_name')->nullable();
                $table->string('given_name')->nullable();
                $table->date('birthdate')->nullable();
                $table->string('phone_number')->nullable();
            });

            $table->after('email', function ($table) {
                $table->boolean('email_verified')->nullable();
                $table->string('postal_code')->nullable()->index();
                $table->json('address')->nullable();
                $table->json('other_addresses')->nullable();
            });

            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
