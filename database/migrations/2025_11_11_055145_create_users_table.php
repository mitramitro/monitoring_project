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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');

            // role: mps = admin, vendor = user biasa
            $table->enum('role', ['mps', 'vendor'])->default('vendor');

            // vendor terhubung ke perusahaan
            $table->foreignId('company_id')->nullable()
                ->constrained('companies')
                ->nullOnDelete();

            $table->rememberToken();
            $table->timestamps();
        });

        // Schema::create('password_reset_tokens', function (Blueprint $table) {
        //     $table->string('email')->primary();
        //     $table->string('token');
        //     $table->timestamp('created_at')->nullable();
        // });

        // Schema::create('sessions', function (Blueprint $table) {
        //     $table->string('id')->primary();
        //     $table->foreignId('user_id')->nullable()->index();
        //     $table->string('ip_address', 45)->nullable();
        //     $table->text('user_agent')->nullable();
        //     $table->longText('payload');
        //     $table->integer('last_activity')->index();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
