<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('social_links', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('label');
        });

        $existingWhatsApp = DB::table('social_links')->whereRaw('LOWER(platform) = ?', ['whatsapp'])->first();

        if ($existingWhatsApp) {
            $phone = preg_replace('/\D+/', '', parse_url($existingWhatsApp->url, PHP_URL_PATH) ?? '');
            DB::table('social_links')->where('id', $existingWhatsApp->id)->update([
                'phone' => $phone ?: null,
                'updated_at' => now(),
            ]);
        } else {
            DB::table('social_links')->insert([
                'platform' => 'WhatsApp',
                'label' => 'WhatsApp',
                'phone' => '551934242812',
                'url' => 'https://wa.me/551934242812',
                'is_active' => true,
                'sort_order' => 99,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('social_links')->where('platform', 'WhatsApp')->where('phone', '551934242812')->delete();

        Schema::table('social_links', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
