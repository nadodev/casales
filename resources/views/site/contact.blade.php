@extends('layouts.site')
@section('title','Contato | Casale Saúde Integrada')
@section('content')
<section class="section"><div class="container-site"><div class="max-w-3xl"><span class="eyebrow">Contato</span><h1>Vamos cuidar de você?</h1><p class="mt-5 text-lg text-muted">Envie sua mensagem ou fale com nossa equipe para tirar dúvidas e agendar seu atendimento.</p></div>
<div class="mt-12 grid gap-10 lg:grid-cols-[1.15fr_.85fr]">
<form class="admin-form" method="post" action="{{ route('contact.send') }}">@csrf
    @if(session('contact_success'))<div class="rounded-xl bg-green-700 p-4 text-white" role="status">{{ session('contact_success') }}</div>@endif
    <input type="hidden" name="_form_started_at" value="{{ $formStartedAt }}">
    <input type="hidden" name="_form_token" value="{{ $formToken }}">
    <div class="contact-honeypot" aria-hidden="true"><label>Deixe este campo vazio<input name="website" tabindex="-1" autocomplete="off"></label></div>
    <div class="grid gap-5 sm:grid-cols-2"><label for="name">Nome<input class="field" id="name" name="name" value="{{ old('name') }}" required autocomplete="name">@error('name')<span class="error">{{ $message }}</span>@enderror</label><label for="email">E-mail<input class="field" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">@error('email')<span class="error">{{ $message }}</span>@enderror</label><label for="phone">Telefone/WhatsApp<input class="field" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"></label><label for="subject">Assunto<input class="field" id="subject" name="subject" value="{{ old('subject') }}"></label></div>
    <label for="message">Como podemos ajudar?<textarea class="field" id="message" name="message" rows="7" required>{{ old('message') }}</textarea>@error('message')<span class="error">{{ $message }}</span>@enderror</label>
    <label class="flex items-start gap-3 text-sm font-normal"><input class="mt-1" type="checkbox" name="privacy" value="1" @checked(old('privacy')) required><span>Concordo com o uso dos dados para resposta ao meu contato, conforme a <a class="font-bold text-green-700 underline" href="{{ route('privacy') }}" target="_blank">Política de Privacidade</a>.</span></label>@error('privacy')<span class="error">{{ $message }}</span>@enderror
    <button class="btn-primary w-fit" type="submit">Enviar mensagem</button>
</form>
<aside class="space-y-6"><div class="card"><h2 class="text-3xl">Outros canais</h2><p class="mt-5"><strong>Telefone:</strong><br>(19) 3424-2812</p><p class="mt-3"><strong>E-mail:</strong><br>casalesaudeintegrada@gmail.com</p><p class="mt-3"><strong>Endereço:</strong><br>R. Alexandre Francoso, 55, Dois Córregos<br>Piracicaba — SP, 13420-855</p>@if($whatsappUrl)<a class="btn-primary mt-6" href="{{ $whatsappUrl }}" target="_blank" rel="noopener">Conversar pelo WhatsApp</a>@endif</div><div class="rounded-2xl bg-green-900 p-7 text-white"><h2 class="text-2xl">Formas de atendimento</h2><p class="mt-4 text-white/75">Na clínica, em domicílio ou online, conforme avaliação e disponibilidade.</p><a class="mt-5 inline-block text-beige-300 underline" href="https://www.google.com/maps/search/?api=1&query=R.%20Alexandre%20Francoso%2C%2055%2C%20Piracicaba%20SP" target="_blank" rel="noopener">Como chegar</a></div></aside>
</div></div></section>
@endsection
