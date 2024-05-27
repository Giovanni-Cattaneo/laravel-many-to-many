@extends('layouts.admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-dark text-white">
        <div class="container">
            <h1>Nuova Categoria</h1>
        </div>
    </div>
    <div class="container py-3">
        <form action="{{ route('admin.types.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" name="category"
                    id="category" aria-describedby="helpId" placeholder="Inserisci il Titolo del Progetto"
                    value="{{ old('category') }}" />
                <small id="helpId" class="form-text text-muted">Help text</small>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                Invia
            </button>


        </form>
    </div>
@endsection
