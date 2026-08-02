<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::create('professionals', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->string('title'); $table->string('registration')->nullable(); $table->text('summary'); $table->longText('biography')->nullable(); $table->json('specialties')->nullable(); $table->string('email')->nullable(); $table->string('image_path')->nullable(); $table->boolean('is_active')->default(true)->index(); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('professionals'); }
};
