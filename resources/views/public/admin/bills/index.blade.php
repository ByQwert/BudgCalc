@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partial.success')

        {{--<p>Total: {{ $totalSum }}</p>--}}

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Owner</th>
                <th>Date</th>
                <th>Sum</th>
                <th>Tag</th>
                <th>Operations</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @if (count($bills) && !is_null($bills))
                @foreach($bills as $bill)
                    <tr>
                        <td>
                            <a class="btn btn-link" href="{{ route('admin.bills.show', ['id' => $bill->id]) }}">
                                {{ ++$billCounter }}
                            </a>
                        </td>
                        <td>{{ $bill->user->name }}</td>
                        <td>{{ $bill->date }}</td>
                        <td>{{ $bill->sum }}</td>
                        <td>
                            {{ $bill->tag->name}}
                        </td>
                        <td>
                            <a class="btn btn-default" href="{{ route('admin.bills.edit', ['id' => $bill->id]) }}">Edit</a>
                        </td>
                        <td>
                            <form method="post" action="{{ route('admin.bills.destroy', ['id' => $bill->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection