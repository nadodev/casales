<?php

namespace Tests\Feature;
use App\Models\{AboutPage,Professional,SocialLink,Testimonial,Treatment,User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AdminTest extends TestCase {
 use RefreshDatabase;
 public function test_public_home_is_available():void{$this->seed();$this->get('/')->assertOk()->assertSee('Saúde cuidada por inteiro');}
 public function test_professional_profile_is_available():void{$this->seed();$this->get('/profissionais/andresa-rossilho-casale')->assertOk()->assertSee('Dra. Andresa Rossilho Casale')->assertSee('Áreas de atuação');}
 public function test_guest_cannot_open_dashboard():void{$this->get('/admin')->assertRedirect('/admin/login');}
 public function test_admin_can_manage_content():void{$user=User::factory()->create();$this->actingAs($user)->post(route('admin.treatments.store'),['name'=>'Pilates clínico','slug'=>'pilates-clinico','category'=>'Fisioterapia','excerpt'=>'Atendimento individualizado para movimento e bem-estar.','description'=>'Programa definido após avaliação.','benefits_text'=>"Mobilidade\nForça",'is_active'=>1,'sort_order'=>4])->assertRedirect(route('admin.treatments.index'));$this->assertDatabaseHas('treatments',['slug'=>'pilates-clinico','is_active'=>1]);$this->actingAs($user)->post(route('admin.social-links.store'),['platform'=>'YouTube','label'=>'YouTube','url'=>'https://youtube.com/@casale','is_active'=>1])->assertRedirect(route('admin.social-links.index'));$this->assertDatabaseHas('social_links',['platform'=>'YouTube']);}
 public function test_public_pages_only_show_active_content():void{Treatment::create(['name'=>'Oculto','slug'=>'oculto','category'=>'Teste','excerpt'=>'Resumo','description'=>'Descrição','is_active'=>false]);$this->get('/tratamentos/oculto')->assertNotFound();}
 public function test_clean_public_routes_and_new_pages_are_available():void{$this->seed();$this->get('/profissionais')->assertOk();$this->get('/tratamentos')->assertOk();$this->get('/contato')->assertOk();$this->get('/nossa-historia')->assertOk()->assertSee('Nossa trajetória');$this->get('/cuidado-integrado')->assertOk()->assertSee('Você por inteiro');$this->get('/profissionais.html')->assertNotFound();}
 public function test_admin_can_manage_testimonials_and_about_page():void{$this->seed();$user=User::factory()->create();$this->actingAs($user)->post(route('admin.testimonials.store'),['name'=>'Maria','content'=>'Atendimento muito atencioso e acolhedor.','rating'=>5,'is_active'=>1])->assertRedirect(route('admin.testimonials.index'));$this->assertDatabaseHas('testimonials',['name'=>'Maria']);$this->actingAs($user)->put(route('admin.about.update'),['title'=>'Nossa trajetória','story'=>'Uma história de cuidado.','is_active'=>1])->assertRedirect();$this->assertDatabaseHas('about_pages',['title'=>'Nossa trajetória']);}
 public function test_about_page_has_default_content_before_admin_setup():void{$this->get('/nossa-historia')->assertOk()->assertSee('Nossa história')->assertSee('Nossa trajetória');}
}
