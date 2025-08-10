@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('messages.Add New Expense') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('expenses.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">{{ __('messages.Expense Information') }}</h5>
                                
                                <div class="mb-3">
                                    <label for="amount" class="form-label">
                                        {{ __('messages.Amount') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" 
                                           name="amount" 
                                           value="{{ old('amount') }}" 
                                           placeholder="{{ __('messages.Enter amount') }}" 
                                           required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="type_expenses_id" class="form-label">
                                        {{ __('messages.Expense Type') }} <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control @error('type_expenses_id') is-invalid @enderror" 
                                            id="type_expenses_id" 
                                            name="type_expenses_id" 
                                            required>
                                        <option value="">{{ __('messages.Select Expense Type') }}</option>
                                        @foreach($typeExpenses as $type)
                                            <option value="{{ $type->id }}" 
                                                    {{ old('type_expenses_id') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_expenses_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="note" class="form-label">
                                        {{ __('messages.Note') }}
                                    </label>
                                    <textarea class="form-control @error('note') is-invalid @enderror" 
                                              id="note" 
                                              name="note" 
                                              rows="4" 
                                              placeholder="{{ __('messages.Enter note') }}">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="mb-3 text-success">{{ __('messages.Related Person') }} ({{ __('messages.Optional') }})</h5>
                                <p class="text-muted small">{{ __('messages.Select one person type or leave empty for general expense') }}</p>
                                
                                @error('person')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="user_id" class="form-label">
                                        {{ __('messages.Student') }}
                                    </label>
                                    <select class="form-control @error('user_id') is-invalid @enderror" 
                                            id="user_id" 
                                            name="user_id">
                                        <option value="">{{ __('messages.Select Student') }}</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" 
                                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="teacher_id" class="form-label">
                                        {{ __('messages.Teacher') }}
                                    </label>
                                    <select class="form-control @error('teacher_id') is-invalid @enderror" 
                                            id="teacher_id" 
                                            name="teacher_id">
                                        <option value="">{{ __('messages.Select Teacher') }}</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" 
                                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }} - {{ $teacher->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="driver_id" class="form-label">
                                        {{ __('messages.Driver') }}
                                    </label>
                                    <select class="form-control @error('driver_id') is-invalid @enderror" 
                                            id="driver_id" 
                                            name="driver_id">
                                        <option value="">{{ __('messages.Select Driver') }}</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" 
                                                    {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }} - {{ $driver->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('expenses.index') }}" class="btn btn-secondary">
                                {{ __('messages.Cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.Create Expense') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Ensure only one person type is selected
document.addEventListener('DOMContentLoaded', function() {
    const selects = ['user_id', 'teacher_id', 'driver_id'];
    
    selects.forEach(selectId => {
        document.getElementById(selectId).addEventListener('change', function() {
            if (this.value) {
                selects.forEach(otherId => {
                    if (otherId !== selectId) {
                        document.getElementById(otherId).value = '';
                    }
                });
            }
        });
    });
});
</script>
@endsection