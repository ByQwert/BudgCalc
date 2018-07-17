@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partial.success')

        <p><a class="btn btn-success" href="{{ route('bills.create') }}">Create</a></p>
        <p>Total: {{ $totalSum }}</p>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
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
                                <a class="btn btn-link" href="{{ route('bills.show', ['id' => $bill->id]) }}">
                                    {{ ++$billCounter }}
                                </a>
                            </td>
                            <td>{{ $bill->date }}</td>
                            <td>{{ $bill->sum }}</td>
                            <td>
                                {{ $bill->tag->name}}
                            </td>
                            <td>
                                <a class="btn btn-default" href="{{ route('bills.edit', ['id' => $bill->id]) }}">Edit</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route('bills.destroy', ['id' => $bill->id]) }}">
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
        <script>
            function random_rgba() {
                var o = Math.round, r = Math.random, s = 255;
                return 'rgb(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ')';
            }
        </script>
        <div class="row">
            <div class="col-md-6">
                <canvas id="fullDateChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="tagChart"></canvas>
            </div>
        </div>
        <div class="row">

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        <script>
            var fullDateUrl = "{{ route('fullDate') }}";
            var Days = new Array();
            var fullDateSums = new Array();
            var fullDateColors = [];
            $(document).ready(function(){
                $.get(fullDateUrl, function(response){
                    response.forEach(function(data){
                        Days.push(data.date);
                        fullDateSums.push(data.sum);
                        fullDateColors.push(random_rgba());
                    });
                    var ctx = document.getElementById("fullDateChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:Days,
                            datasets: [{
                                label: 'Date stats',
                                data: fullDateSums,
                                borderWidth: 1,
                                backgroundColor: fullDateColors
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            },
                        }
                    });
                });
            });
        </script>
        <script>
            var tagUrl = "{{ route('tag') }}";
            var Tags = new Array();
            var tagSums = new Array();
            var tagColors = [];
            $(document).ready(function() {
                $.get(tagUrl, function (response) {
                    response.forEach(function (data) {
                        Tags.push(data.tag);
                        tagSums.push(data.sum);
                        tagColors.push(random_rgba());
                    });
                    var ctx = document.getElementById("tagChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels:Tags,
                            datasets: [{
                                label: 'Tag stats',
                                data: tagSums,
                                borderWidth: 1,
                                backgroundColor: tagColors
                            }]
                        },
                    });
                });
            });
        </script>
    </div>
@endsection