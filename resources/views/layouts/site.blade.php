<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Casale Saúde Integrada')</title>
    <meta name="description"
        content="@yield('description', 'Odontologia, fisioterapia e acupuntura em Piracicaba, com cuidado humano e integrado.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Casale Saúde Integrada')">
    <meta property="og:description" content="@yield('description', 'Cuidado humano e integrado em Piracicaba.')">
    <meta property="og:image" content="{{ asset('images/og-casale.jpg') }}">
    <meta name="theme-color" content="#0D493B">@vite(['resources/css/app.css', 'resources/js/app.js'])@stack('head')
</head>

<body><a class="sr-only focus:not-sr-only" href="#conteudo">Ir para o conteúdo</a>
    <header class="site-header sticky top-0 z-50 border-b border-green-900/10 bg-surface/95 backdrop-blur-md">
        <div class="container-site flex min-h-20 items-center justify-between"><a href="{{ route('home') }}"
                aria-label="Casale Saúde Integrada — início"><img src="{{ asset('images/logo-casale.png') }}"
                    width="190" height="60" alt="Casale Saúde Integrada" class="h-14 w-auto"></a><button
                class="menu-toggle lg:hidden" data-menu-button aria-expanded="false" aria-controls="main-nav"><span
                    class="sr-only">Abrir menu</span><span class="menu-toggle-lines" aria-hidden="true"></span></button>
            <button class="menu-backdrop hidden lg:hidden" data-menu-backdrop type="button" aria-label="Fechar menu"></button>
            <nav id="main-nav" class="main-nav hidden lg:block" aria-label="Principal">
                <div class="main-nav-inner"><a class="nav-link" href="{{ route('about') }}">Nossa história</a><a class="nav-link"
                        href="{{ route('professionals') }}">Profissionais</a>
                    <div class="treatment-nav"><button class="nav-link flex w-full items-center justify-between lg:w-auto lg:justify-start" data-submenu-button
                            aria-expanded="false" aria-controls="treatment-menu">Tratamentos <span>⌄</span></button>
                        <div id="treatment-menu" hidden
                            class="treatment-menu">
                            @foreach($menuTreatments as $menuTreatment)<a
                                class="block rounded-lg px-4 py-3 hover:bg-beige-100"
                            href="{{ route('treatments.show', $menuTreatment) }}">{{ $menuTreatment->name }}</a>@endforeach<a
                                class="block rounded-lg px-4 py-3 hover:bg-beige-100"
                                href="{{ route('integrated-care') }}">Cuidado Integrado</a>
                            <div class="mt-2 border-t border-green-900/10 pt-2"><a
                                    class="block rounded-lg px-4 py-3 font-bold text-green-700 hover:bg-beige-100"
                                    href="{{ route('treatments') }}">Ver todos</a></div>
                        </div>
                    </div><a class="nav-link" href="{{ route('contact') }}">Contato</a>@if($whatsappUrl)<a class="btn-primary menu-cta"
                        href="{{ $whatsappUrl }}" target="_blank" rel="noopener">Agendar atendimento</a>@endif
                </div>
            </nav>
        </div>
    </header>
    <main id="conteudo">@yield('content')</main>
    <footer class="bg-green-900 py-14 text-white">
        <div class="container-site grid gap-10 md:grid-cols-3">
            <div><img src="{{ asset('images/logo-casale.png') }}" width="180" height="57" alt="Casale Saúde Integrada"
                    class="mb-4 brightness-0 invert">
                <p class="text-white/75">Odontologia, fisioterapia e acupuntura em um cuidado humano e integrado.</p>
            </div>
            <div>
                <h2 class="text-xl">Contato</h2>
                <p class="mt-3 text-white/75">(19) 3424-2812<br>casalesaudeintegrada@gmail.com<br>R. Alexandre Francoso,
                    55<br>Piracicaba — SP</p>
            </div>
            <div>
                <h2 class="text-xl">Acompanhe</h2>
                <div class="mt-4 flex flex-wrap gap-3">@foreach($socialLinks as $social)<a
                    class="social-icon-link" href="{{ $social->url }}" target="_blank" rel="noopener"
                    aria-label="{{ $social->label }}" title="{{ $social->label }}">@include('site.partials.social-icon', ['platform' => $social->platform])</a>@endforeach</div><div class="mt-5 text-sm text-white/60"><a
                        href="{{ route('privacy') }}">Privacidade</a> · <a href="{{ route('terms') }}">Termos</a></div>
            </div>
        </div>
        <p class="container-site mt-10 border-t border-white/10 pt-6 text-sm text-white/55">© <span
                data-current-year>{{ date('Y') }}</span> Casale Saúde Integrada.</p>
    </footer>
    @if($whatsappUrl)<a class="whatsapp-float" href="{{ $whatsappUrl }}" target="_blank" rel="noopener" aria-label="Conversar pelo WhatsApp" title="Conversar pelo WhatsApp">
        @include('site.partials.social-icon', ['platform' => 'WhatsApp'])
    </a>@endif
</body>

</html>
