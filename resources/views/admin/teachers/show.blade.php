@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Teacher Details') }} - {{ $teacher->name }}</h4>
                    <div>
                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning btn-sm">
                            {{ __('messages.Edit') }}
                        </a>
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('messages.Back to List') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.ID') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->id }}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Name') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->name }}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Phone') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            <a href="tel:{{ $teacher->phone }}" class="text-decoration-none">
                                {{ $teacher->phone }}
                            </a>
                        </div>
                    </div>
                    <hr>

                    @if($teacher->identity_number)
                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Identity Number') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->identity_number }}
                        </div>
                    </div>
                    <hr>
                    @endif

                    @if($teacher->address)
                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Address') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->address }}
                        </div>
                    </div>
                    <hr>
                    @endif

                    @if($teacher->salary)
                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Salary') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            <span class="badge bg-success fs-6">
                                {{ number_format($teacher->salary, 2) }}
                            </span>
                        </div>
                    </div>
                    <hr>
                    @endif

                    @if($teacher->note)
                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Note') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->note }}
                        </div>
                    </div>
                    <hr>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Created At') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->created_at->format('Y-m-d H:i:s') }}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <strong>{{ __('messages.Updated At') }}:</strong>
                        </div>
                        <div class="col-md-9">
                            {{ $teacher->updated_at->format('Y-m-d H:i:s') }}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <hr class="mt-4">
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('messages.Are you sure?') }}')">
                                {{ __('messages.Delete Teacher') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection