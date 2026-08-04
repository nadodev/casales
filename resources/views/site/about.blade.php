@extends('layouts.site')
@section('title', $about->title . ' | Casale Saúde Integrada')
@section('description', $about->subtitle ?: 'Conheça a história da Casale Saúde Integrada.')
@section('content')
<section class="section overflow-hidden">
    <div class="container-site grid items-center gap-12 lg:grid-cols-2">
        <div><span class="eyebrow">Quem somos</span><h1>{{ $about->title }}</h1>@if($about->subtitle)<p class="mt-6 text-xl text-muted">{{ $about->subtitle }}</p>@endif</div>
        @if($about->cover_image_path)<img src="{{ Storage::url($about->cover_image_path) }}" alt="{{ $about->title }}" class="aspect-[4/3] w-full rounded-2xl object-cover shadow-soft">@endif
    </div>
</section>
<section class="section bg-white"><div class="container-site grid gap-12 lg:grid-cols-[1.2fr_.8fr]"><article><span class="eyebrow">Nossa trajetória</span><div class="whitespace-pre-line text-lg leading-8 text-muted">{{ $about->story }}</div></article>@if($about->highlight_title || $about->highlight_text)<aside class="rounded-2xl bg-green-900 p-8 text-white"><span class="eyebrow text-beige-300">O que nos move</span><h2 class="text-3xl">{{ $about->highlight_title }}</h2><p class="mt-5 text-white/80">{{ $about->highlight_text }}</p></aside>@endif</div></section>
@if($about->photos->isNotEmpty())<section class="section"><div class="container-site"><span class="eyebrow">Galeria</span><h2>Momentos da nossa história</h2><div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach($about->photos as $photo)<figure class="overflow-hidden rounded-2xl bg-white shadow-soft"><img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->caption ?: 'Casale Saúde Integrada' }}" loading="lazy" class="aspect-[4/3] w-full object-cover">@if($photo->caption)<figcaption class="p-4 text-sm text-muted">{{ $photo->caption }}</figcaption>@endif</figure>@endforeach</div></div></section>@endif
@endsection
