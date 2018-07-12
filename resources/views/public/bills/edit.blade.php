@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="container">

        @include('partial.error')

        <div class="row">
            <div class="offset-md-4 col-md-4">

                <form method="POST" action="{{ route('bills.update', ['id' => $bill->id]) }}">

                    {{ csrf_field() }}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input class="form-control" type="text" id="date" name="date" value="{{ $bill->date }}">
                    </div>

                    <div class="form-group">
                        <label for="sum">Sum</label>
                        <input class="form-control" type="text" id="sum" name="sum" value="{{ $bill->sum }}">
                    </div>

                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select class="custom-select" name="tag">
                            @foreach($tags as $tag)
                                @if($bill->tag_id == $tag->id)
                                    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                @else
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <input type="submit" value="Submit" class="btn btn-success">

                </form>

            </div>
        </div>
    </div>
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script>
        $('#date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>
@endsection
