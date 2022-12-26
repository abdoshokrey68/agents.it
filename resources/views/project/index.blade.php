@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                {{ __('All Projects') }}
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('project.create') }}" class="btn btn-primary col-md-12">
                                    New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $project->name }}</td>
                                        <td> {{ substr($project->details, 0, 50) }}
                                            {{ strlen($project->details) > 50 ? '...' : '' }} </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="{{ route('project.edit', $project->id) }}"
                                                        class="btn btn-success col-md-12">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>

                                                <div class="col-md-6">
                                                    <a href="{{ route('project.delete', $project->id) }}"
                                                        class="btn btn-danger col-md-12">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
