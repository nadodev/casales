@extends('layouts.site') @section('title', $professional->name . ' | Casale Saúde Integrada')
@section('description', $professional->summary) @section('content')
<section class="section">
    <div class="container-site grid gap-12 lg:grid-cols-[.8fr_1.2fr]"><img
            src="{{ str_starts_with($professional->image_path ?? '', 'images/') ? asset($professional->image_path) : Storage::url($professional->image_path) }}"
            width="700" height="875" alt="{{ $professional->name }}"
            class="aspect-[4/5] w-full rounded-2xl object-cover shadow-soft">
        <article><span class="eyebrow">Profissional</span>
            <h1>{{ $professional->name }}</h1>
            <p class="mt-3 text-xl text-green-700">{{ $professional->title }}</p>
            @if ($professional->registration)
                <p class="mt-2 text-muted">{{ $professional->registration }}</p>
            @endif
            <p class="mt-8 text-lg">
                {{ $professional->summary }}</p>
            @if ($professional->biography)
                <div class="mt-6 whitespace-pre-line text-muted">{{ $professional->biography }}</div>
            @endif

            @if ($professional->approach)
                <div class="mt-8 rounded-2xl bg-beige-100 p-6"><h2 class="text-2xl">Minha abordagem</h2><p class="mt-3 text-muted">{{ $professional->approach }}</p></div>
            @endif

            @if ($professional->education)
                <h2 class="mt-10 text-3xl">Formação e aperfeiçoamento</h2>
                <ul class="mt-4 grid gap-3">@foreach($professional->education as $item)<li class="border-l-2 border-gold-600 pl-4">{{ $item }}</li>@endforeach</ul>
            @endif

            @if ($professional->experience)
                <h2 class="mt-10 text-3xl">Experiência profissional</h2>
                <ul class="mt-4 grid gap-3">@foreach($professional->experience as $item)<li class="border-l-2 border-green-700 pl-4">{{ $item }}</li>@endforeach</ul>
            @endif

            @if ($professional->specialties)
                    <h2 class="mt-10 text-3xl">Áreas de atuação</h2>
                    <ul class="mt-4 grid gap-3">
                        @foreach ($professional->specialties as $s)
                            <li class="card py-3">{{ $s }}</li>
                        @endforeach
                    </ul>
                @endif
                <a class="btn-primary mt-8" href="{{ route('contact') }}">Agendar atendimento</a>
        </article>
    </div>
</section>@endsection
