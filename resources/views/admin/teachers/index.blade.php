@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Teachers') }}</h4>
                    <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New Teacher') }}
                    </a>
                </div>

                <div class="card-body">
             

                    <!-- Search Form -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('teachers.index') }}">
                                <div class="row g-2">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="search" 
                                               placeholder="{{ __('messages.Search by name, phone, ID, address') }}" 
                                               value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-outline-secondary w-100" type="submit">
                                            {{ __('messages.Search') }}
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-warning w-100">
                                            {{ __('messages.Reset') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($teachers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Phone') }}</th>
                                        <th>{{ __('messages.Identity Number') }}</th>
                                        <th>{{ __('messages.Salary') }}</th>
                                        <th>{{ __('messages.Created At') }}</th>
                                        <th>{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>
                                                <strong>{{ $teacher->name }}</strong>
                                                @if($teacher->address)
                                                    <br><small class="text-muted">{{ $teacher->address }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="tel:{{ $teacher->phone }}" class="text-decoration-none">
                                                    {{ $teacher->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $teacher->identity_number ?? __('messages.Not specified') }}
                                            </td>
                                            <td>
                                                @if($teacher->salary)
                                                    <span class="badge bg-success">{{ number_format($teacher->salary, 2) }}</span>
                                                @else
                                                    <span class="text-muted">{{ __('messages.Not specified') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $teacher->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('teachers.show', $teacher) }}" 
                                                       class="btn btn-sm btn-info" title="{{ __('messages.View') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('teachers.edit', $teacher) }}" 
                                                       class="btn btn-sm btn-warning" title="{{ __('messages.Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('teachers.destroy', $teacher) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('{{ __('messages.Are you sure?') }}')"
                                                                title="{{ __('messages.Delete') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $teachers->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No teachers found') }}</p>
                            <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First Teacher') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection