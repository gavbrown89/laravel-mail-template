@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Templates') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Template</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $i)
                                <tr>
                                    <td class="align-middle">{{ ucfirst($i->name) }}</td>
                                    <td class="align-middle"><a href="{{ route('home.template', ['id' => $i->id]) }}" class="btn btn-primary">Edit</a></td>
                                    <td class="align-middle"><a href="{{ route('home.options', ['id' => $i->id]) }}" class="btn btn-secondary">Options</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
