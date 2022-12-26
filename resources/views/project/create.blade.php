@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{ __('Create Project') }}
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
                        <form action="{{ route('project.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="details" class="form-label">Details</label>
                                <textarea name="details" id="details" cols="30" rows="10" class="form-control">{{ old('details') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"> Create </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
