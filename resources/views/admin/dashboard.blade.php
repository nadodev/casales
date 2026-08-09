@extends('layouts.admin')
@section('title', 'Visão geral')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div><span class="eyebrow">Administração</span><h1 class="text-5xl">Visão geral</h1></div>
</div>

<section class="mt-8 rounded-2xl border border-green-900/10 bg-white shadow-soft" aria-labelledby="latest-messages-title">
    <div class="flex flex-wrap items-center justify-between gap-3 border-b border-green-900/10 px-5 py-4 sm:px-6">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.16em] text-gold-600">Caixa de entrada</p>
            <h2 id="latest-messages-title" class="mt-1 text-2xl">Últimas mensagens não lidas</h2>
        </div>
        <a class="text-sm font-bold text-green-700" href="{{ route('admin.contact-messages.index') }}">Ver todas →</a>
    </div>
    <div class="divide-y divide-green-900/10">
        @forelse($latestUnreadMessages as $message)
            <a class="grid gap-2 px-5 py-4 transition hover:bg-beige-100 sm:grid-cols-[1fr_auto] sm:px-6" href="{{ route('admin.contact-messages.show', $message) }}">
                <div class="min-w-0">
                    <div class="flex items-center gap-2"><span class="h-2 w-2 shrink-0 rounded-full bg-gold-600"></span><strong class="truncate">{{ $message->name }}</strong></div>
                    <p class="mt-1 truncate text-sm font-semibold">{{ $message->subject ?: 'Contato pelo site' }}</p>
                    <p class="mt-1 truncate text-sm text-muted">{{ Str::limit($message->message, 90) }}</p>
                </div>
                <time class="text-xs text-muted" datetime="{{ $message->created_at->toIso8601String() }}">{{ $message->created_at->format('d/m H:i') }}</time>
            </a>
        @empty
            <p class="px-6 py-8 text-center text-muted">Tudo em dia. Não há mensagens novas.</p>
        @endforelse
    </div>
</section>

<div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @foreach([['Tratamentos',$treatments,route('admin.treatments.index')],['Profissionais',$professionals,route('admin.professionals.index')],['Nossa História',$aboutPages,route('admin.about.edit')],['Avaliações',$testimonials,route('admin.testimonials.index')],['Todas as mensagens',$contactMessages,route('admin.contact-messages.index')],['Redes sociais',$socialLinks,route('admin.social-links.index')]] as [$label,$count,$url])
        <a class="rounded-xl border border-green-900/10 bg-white p-5 shadow-sm transition hover:border-gold-600/40 hover:shadow-soft" href="{{ $url }}">
            <div class="flex items-center justify-between gap-4"><p class="font-semibold text-muted">{{ $label }}</p><p class="font-display text-3xl text-green-900">{{ $count }}</p></div>
        </a>
    @endforeach
</div>
@endsection
