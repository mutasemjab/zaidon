@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ __('messages.Expenses') }}</h4>
                        <small class="text-muted">
                            {{ __('messages.Total') }}: {{ $totalCount }} | 
                            {{ __('messages.Amount') }}: {{ number_format($totalAmount, 2) }}
                        </small>
                    </div>
                    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New Expense') }}
                    </a>
                </div>

                <div class="card-body">
                   

                    <!-- Advanced Filters -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('expenses.index') }}">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="search" 
                                               placeholder="{{ __('messages.Search expenses') }}" 
                                               value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <select name="type_expenses_id" class="form-control">
                                            <option value="">{{ __('messages.All Types') }}</option>
                                            @foreach($typeExpenses as $type)
                                                <option value="{{ $type->id }}" 
                                                        {{ request('type_expenses_id') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="person_type" class="form-control">
                                            <option value="">{{ __('messages.All Persons') }}</option>
                                            <option value="user" {{ request('person_type') === 'user' ? 'selected' : '' }}>
                                                {{ __('messages.Students') }}
                                            </option>
                                            <option value="teacher" {{ request('person_type') === 'teacher' ? 'selected' : '' }}>
                                                {{ __('messages.Teachers') }}
                                            </option>
                                            <option value="driver" {{ request('person_type') === 'driver' ? 'selected' : '' }}>
                                                {{ __('messages.Drivers') }}
                                            </option>
                                            <option value="general" {{ request('person_type') === 'general' ? 'selected' : '' }}>
                                                {{ __('messages.General') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="date_from" 
                                               value="{{ request('date_from') }}" 
                                               placeholder="{{ __('messages.From Date') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" class="form-control" name="date_to" 
                                               value="{{ request('date_to') }}" 
                                               placeholder="{{ __('messages.To Date') }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-outline-secondary w-100" type="submit">
                                            {{ __('messages.Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($expenses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Amount') }}</th>
                                        <th>{{ __('messages.Type') }}</th>
                                        <th>{{ __('messages.Related Person') }}</th>
                                        <th>{{ __('messages.Note') }}</th>
                                        <th>{{ __('messages.Date') }}</th>
                                        <th>{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $expense)
                                        <tr>
                                            <td>{{ $expense->id }}</td>
                                            <td>
                                                <span class="badge bg-danger fs-6">
                                                    {{ number_format($expense->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $expense->typeExpense->name }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $expense->related_person }}</span>
                                            </td>
                                            <td>
                                                @if($expense->note)
                                                    {{ Str::limit($expense->note, 50) }}
                                                @else
                                                    <span class="text-muted">{{ __('messages.No note') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $expense->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                   
                                                    <a href="{{ route('expenses.edit', $expense) }}" 
                                                       class="btn btn-sm btn-warning" title="{{ __('messages.Edit') }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('expenses.destroy', $expense) }}" 
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
                            {{ $expenses->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No expenses found') }}</p>
                            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First Expense') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection