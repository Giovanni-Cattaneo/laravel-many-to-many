@extends('layouts.admin')

@section('content')
    <div class="bg-dark text-white">
        <div class="container">
            <h1>Modifica Il tuo progetto</h1>
        </div>
    </div>
    <div class="container py-3">
        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpId" placeholder="Inserisci il Titolo del Progetto"
                    value="{{ $project->title }}" />
                <small id="helpId" class="form-text text-muted">Help text</small>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type_id" class="form-label">Categories</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a category</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check d-flex gap-3">
                @foreach ($technologies as $technology)
                    @if ($errors->any())
                        <div class="mx-2">
                            <input name="technology_ids[]" class="form-check-input"
                                @error('technologies') is-invalid @enderror type="checkbox" value="{{ $technology->id }}"
                                id="technology-{{ $technology->id }}"
                                {{ in_array($technology->id, old('technology_ids', [])) ? 'checked' : '' }} />
                            <label class="form-check-label"
                                for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @else
                        <div class="mx-2">
                            <input name="technology_ids[]" class="form-check-input"
                                @error('technologies') is-invalid @enderror type="checkbox" value="{{ $technology->id }}"
                                id="technology-{{ $technology->id }}"
                                {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Img</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                    id="cover_image" aria-describedby="helpId" placeholder="Inserisci l'immagine del Progetto" />
                <small id="helpId" class="form-text text-muted">Help text</small>
                @error('cover_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Site Url</label>
                <input type="text" class="form-control @error('url_site') is-invalid @enderror" name="url_site"
                    id="url_site" aria-describedby="helpId" placeholder="Inserisci il Titolo del Progetto"
                    value="{{ $project->url_site }}" />
                <small id="helpId" class="form-text text-muted">Help text</small>
                @error('url_site')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Source Code Url</label>
                <input type="text" class="form-control @error('url_source_code') is-invalid @enderror"
                    name="url_source_code" id="url_source_code" aria-describedby="helpId"
                    placeholder="Inserisci il Titolo del Progetto" value="{{ $project->url_source_code }}" />
                <small id="helpId" class="form-text text-muted">Help text</small>
                @error('url_source_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="6">{{ $project->description }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Invia
            </button>


        </form>
    </div>
@endsection
