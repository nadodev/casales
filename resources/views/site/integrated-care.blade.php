@extends('layouts.site')
@section('title', $page->title.' | Casale Saúde Integrada')
@section('description', $page->seo_description ?: $page->intro)
@section('content')
<section class="integrated-hero section overflow-hidden">
    <div class="container-site grid items-center gap-12 lg:grid-cols-[1.05fr_.95fr]">
        <div class="relative z-10">
            <span class="eyebrow">{{ $page->hero_kicker }}</span>
            <h1>{{ $page->title }}</h1>
            <p class="mt-6 max-w-2xl text-lg text-muted">{{ $page->intro }}</p>
            <div class="mt-8 flex flex-wrap gap-3"><a class="btn-primary" href="{{ route('contact') }}">{{ $page->cta_label }}</a><a class="btn-secondary" href="#como-funciona">Entenda como funciona</a></div>
        </div>
        <div class="integrated-hero-visual">
            @if($page->cover_image_path)
                <img src="{{ route('media', ['path' => $page->cover_image_path]) }}" alt="Cuidado integrado na Casale Saúde" class="h-full w-full object-cover">
            @else
                @php
                    $orbitTreatments = $menuTreatments->take(7)->values();
                    $hiddenTreatments = max(0, $menuTreatments->count() - $orbitTreatments->count());
                    $orbitItems = $orbitTreatments->map(fn ($treatment) => $treatment->name);
                    if ($hiddenTreatments > 0) $orbitItems->push('+'.$hiddenTreatments.' '.($hiddenTreatments === 1 ? 'área' : 'áreas'));
                    $orbitCount = max(1, $orbitItems->count());
                @endphp
                <div class="integrated-orbit" aria-label="Áreas conectadas ao cuidado integrado">
                    @foreach($orbitItems as $index => $label)
                        @php
                            $angle = deg2rad(-90 + (($index * 360) / $orbitCount));
                            $x = 50 + (35 * cos($angle));
                            $y = 50 + (35 * sin($angle));
                        @endphp
                        <span style="--orbit-x: {{ number_format($x, 2, '.', '') }}%; --orbit-y: {{ number_format($y, 2, '.', '') }}%;">{{ $label }}</span>
                    @endforeach
                    <strong>Você</strong>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="como-funciona" class="section bg-white">
    <div class="container-site">
        <div class="max-w-2xl"><span class="eyebrow">Jornada de cuidado</span><h2>{{ $page->how_title }}</h2></div>
        <div class="mt-10 grid gap-5 lg:grid-cols-3">
            @foreach($page->steps ?? [] as $index => $step)
                <article class="integrated-step">
                    <span class="integrated-step-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3>{{ $step['title'] ?? '' }}</h3>
                    <p class="mt-3 text-muted">{{ $step['text'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="section bg-green-900 text-white">
    <div class="container-site grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
        <div><span class="eyebrow text-beige-300">{{ $page->section_kicker }}</span><h2>{{ $page->section_title }}</h2><p class="mt-5 text-white/70">{{ $page->section_intro }}</p></div>
        <div class="grid gap-4 sm:grid-cols-2">
            @foreach($page->benefits ?? [] as $benefit)
                <article class="rounded-2xl border border-white/15 bg-white/5 p-6 backdrop-blur-sm"><span class="mb-5 block h-px w-10 bg-gold-600"></span><h3>{{ $benefit['title'] ?? '' }}</h3><p class="mt-3 text-white/70">{{ $benefit['text'] ?? '' }}</p></article>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="container-site">
        <div class="max-w-2xl"><span class="eyebrow">Áreas conectadas</span><h2>Uma equipe, diferentes perspectivas</h2><p class="mt-4 text-muted">Conheça as especialidades que podem conversar entre si quando o seu caso se beneficia de uma visão compartilhada.</p></div>
        <div class="mt-10 grid gap-5 md:grid-cols-3">
            @foreach($menuTreatments as $t)
                <a class="card group" href="{{ route('treatments.show', $t) }}"><span class="eyebrow">{{ $t->category }}</span><h3>{{ $t->name }}</h3><p class="mt-3 text-muted">{{ $t->excerpt }}</p><span class="mt-6 block font-bold text-green-700 transition group-hover:translate-x-1">Conhecer →</span></a>
            @endforeach
        </div>
    </div>
</section>

<section class="pb-16 md:pb-24">
    <div class="container-site"><div class="integrated-cta"><div><span class="eyebrow text-beige-300">Próximo passo</span><h2>{{ $page->cta_title }}</h2><p class="mt-4 max-w-2xl text-white/75">{{ $page->cta_text }}</p></div><a class="btn bg-white text-green-900 hover:bg-beige-100" href="{{ route('contact') }}">{{ $page->cta_label }}</a></div></div>
</section>
@endsection
