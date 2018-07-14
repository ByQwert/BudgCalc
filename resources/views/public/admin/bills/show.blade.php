@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                {{ $bill->user->name }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $bill->tag->name }}</h5>
                <p class="card-text">{{ $bill->sum }} BYN</p>
            </div>
            <div class="card-footer text-muted">
                {{ $bill->date }}
            </div>
        </div>
    </div>
@endsection