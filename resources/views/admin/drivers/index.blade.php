{{-- resources/views/drivers/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Drivers') }}</h4>
                    <a href="{{ route('drivers.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New Driver') }}
                    </a>
                </div>

                <div class="card-body">
                  

                    <!-- Search Form -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('drivers.index') }}">
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
                                        <a href="{{ route('drivers.index') }}" class="btn btn-outline-warning w-100">
                                            {{ __('messages.Reset') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($drivers->count() > 0)
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
                                    @foreach($drivers as $driver)
                                        <tr>
                                            <td>{{ $driver->id }}</td>
                                            <td>
                                                <strong>{{ $driver->name }}</strong>
                                                @if($driver->address)
                                                    <br><small class="text-muted">{{ $driver->address }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="tel:{{ $driver->phone }}" class="text-decoration-none">
                                                    {{ $driver->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $driver->identity_number ?? __('messages.Not specified') }}
                                            </td>
                                            <td>
                                                @if($driver->salary)
                                                    <span class="badge bg-success">{{ number_format($driver->salary, 2) }}</span>
                                                @else
                                                    <span class="text-muted">{{ __('messages.Not specified') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $driver->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('drivers.show', $driver) }}" 
                                                       class="btn btn-sm btn-info" title="{{ __('messages.View') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('drivers.edit', $driver) }}" 
                                                       class="btn btn-sm btn-warning" title="{{ __('messages.Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('drivers.destroy', $driver) }}" 
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
                            {{ $drivers->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No drivers found') }}</p>
                            <a href="{{ route('drivers.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First Driver') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

