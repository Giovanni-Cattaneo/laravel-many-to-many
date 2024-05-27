@extends('layouts.admin')

@section('content')
    <div class="bg-dark text-white">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="">Portfolio</h1>
            <a name="" id="" class="btn btn-primary" href="{{ route('admin.projects.create') }}"
                role="button">Nuovo Progetto</a>

        </div>

    </div>
    <div class="container py-5">
        <h3>Lista Progetti:</h3>
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Cover Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Url Site</th>
                        <th scope="col">Url Source Code</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td><img src="{{ asset('storage/' . $project->cover_image) }}" alt="" width="100">
                            </td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->type ? $project->type->category : 'N/A' }}</td>
                            <td>{{ $project->url_site }}</td>
                            <td>{{ $project->url_source_code }}</td>
                            <td><a href="{{ route('admin.projects.show', $project) }}">Show</a> /
                                <a href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                                / <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                    Attention deleting: {{ $project->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">Sei sicuro di voler procedere all'eliminazione?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
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
                        <p>Chiedo scusa ma non ci sono progetti al momento</p>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
