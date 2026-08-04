<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->json('education')->nullable()->after('specialties');
            $table->json('experience')->nullable()->after('education');
            $table->text('approach')->nullable()->after('experience');
        });
    }

    public function down(): void
    {
        Schema::table('professionals', fn (Blueprint $table) => $table->dropColumn(['education', 'experience', 'approach']));
    }
};
