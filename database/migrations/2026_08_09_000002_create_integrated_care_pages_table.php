<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('integrated_care_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_kicker')->default('Cuidado Integrado');
            $table->string('title');
            $table->text('intro');
            $table->string('how_title')->default('Como funciona');
            $table->json('steps')->nullable();
            $table->string('section_kicker')->nullable();
            $table->string('section_title')->nullable();
            $table->text('section_intro')->nullable();
            $table->json('benefits')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_text')->nullable();
            $table->string('cta_label')->default('Agendar uma avaliação');
            $table->string('cover_image_path')->nullable();
            $table->string('seo_description', 320)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        DB::table('integrated_care_pages')->insert([
            'hero_kicker' => 'Cuidado Integrado',
            'title' => 'Você por inteiro, no centro do cuidado.',
            'intro' => 'Na Casale, diferentes áreas da saúde conversam para compreender suas necessidades de forma ampla, respeitosa e individual.',
            'how_title' => 'Um cuidado que se conecta',
            'steps' => json_encode([
                ['title' => 'Escuta inicial', 'text' => 'Entendemos sua rotina, suas queixas e os objetivos que deseja alcançar.'],
                ['title' => 'Olhar compartilhado', 'text' => 'Quando necessário, nossos profissionais alinham conhecimentos e possibilidades.'],
                ['title' => 'Plano individual', 'text' => 'O cuidado é definido de acordo com você e acompanhado ao longo do tempo.'],
            ], JSON_UNESCAPED_UNICODE),
            'section_kicker' => 'Cuidado sem fragmentos',
            'section_title' => 'Diferentes perspectivas, um só propósito',
            'section_intro' => 'A integração acontece quando ela realmente contribui para compreender melhor cada caso e organizar um caminho de cuidado coerente.',
            'benefits' => json_encode([
                ['title' => 'Visão ampliada', 'text' => 'Consideramos a pessoa, sua rotina e suas necessidades, não apenas um sintoma isolado.'],
                ['title' => 'Comunicação entre profissionais', 'text' => 'As áreas envolvidas podem compartilhar percepções e alinhar prioridades.'],
                ['title' => 'Acompanhamento contínuo', 'text' => 'O plano pode ser ajustado conforme sua evolução e seus objetivos.'],
            ], JSON_UNESCAPED_UNICODE),
            'cta_title' => 'Vamos entender o cuidado que faz sentido para você?',
            'cta_text' => 'Converse com nossa equipe para tirar dúvidas e agendar uma avaliação.',
            'cta_label' => 'Agendar uma avaliação',
            'seo_description' => 'Cuidado integrado em odontologia, fisioterapia e acupuntura, com avaliação individual e comunicação entre profissionais.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('integrated_care_pages');
    }
};
