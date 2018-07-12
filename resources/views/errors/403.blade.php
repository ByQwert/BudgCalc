@extends('layouts.http_error')

@section('content')
{{ $exception->getMessage() }}
@endsection