@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>{{ __('messages.Classes') }}</h4>
                    <a href="{{ route('clas.create') }}" class="btn btn-primary">
                        {{ __('messages.Add New Class') }}
                    </a>
                </div>

                <div class="card-body">
          
                    <!-- Search Form -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('clas.index') }}">
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

                    @if($clas->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('messages.ID') }}</th>
                                        <th>{{ __('messages.Name') }}</th>
                                        <th>{{ __('messages.Created At') }}</th>
                                        <th>{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clas as $class)
                                        <tr>
                                            <td>{{ $class->id }}</td>
                                            <td>{{ $class->name }}</td>
                                            <td>{{ $class->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('clas.show', $class) }}" 
                                                       class="btn btn-sm btn-info">
                                                        {{ __('messages.View') }}
                                                    </a>
                                                    <a href="{{ route('clas.edit', $class) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        {{ __('messages.Edit') }}
                                                    </a>
                                                    <form action="{{ route('clas.destroy', $class) }}" 
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
                            {{ $clas->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">{{ __('messages.No classes found') }}</p>
                            <a href="{{ route('clas.create') }}" class="btn btn-primary">
                                {{ __('messages.Add First Class') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection