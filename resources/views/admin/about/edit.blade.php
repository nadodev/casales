@extends('layouts.admin')
@section('title','Nossa História')
@section('content')
<h1 class="text-5xl">Nossa História</h1><p class="mt-3 text-muted">Edite a trajetória da empresa e as fotos exibidas no site.</p>
<form class="admin-form mt-8" method="post" enctype="multipart/form-data" action="{{ route('admin.about.update') }}">@csrf @method('PUT')
<label>Título<input class="field" name="title" value="{{ old('title',$item->title ?: 'Nossa história') }}" required></label>
<label>Subtítulo<input class="field" name="subtitle" value="{{ old('subtitle',$item->subtitle) }}"></label>
<label>História da empresa<textarea class="field" rows="12" name="story" required>{{ old('story',$item->story) }}</textarea></label>
<div class="grid gap-5 md:grid-cols-2"><label>Título do destaque<input class="field" name="highlight_title" value="{{ old('highlight_title',$item->highlight_title) }}"></label><label>Texto do destaque<textarea class="field" rows="4" name="highlight_text">{{ old('highlight_text',$item->highlight_text) }}</textarea></label></div>
<label>Imagem de capa<input class="field" type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"></label>
<fieldset><legend class="font-semibold">Adicionar fotos à galeria</legend><div class="mt-3 grid gap-4 md:grid-cols-2"><label>Fotos<input class="field" type="file" name="gallery[]" multiple accept="image/jpeg,image/png,image/webp"></label><label>Legenda da primeira foto<input class="field" name="captions[0]"></label></div></fieldset>
<label class="flex items-center gap-3"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$item->exists?$item->is_active:true))> Página publicada</label><button class="btn-primary w-fit">Salvar página</button></form>
@if($item->exists && $item->photos->isNotEmpty())<h2 class="mt-12 text-3xl">Fotos cadastradas</h2><div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach($item->photos as $photo)<div class="card p-3"><img src="{{ Storage::url($photo->image_path) }}" alt="" class="aspect-[4/3] w-full rounded-xl object-cover"><p class="mt-3 text-sm">{{ $photo->caption }}</p><form class="mt-3" method="post" action="{{ route('admin.about.photos.destroy',[$item,$photo->id]) }}">@csrf @method('DELETE')<button class="text-sm font-bold text-red-700" onclick="return confirm('Remover esta foto?')">Remover</button></form></div>@endforeach</div>@endif
@endsection
