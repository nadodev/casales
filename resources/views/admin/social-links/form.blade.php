@extends('layouts.admin')
@section('title', $item->exists ? 'Editar rede social' : 'Nova rede social')
@section('content')
<h1 class="text-5xl">{{ $item->exists ? 'Editar rede social' : 'Nova rede social' }}</h1>
<form class="admin-form mt-8" method="post" action="{{ $item->exists ? route('admin.social-links.update', $item) : route('admin.social-links.store') }}">
    @csrf
    @if($item->exists) @method('PUT') @endif
    <div class="grid gap-5 md:grid-cols-2">
        <label>Plataforma
            <input class="field" name="platform" placeholder="Instagram ou WhatsApp" value="{{ old('platform', $item->platform) }}" required>
            @error('platform')<span class="error">{{ $message }}</span>@enderror
        </label>
        <label>Nome acessível
            <input class="field" name="label" placeholder="Instagram" value="{{ old('label', $item->label) }}" required>
            @error('label')<span class="error">{{ $message }}</span>@enderror
        </label>
        <label class="md:col-span-2">Número do WhatsApp
            <input class="field" name="phone" inputmode="tel" placeholder="551934242812" value="{{ old('phone', $item->phone) }}">
            <span class="mt-2 block text-sm font-normal text-muted">Preencha somente para WhatsApp, com código do país e DDD. O link será criado automaticamente.</span>
            @error('phone')<span class="error">{{ $message }}</span>@enderror
        </label>
        <label class="md:col-span-2">URL da rede social
            <input class="field" type="url" name="url" placeholder="https://..." value="{{ old('url', $item->url) }}">
            <span class="mt-2 block text-sm font-normal text-muted">Obrigatória para as outras redes. No WhatsApp, use o campo de número acima.</span>
            @error('url')<span class="error">{{ $message }}</span>@enderror
        </label>
        <label>Ordem
            <input class="field" type="number" min="0" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
        </label>
    </div>
    <label class="flex items-center gap-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->exists ? $item->is_active : true))> Publicado no site</label>
    <div class="flex gap-3"><button class="btn-primary">Salvar</button><a class="btn-secondary" href="{{ route('admin.social-links.index') }}">Cancelar</a></div>
</form>
@endsection
