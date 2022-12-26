@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                {{ __('My Tasks') }}
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
                                    <th scope="col">Project </th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{ $task->name }}</td>
                                        <td>
                                            @if (strlen($task->details) > 0)
                                                {{ substr($task->details, 0, 50) }}
                                                {{ strlen($task->details) > 50 ? '...' : '' }}
                                            @else
                                                _______
                                            @endif
                                        </td>
                                        <td>
                                            {{ $task->project->name }}
                                        </td>
                                        <td>
                                            @if ($task->status === 1)
                                                <span class="text-success bold">
                                                    DONE
                                                </span>
                                            @else
                                                <span class="text-danger bold">
                                                    PENDING
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="d-flex m-auto">
                                                    <a @if ($task->status === 1) disabled @else  href="{{ route('member.task.edit', $task->id) }}" @endif
                                                        class="btn btn-success col-md-12 @if ($task->status === 1) disabled @endif ">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
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
