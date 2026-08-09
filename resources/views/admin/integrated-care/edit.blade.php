@extends('layouts.admin')
@section('title', 'Cuidado Integrado')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
    <div><span class="eyebrow">Página especial</span><h1 class="text-5xl">Cuidado Integrado</h1><p class="mt-3 text-muted">Edite o conteúdo e a apresentação da página pública.</p></div>
    <a class="btn-secondary" href="{{ route('integrated-care') }}" target="_blank">Visualizar página ↗</a>
</div>

<form class="admin-form mt-8" method="post" enctype="multipart/form-data" action="{{ route('admin.integrated-care.update') }}">
    @csrf @method('PUT')
    <fieldset class="grid gap-5"><legend class="mb-4 text-2xl font-semibold text-green-900">Abertura da página</legend>
        <label>Chamada curta<input class="field" name="hero_kicker" value="{{ old('hero_kicker', $item->hero_kicker ?: 'Cuidado Integrado') }}" required></label>
        <label>Título principal<input class="field" name="title" value="{{ old('title', $item->title) }}" required></label>
        <label>Texto de introdução<textarea class="field" rows="4" name="intro" required>{{ old('intro', $item->intro) }}</textarea></label>
        <label>Imagem de capa<input class="field" type="file" name="cover_image" accept="image/jpeg,image/png,image/webp">@if($item->cover_image_path)<span class="mt-2 block text-sm font-normal text-muted">Já existe uma imagem cadastrada. Envie outra somente para substituí-la.</span>@endif</label>
    </fieldset>

    <fieldset class="grid gap-5 border-t border-green-900/10 pt-7"><legend class="mb-4 text-2xl font-semibold text-green-900">Como funciona</legend>
        <label>Título da seção<input class="field" name="how_title" value="{{ old('how_title', $item->how_title ?: 'Como funciona') }}" required></label>
        <label>Etapas <span class="text-sm font-normal text-muted">(uma por linha, no formato Título | Texto)</span><textarea class="field" rows="7" name="steps_text" required>{{ old('steps_text', collect($item->steps)->map(fn($step) => ($step['title'] ?? '').' | '.($step['text'] ?? ''))->implode("\n")) }}</textarea></label>
    </fieldset>

    <fieldset class="grid gap-5 border-t border-green-900/10 pt-7"><legend class="mb-4 text-2xl font-semibold text-green-900">Diferenciais</legend>
        <div class="grid gap-5 md:grid-cols-2"><label>Chamada curta<input class="field" name="section_kicker" value="{{ old('section_kicker', $item->section_kicker) }}"></label><label>Título da seção<input class="field" name="section_title" value="{{ old('section_title', $item->section_title) }}" required></label></div>
        <label>Introdução da seção<textarea class="field" rows="3" name="section_intro">{{ old('section_intro', $item->section_intro) }}</textarea></label>
        <label>Diferenciais <span class="text-sm font-normal text-muted">(um por linha, no formato Título | Texto)</span><textarea class="field" rows="7" name="benefits_text" required>{{ old('benefits_text', collect($item->benefits)->map(fn($benefit) => ($benefit['title'] ?? '').' | '.($benefit['text'] ?? ''))->implode("\n")) }}</textarea></label>
    </fieldset>

    <fieldset class="grid gap-5 border-t border-green-900/10 pt-7"><legend class="mb-4 text-2xl font-semibold text-green-900">Chamada final e busca</legend>
        <label>Título final<input class="field" name="cta_title" value="{{ old('cta_title', $item->cta_title) }}" required></label>
        <label>Texto final<textarea class="field" rows="3" name="cta_text">{{ old('cta_text', $item->cta_text) }}</textarea></label>
        <label>Texto do botão<input class="field" name="cta_label" value="{{ old('cta_label', $item->cta_label ?: 'Agendar uma avaliação') }}" required></label>
        <label>Descrição para mecanismos de busca<textarea class="field" rows="3" maxlength="320" name="seo_description">{{ old('seo_description', $item->seo_description) }}</textarea></label>
    </fieldset>

    <label class="flex items-center gap-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $item->exists ? $item->is_active : true))> Página publicada</label>
    <button class="btn-primary w-fit">Salvar página</button>
</form>
@endsection
