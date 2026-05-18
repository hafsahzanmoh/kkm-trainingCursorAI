@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Visitor Create</h1>
                </div>
                <div class="card-body">
                  
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" class="form-control" value="{{  $visitor->name }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                            <div class="col-md-6">
                                <input type="text" id="phone" name="phone" class="form-control" value="{{  $visitor->phone }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" revalue="{{  $visitor->email }}" readonly>
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
