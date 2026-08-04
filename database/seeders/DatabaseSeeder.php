<?php

namespace Database\Seeders;
use App\Models\{AboutPage, Professional, SocialLink, Testimonial, Treatment, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');
        if ($adminEmail && $adminPassword)
            User::updateOrCreate(['email' => $adminEmail], ['name' => env('ADMIN_NAME', 'Administrador Casale'), 'password' => Hash::make($adminPassword)]);
        foreach ([
            ['Odontologia', 'odontologia', 'Odontologia', 'Cuidado odontológico para prevenção, saúde e bem-estar do sorriso.', 'Avaliação individual e tratamentos planejados para cada fase da vida.', ['Avaliação e prevenção', 'Tratamentos restauradores', 'Acompanhamento individual']],
            ['Fisioterapia', 'fisioterapia', 'Fisioterapia', 'Movimento, função e qualidade de vida com acompanhamento individual.', 'Avaliação funcional e plano terapêutico adequado às necessidades de cada pessoa.', ['Avaliação funcional', 'Reabilitação personalizada', 'Orientações para o dia a dia']],
            ['Acupuntura', 'acupuntura', 'Acupuntura', 'Uma abordagem integrativa para equilíbrio, conforto e qualidade de vida.', 'Atendimento individualizado que pode complementar outros cuidados em saúde.', ['Avaliação cuidadosa', 'Plano individual', 'Cuidado integrado']],
        ] as $i => $v)
            Treatment::updateOrCreate(['slug' => $v[1]], ['name' => $v[0], 'category' => $v[2], 'excerpt' => $v[3], 'description' => $v[4], 'benefits' => $v[5], 'sort_order' => $i]);
        foreach ([
            ['Dr. Sérgio Casale', 'sergio-casale', 'Cirurgião-dentista', null, 'Atendimento odontológico cuidadoso, com escuta e atenção às necessidades de cada paciente.', null, ['Odontologia'], 'dr.giovani_casale@gmail.com', 'images/profissional-sergio.jpg'],
            ['Dra. Andresa Rossilho Casale', 'andresa-rossilho-casale', 'Fisioterapeuta e Acupunturista', null, 'Cuidado em fisioterapia e acupuntura com olhar individual e abordagem integrada.', null, ['Fisioterapia', 'Acupuntura'], 'fisio.andresacasale@gmail.com', 'images/profissional-andresa.jpg'],
            ['Dr. Giovani Rossilho Casale', 'giovani-rossilho-casale', 'Cirurgião-dentista', null, 'Atendimento odontológico humanizado, planejado de acordo com cada pessoa.', null, ['Odontologia'], 'dr.giovani_casale@gmail.com', 'images/profissional-giovani.jpg'],
        ] as $i => $v)
            Professional::updateOrCreate(['slug' => $v[1]], ['name' => $v[0], 'title' => $v[2], 'registration' => $v[3], 'summary' => $v[4], 'biography' => $v[5], 'specialties' => $v[6], 'email' => $v[7], 'image_path' => $v[8], 'sort_order' => $i]);
        SocialLink::updateOrCreate(['platform' => 'Instagram'], ['label' => 'Instagram', 'url' => 'https://www.instagram.com/casalesaudeintegrada/', 'sort_order' => 0]);
        AboutPage::firstOrCreate([], ['title' => 'Nossa história', 'subtitle' => 'Uma história construída com cuidado, família e compromisso com a saúde.', 'story' => "A Casale Saúde Integrada nasceu do desejo de oferecer um atendimento próximo, humano e atento a cada pessoa.\n\nAo reunir odontologia, fisioterapia e acupuntura em um mesmo espaço, construímos uma forma de cuidar que valoriza a escuta, a confiança e a colaboração entre profissionais.", 'highlight_title' => 'Cuidar com presença', 'highlight_text' => 'Acreditamos que cada pessoa tem uma história única e merece um plano de cuidado igualmente individual.', 'is_active' => true]);
        Testimonial::firstOrCreate(['name' => 'Paciente Casale'], ['context' => 'Atendimento na clínica', 'content' => 'Fui acolhida com muita atenção desde o primeiro contato. O cuidado e a explicação em cada etapa fizeram toda a diferença.', 'rating' => 5, 'is_active' => true]);
    }
}
