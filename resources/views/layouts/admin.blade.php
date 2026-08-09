<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="admin-notifications-url" content="{{ route('admin.message-notifications') }}">
    <title>@yield('title', 'Painel') | Casale</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface">
    <header class="bg-green-900 text-white">
        <div class="container-site flex min-h-20 items-center justify-between">
            <a class="font-display text-2xl" href="{{ route('admin.dashboard') }}">Casale · Administração</a>
            <form method="post" action="{{ route('admin.logout') }}">@csrf <button class="rounded-lg border border-white/30 px-4 py-2">Sair</button></form>
        </div>
    </header>
    <div class="container-site grid gap-8 py-8 lg:grid-cols-[220px_1fr]">
        <nav class="card h-fit" aria-label="Administração">
            <a class="admin-link" href="{{ route('admin.dashboard') }}">Visão geral</a>
            <a class="admin-link" href="{{ route('admin.treatments.index') }}">Tratamentos</a>
            <a class="admin-link" href="{{ route('admin.integrated-care.edit') }}">Cuidado Integrado</a>
            <a class="admin-link" href="{{ route('admin.professionals.index') }}">Profissionais</a>
            <a class="admin-link" href="{{ route('admin.about.edit') }}">Nossa História</a>
            <a class="admin-link" href="{{ route('admin.testimonials.index') }}">Avaliações</a>
            <a class="admin-link flex items-center justify-between gap-2" href="{{ route('admin.contact-messages.index') }}">
                <span>Mensagens</span>
                <span data-unread-badge class="{{ $adminUnreadMessages ? '' : 'hidden' }} min-w-6 rounded-full bg-gold-600 px-2 py-0.5 text-center text-xs text-white">{{ $adminUnreadMessages }}</span>
            </a>
            <a class="admin-link" href="{{ route('admin.social-links.index') }}">Redes sociais</a>
            <a class="admin-link" href="{{ route('home') }}" target="_blank">Ver site ↗</a>
        </nav>
        <main class="min-w-0">
            @if(session('success'))<div class="mb-6 rounded-xl bg-green-700 p-4 text-white">{{ session('success') }}</div>@endif
            @if($errors->any())
                <div class="mb-6 rounded-xl border border-red-300 bg-red-50 p-4 text-red-800" role="alert">
                    <strong>Revise os campos:</strong>
                    <ul class="mt-2 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <div data-admin-notification class="pointer-events-none fixed bottom-5 right-5 z-50 hidden max-w-sm rounded-xl bg-green-900 px-5 py-4 text-sm font-semibold text-white shadow-xl" role="status" aria-live="polite"></div>
</body>
</html>
