@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="container">

        @include('partial.error')

        <div class="row">
            <div class="offset-md-4 col-md-4">

                <form method="POST" action="{{ route('bills.store') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="date">Date</label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="date" name="date">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="sum">Sum</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="sum" name="sum">
                            <div class="input-group-append">
                                <span class="input-group-text">BYN</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <div class="input-group">
                            <select class="custom-select" name="tag">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
