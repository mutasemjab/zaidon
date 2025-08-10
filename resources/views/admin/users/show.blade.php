@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.User Details') }} - {{ $user->name }}</h4>
                    <div>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm">
                            {{ __('messages.Edit') }}
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('messages.Back to List') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Student Information -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-primary border-bottom pb-2">{{ __('messages.Student Information') }}</h5>
                            
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.ID') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        {{ $user->id }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Name') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        {{ $user->name }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Phone') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        <a href="tel:{{ $user->phone }}" class="text-decoration-none">
                                            {{ $user->phone }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @if($user->identity_number)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Identity Number') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        {{ $user->identity_number }}
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($user->address)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Address') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        {{ $user->address }}
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Class') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        @if($user->clas)
                                            <span class="badge bg-info fs-6">{{ $user->clas->name }}</span>
                                        @else
                                            <span class="text-muted">{{ __('messages.No Class') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Status') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        <span class="{{ $user->activation_badge_class }} fs-6">
                                            {{ $user->activation_status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Parent & Financial Information -->
                        <div class="col-md-6">
                            <h5 class="mb-3 text-success border-bottom pb-2">{{ __('messages.Parent Information') }}</h5>
                            
                            @if($user->name_of_parent)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Parent Name') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        {{ $user->name_of_parent }}
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($user->phone_of_parent)
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>{{ __('messages.Parent Phone') }}:</strong>
                                    </div>
                                    <div class="col-8">
                                        <a href="tel:{{ $user->phone_of_parent }}" class="text-decoration-none">
                                            {{ $user->phone_of_parent }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(!$user->name_of_parent && !$user->phone_of_parent)
                            <p class="text-muted">{{ __('messages.No parent information available') }}</p>
                            @endif

                            <h5 class="mb-3 mt-4 text-warning border-bottom pb-2">{{ __('messages.Financial Information') }}</h5>
                            
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('messages.Annual Installment') }}:</strong>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge bg-primary fs-6">
                                            {{ number_format($user->annual_installment, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('messages.Past Balance') }}:</strong>
                                    </div>
                                    <div class="col-6">
                                        @if($user->past_balance > 0)
                                            <span class="badge bg-danger fs-6">
                                                {{ number_format($user->past_balance, 2) }}
                                            </span>
                                        @elseif($user->past_balance < 0)
                                            <span class="badge bg-success fs-6">
                                                {{ number_format($user->past_balance, 2) }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary fs-6">
                                                {{ number_format($user->past_balance, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('messages.Total Amount') }}:</strong>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge bg-dark fs-6">
                                            {{ number_format($user->annual_installment + $user->past_balance, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3 mt-4 text-info border-bottom pb-2">{{ __('messages.System Information') }}</h5>
                            
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('messages.Created At') }}:</strong>
                                    </div>
                                    <div class="col-6">
                                        {{ $user->created_at->format('Y-m-d H:i:s') }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>{{ __('messages.Updated At') }}:</strong>
                                    </div>
                                    <div class="col-6">
                                        {{ $user->updated_at->format('Y-m-d H:i:s') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <hr class="mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <form action="{{ route('users.toggle-activation', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="btn {{ $user->activate == 1 ? 'btn-warning' : 'btn-success' }}">
                                    {{ $user->activate == 1 ? __('messages.Deactivate User') : __('messages.Activate User') }}
                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('{{ __('messages.Are you sure?') }}')">
                                    {{ __('messages.Delete User') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection