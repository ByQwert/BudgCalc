@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $bill->date }}</h2>
        <p>{{ $bill->sum }} BYN</p>
    </div>
@endsection