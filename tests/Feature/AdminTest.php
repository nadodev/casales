<?php

namespace Tests\Feature;
use App\Models\{Professional,SocialLink,Treatment,User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class AdminTest extends TestCase {
 use RefreshDatabase;
 public function test_public_home_is_available():void{$this->seed();$this->get('/')->assertOk()->assertSee('Saúde cuidada por inteiro');}
 public function test_guest_cannot_open_dashboard():void{$this->get('/admin')->assertRedirect('/admin/login');}
 public function test_admin_can_manage_content():void{$user=User::factory()->create();$this->actingAs($user)->post(route('admin.treatments.store'),['name'=>'Pilates clínico','slug'=>'pilates-clinico','category'=>'Fisioterapia','excerpt'=>'Atendimento individualizado para movimento e bem-estar.','description'=>'Programa definido após avaliação.','benefits_text'=>"Mobilidade\nForça",'is_active'=>1,'sort_order'=>4])->assertRedirect(route('admin.treatments.index'));$this->assertDatabaseHas('treatments',['slug'=>'pilates-clinico','is_active'=>1]);$this->actingAs($user)->post(route('admin.social-links.store'),['platform'=>'YouTube','label'=>'YouTube','url'=>'https://youtube.com/@casale','is_active'=>1])->assertRedirect(route('admin.social-links.index'));$this->assertDatabaseHas('social_links',['platform'=>'YouTube']);}
 public function test_public_pages_only_show_active_content():void{Treatment::create(['name'=>'Oculto','slug'=>'oculto','category'=>'Teste','excerpt'=>'Resumo','description'=>'Descrição','is_active'=>false]);$this->get('/tratamentos/oculto')->assertNotFound();}
}
