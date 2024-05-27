@extends('layouts.admin')

@section('content')
    <div class="bg-dark text-white">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="">Portfolio</h1>
            <a name="" id="" class="btn btn-primary" href="{{ route('admin.types.create') }}"
                role="button">Nuova Categoria</a>

        </div>

    </div>
    <div class="container py-5">
        <h3>Categorie:</h3>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($types as $type)
                        <tr class="">
                            <td scope="row">{{ $type->id }}</td>
                            <td>{{ $type->category }}</td>
                            <td><a href="{{ route('admin.types.show', $type) }}">Show</a> /
                                <a href="{{ route('admin.types.edit', $type) }}">Edit</a>
                                / <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $type->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $type->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                    Attention deleting: {{ $type->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">Sei sicuro di voler procedere all'eliminazione?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.types.destroy', $type) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <p>Chiedo scusa ma non ci sono categorie al momento</p>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
