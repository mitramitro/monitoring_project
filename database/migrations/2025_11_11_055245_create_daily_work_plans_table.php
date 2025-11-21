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
        Schema::create('daily_work_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_work_item_id')
                ->constrained('daily_work_items')
                ->cascadeOnDelete();
            $table->string('plan_name');
            // $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_work_plans');
    }
};
