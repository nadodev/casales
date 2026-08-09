@extends('layouts.admin')
@section('title', 'Mensagens de contato')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div><span class="eyebrow">Atendimento</span><h1 class="text-5xl">Mensagens</h1></div>
    <div class="rounded-full bg-white px-4 py-2 text-sm font-semibold shadow-sm"><span class="text-gold-600">{{ $unreadMessages }}</span> não {{ $unreadMessages === 1 ? 'lida' : 'lidas' }}</div>
</div>

<div class="mt-8 overflow-hidden rounded-2xl border border-green-900/10 bg-white shadow-soft">
    <div class="hidden grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)_130px] gap-4 bg-beige-100 px-5 py-3 text-xs font-bold uppercase tracking-wider text-muted md:grid">
        <span>Remetente</span><span>Assunto e mensagem</span><span class="text-right">Recebida</span>
    </div>
    <div class="divide-y divide-green-900/10">
        @forelse($items as $item)
            <a class="group relative grid gap-2 px-5 py-4 transition hover:bg-beige-100 md:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)_130px] md:items-center md:gap-4 {{ $item->read_at ? 'bg-white' : 'bg-amber-50/50' }}" href="{{ route('admin.contact-messages.show', $item) }}">
                @if(!$item->read_at)<span class="absolute inset-y-0 left-0 w-1 bg-gold-600" aria-label="Não lida"></span>@endif
                <div class="min-w-0">
                    <div class="flex items-center gap-2"><strong class="truncate">{{ $item->name }}</strong>@if(!$item->read_at)<span class="rounded-full bg-gold-600 px-2 py-0.5 text-[10px] font-bold uppercase text-white">Nova</span>@endif</div>
                    <p class="truncate text-sm text-muted">{{ $item->email }}@if($item->phone) · {{ $item->phone }}@endif</p>
                </div>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-ink">{{ $item->subject ?: 'Contato pelo site' }}</p>
                    <p class="mt-1 truncate text-sm text-muted">{{ Str::limit($item->message, 100) }}</p>
                </div>
                <time class="text-xs text-muted md:text-right" datetime="{{ $item->created_at->toIso8601String() }}">{{ $item->created_at->format('d/m/Y') }}<span class="md:block">{{ $item->created_at->format('H:i') }}</span></time>
            </a>
        @empty
            <p class="p-10 text-center text-muted">Nenhuma mensagem recebida.</p>
        @endforelse
    </div>
</div>

@if($items->hasPages())<div class="mt-6">{{ $items->onEachSide(1)->links() }}</div>@endif
@endsection
