@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Users') }}</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New User') }}
                    </a>
                </div>

                <div class="card-body">
                   

                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('users.index') }}">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="search" 
                                               placeholder="{{ __('messages.Search by name, phone, ID, address') }}" 
                                               value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="clas_id" class="form-control">
                                            <option value="">{{ __('messages.All Classes') }}</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" 
                                                        {{ request('clas_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="activate" class="form-control">
                                            <option value="">{{ __('messages.All Status') }}</option>
                                            <option value="1" {{ request('activate') === '1' ? 'selected' : '' }}>
                                                {{ __('messages.Active') }}
                                            </option>
                                            <option value="2" {{ request('activate') === '2' ? 'selected' : '' }}>
                                                {{ __('messages.Inactive') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline-secondary w-100" type="submit">
                                            {{ __('messages.Search') }}
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ route('users.index') }}" class="btn btn-outline-warning w-100">
                                            {{ __('messages.Reset') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Phone') }}</th>
                                        <th>{{ __('messages.Class') }}</th>
                                        <th>{{ __('messages.Annual Installment') }}</th>
                                        <th>{{ __('messages.Past Balance') }}</th>
                                        <th>{{ __('messages.Status') }}</th>
                                        <th>{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <strong>{{ $user->name }}</strong>
                                                @if($user->identity_number)
                                                    <br><small class="text-muted">{{ __('messages.ID') }}: {{ $user->identity_number }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->phone }}
                                                @if($user->phone_of_parent)
                                                    <br><small class="text-muted">{{ __('messages.Parent') }}: {{ $user->phone_of_parent }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->clas)
                                                    <span class="badge bg-info">{{ $user->clas->name }}</span>
                                                @else
                                                    <span class="text-muted">{{ __('messages.No Class') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($user->annual_installment, 2) }}</td>
                                            <td>
                                                @if($user->past_balance > 0)
                                                    <span class="text-danger">{{ number_format($user->past_balance, 2) }}</span>
                                                @else
                                                    <span class="text-success">{{ number_format($user->past_balance, 2) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="{{ $user->activation_badge_class }}">
                                                    {{ $user->activation_status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('users.show', $user) }}" 
                                                       class="btn btn-sm btn-info" title="{{ __('messages.View') }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('users.edit', $user) }}" 
                                                       class="btn btn-sm btn-warning" title="{{ __('messages.Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('users.toggle-activation', $user) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-sm {{ $user->activate == 1 ? 'btn-secondary' : 'btn-success' }}"
                                                                title="{{ $user->activate == 1 ? __('messages.Deactivate') : __('messages.Activate') }}">
                                                            <i class="fas {{ $user->activate == 1 ? 'fa-ban' : 'fa-check' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('users.destroy', $user) }}" 
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
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No users found') }}</p>
                            <a href="{{ route('users.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First User') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection