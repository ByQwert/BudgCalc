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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
        <canvas id="myChart" width="400px" height="400px"></canvas>
        <script>
            var url = "{{ route('bills/chart') }}";
            var Days = new Array();
            var Labels = new Array();
            var Sum = new Array();
            $(document).ready(function(){
                $.get(url, function(response){
                    response.forEach(function(data){
                        Days.push(data.date);
                        Sum.push(data.sum);
                    });
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels:Days,
                            datasets: [{
                                label: 'Infosys Price',
                                data: Sum,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });
                });
            });
        </script>
    </div>
@endsection