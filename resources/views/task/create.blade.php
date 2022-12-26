@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create Task') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="">
                                <p><strong>Opps Something went wrong</strong></p>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('task.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Details</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option>
                                        Select Any Project
                                    </option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            @if (count($errors) > 0) {{ old('project_id') == $project->id ? 'selected' : '' }} @endif>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="user_id" class="form-label">Assign To</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option>
                                        Select Any Member
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if (count($errors) > 0) {{ old('user_id') == $user->id ? 'selected' : '' }} @endif>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"> Create </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
