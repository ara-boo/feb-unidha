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
       Schema::create('study_programs', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->string('degree', 10);
    $table->string('accreditation', 50)->nullable();
    $table->string('head_name')->nullable();
    $table->string('website_url')->nullable();
    $table->text('description')->nullable();
    $table->unsignedInteger('sort_order')->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
