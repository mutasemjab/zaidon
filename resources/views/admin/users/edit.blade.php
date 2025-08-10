@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('messages.Edit User') }} - {{ $user->name }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Student Information -->
                            <div class="col-md-6">
                                <h5 class="mb-3 text-primary">{{ __('messages.Student Information') }}</h5>
                                
                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        {{ __('messages.Address') }}
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="3" 
                                              placeholder="{{ __('messages.Enter address') }}">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="clas_id" class="form-label">
                                        {{ __('messages.Class') }}
                                    </label>
                                    <select class="form-control @error('clas_id') is-invalid @enderror" 
                                            id="clas_id" 
                                            name="clas_id">
                                        <option value="">{{ __('messages.Select Class') }}</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}" 
                                                    {{ old('clas_id', $user->clas_id) == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('clas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Parent Information & Settings -->
                            <div class="col-md-6">
                                <h5 class="mb-3 text-success">{{ __('messages.Parent Information') }}</h5>
                                
                                <div class="mb-3">
                                    <label for="name_of_parent" class="form-label">
                                        {{ __('messages.Parent Name') }}
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name_of_parent') is-invalid @enderror" 
                                           id="name_of_parent" 
                                           name="name_of_parent" 
                                           value="{{ old('name_of_parent', $user->name_of_parent) }}" 
                                           placeholder="{{ __('messages.Enter parent name') }}">
                                    @error('name_of_parent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone_of_parent" class="form-label">
                                        {{ __('messages.Parent Phone') }}
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('phone_of_parent') is-invalid @enderror" 
                                           id="phone_of_parent" 
                                           name="phone_of_parent" 
                                           value="{{ old('phone_of_parent', $user->phone_of_parent) }}" 
                                           placeholder="{{ __('messages.Enter parent phone') }}">
                                    @error('phone_of_parent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="mb-3 text-warning">{{ __('messages.Financial Information') }}</h5>

                                <div class="mb-3">
                                    <label for="annual_installment" class="form-label">
                                        {{ __('messages.Annual Installment') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('annual_installment') is-invalid @enderror" 
                                           id="annual_installment" 
                                           name="annual_installment" 
                                           value="{{ old('annual_installment', $user->annual_installment) }}" 
                                           placeholder="{{ __('messages.Enter annual installment') }}" 
                                           required>
                                    @error('annual_installment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="past_balance" class="form-label">
                                        {{ __('messages.Past Balance') }}
                                    </label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('past_balance') is-invalid @enderror" 
                                           id="past_balance" 
                                           name="past_balance" 
                                           value="{{ old('past_balance', $user->past_balance) }}" 
                                           placeholder="{{ __('messages.Enter past balance') }}">
                                    @error('past_balance')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="activate" class="form-label">
                                        {{ __('messages.Status') }} <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control @error('activate') is-invalid @enderror" 
                                            id="activate" 
                                            name="activate" 
                                            required>
                                        <option value="">{{ __('messages.Select Status') }}</option>
                                        <option value="1" {{ old('activate', $user->activate) == '1' ? 'selected' : '' }}>
                                            {{ __('messages.Active') }}
                                        </option>
                                        <option value="2" {{ old('activate', $user->activate) == '2' ? 'selected' : '' }}>
                                            {{ __('messages.Inactive') }}
                                        </option>
                                    </select>
                                    @error('activate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                {{ __('messages.Cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.Update User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection