@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success my-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Create option values for ') }} {{ $template->name }} {{ __('template') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('create.option') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$template->id}}" />
                        <div class="form-group mb-3">
                            <label for="option" class="form-label">Option value</label>
                            <input type="text" id="option" class="form-control" name="option" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection