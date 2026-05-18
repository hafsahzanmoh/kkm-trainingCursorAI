@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visitor Index') }}</div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->phone }}</td>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{{ $visitor->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{ route('visitors.show' , $visitor->id) }}" class="btn btn-primary">Show</a>
                                        <a href="{{ route('visitors.edit' , $visitor->id) }}" class="btn btn-success">Edit</a>
                                        <a
                                            onclick="return confirm('Are you sure you want to delete this visitor?')"
                                            href="{{ route('visitors.delete', $visitor->id) }}"
                                            class="btn btn-danger">Delete</a>

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