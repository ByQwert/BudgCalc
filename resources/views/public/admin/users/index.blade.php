@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partial.success')

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date created</th>
                <th># of bills</th>
            </tr>
            </thead>
            <tbody>
            @if (count($users) && !is_null($users))
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{--<a class="btn btn-link" href="{{ route('admin.users.show', ['id' => $user->id]) }}">--}}
                            {{ ++$userCounter }}
                            {{--</a>--}}
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            {{ count($user->bills) }}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection