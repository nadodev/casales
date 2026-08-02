<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void { Schema::create('treatments', function (Blueprint $table) { $table->id(); $table->string('name'); $table->string('slug')->unique(); $table->string('category'); $table->text('excerpt'); $table->longText('description'); $table->json('benefits')->nullable(); $table->boolean('is_active')->default(true)->index(); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('treatments'); }
};
