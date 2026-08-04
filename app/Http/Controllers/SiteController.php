<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\SocialLink;
use App\Models\Treatment;
use App\Models\AboutPage;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SiteController extends Controller
{
    private function shared(): array { return ['socialLinks' => SocialLink::where('is_active', true)->orderBy('sort_order')->get(), 'menuTreatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get()]; }
    public function home() { return view('site.home', array_merge($this->shared(), ['professionals' => Professional::where('is_active', true)->orderBy('sort_order')->get(), 'treatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get(), 'testimonials' => Testimonial::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function professionals() { return view('site.professionals.index', array_merge($this->shared(), ['professionals' => Professional::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function professional(Professional $professional) { abort_unless($professional->is_active, 404); return view('site.professionals.show', array_merge($this->shared(), compact('professional'))); }
    public function treatments() { return view('site.treatments.index', array_merge($this->shared(), ['treatments' => Treatment::where('is_active', true)->orderBy('sort_order')->get()])); }
    public function treatment(Treatment $treatment) { abort_unless($treatment->is_active, 404); return view('site.treatments.show', array_merge($this->shared(), compact('treatment'))); }
    public function about()
    {
        $about = AboutPage::with('photos')->where('is_active', true)->first();

        if (! $about) {
            abort_if(AboutPage::exists(), 404);
            $about = new AboutPage([
                'title' => 'Nossa história',
                'subtitle' => 'Uma história construída com cuidado, família e compromisso com a saúde.',
                'story' => "A Casale Saúde Integrada nasceu do desejo de oferecer um atendimento próximo, humano e atento a cada pessoa.\n\nAo reunir odontologia, fisioterapia e acupuntura em um mesmo espaço, construímos uma forma de cuidar que valoriza a escuta, a confiança e a colaboração entre profissionais.",
                'highlight_title' => 'Cuidar com presença',
                'highlight_text' => 'Acreditamos que cada pessoa tem uma história única e merece um plano de cuidado igualmente individual.',
                'is_active' => true,
            ]);
            $about->setRelation('photos', new Collection());
        }

        return view('site.about', array_merge($this->shared(), compact('about')));
    }
    public function integratedCare() { return view('site.integrated-care', $this->shared()); }
    public function contact() { return view('site.contact', $this->shared()); }
    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:10|max:3000',
            'privacy' => 'accepted',
            'website' => 'nullable|max:0',
        ], ['privacy.accepted' => 'Você precisa concordar com a Política de Privacidade.']);
        unset($data['privacy'], $data['website']);
        ContactMessage::create($data);
        return redirect()->route('contact')->with('contact_success', 'Mensagem enviada com sucesso. Nossa equipe responderá em breve.');
    }
    public function privacy() { return view('site.privacy', $this->shared()); }
    public function terms() { return view('site.terms', $this->shared()); }
    public function page(string $view) { return view("site.$view", $this->shared()); }
    public function sitemap() { return response()->view('site.sitemap', ['professionals' => Professional::where('is_active', true)->get(), 'treatments' => Treatment::where('is_active', true)->get()])->header('Content-Type', 'application/xml'); }
}
