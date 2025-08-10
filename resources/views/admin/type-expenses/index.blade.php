{{-- resources/views/type-expenses/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Expense Types') }}</h4>
                    <a href="{{ route('type-expenses.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New Expense Type') }}
                    </a>
                </div>

                <div class="card-body">
                

                    <!-- Search Form -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('type-expenses.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" 
                                       placeholder="{{ __('messages.Search') }}" 
                                       value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    {{ __('messages.Search') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    @if($typeExpenses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Expenses Count') }}</th>
                                        <th>{{ __('messages.Created At') }}</th>
                                        <th>{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($typeExpenses as $typeExpense)
                                        <tr>
                                            <td>{{ $typeExpense->id }}</td>
                                            <td>{{ $typeExpense->name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ $typeExpense->expenses_count }}</span>
                                            </td>
                                            <td>{{ $typeExpense->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('type-expenses.show', $typeExpense) }}" 
                                                       class="btn btn-sm btn-info">
                                                        {{ __('messages.View') }}
                                                    </a>
                                                    <a href="{{ route('type-expenses.edit', $typeExpense) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        {{ __('messages.Edit') }}
                                                    </a>
                                                    <form action="{{ route('type-expenses.destroy', $typeExpense) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('{{ __('messages.Are you sure?') }}')">
                                                            {{ __('messages.Delete') }}
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
                            {{ $typeExpenses->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No expense types found') }}</p>
                            <a href="{{ route('type-expenses.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First Expense Type') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
