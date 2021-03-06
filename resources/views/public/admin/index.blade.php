@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a class="btn btn-primary" href="{{ route('admin.bills.index') }}">Bills</a>
                        <a class="btn btn-primary" href="{{ route('admin.users.index') }}">Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection