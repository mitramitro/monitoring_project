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
        Schema::create('daily_work_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_work_id')
                ->constrained('daily_works')
                ->cascadeOnDelete();
            $table->foreignId('contract_id')
                ->constrained('contracts')
                ->cascadeOnDelete();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->time('overtime_until_plan')->nullable();
            $table->boolean('is_absen')->default(false);
            $table->string('absen_reason')->nullable();
            $table->string('note')->nullable();
            $table->integer('total_workers')->nullable();
            $table->enum('approval', ['Wait', 'Approved', 'Rejected'])
                ->default('Wait');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_work_item');
    }
};
