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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('assigned_to_user_id')->index();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('priority')->nullable()->comment("high,low,medium");
            $table->boolean('is_closed')->default(false);
            $table->timestamp('closed_date')->nullable();
            $table->unsignedBigInteger('open_by_user')->index();
            $table->unsignedBigInteger('closed_by_user')->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
