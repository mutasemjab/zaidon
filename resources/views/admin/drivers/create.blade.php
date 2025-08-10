@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('messages.Add New Driver') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('drivers.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        {{ __('messages.Driver Name') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           placeholder="{{ __('messages.Enter driver name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">
                                        {{ __('messages.Phone') }} <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone') }}" 
                                           placeholder="{{ __('messages.Enter phone number') }}" 
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="identity_number" class="form-label">
                                        {{ __('messages.Identity Number') }}
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('identity_number') is-invalid @enderror" 
                                           id="identity_number" 
                                           name="identity_number" 
                                           value="{{ old('identity_number') }}" 
                                           placeholder="{{ __('messages.Enter identity number') }}">
                                    @error('identity_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">
                                        {{ __('messages.Address') }}
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="3" 
                                              placeholder="{{ __('messages.Enter address') }}">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="salary" class="form-label">
                                        {{ __('messages.Salary') }}
                                    </label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('salary') is-invalid @enderror" 
                                           id="salary" 
                                           name="salary" 
                                           value="{{ old('salary') }}" 
                                           placeholder="{{ __('messages.Enter salary') }}">
                                    @error('salary')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('drivers.index') }}" class="btn btn-secondary">
                                {{ __('messages.Cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.Create Driver') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection