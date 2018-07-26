@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partial.success')

        <p><a class="btn btn-success" href="{{ route('bills.create') }}">Create</a></p>
        <p>Total: {{ $totalSum }}</p>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    {{--<th>ID</th>--}}
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
                        <tr class="item{{ $bill->id }}" >
                            {{--<td>--}}
                                {{--<a class="btn btn-link" href="{{ route('bills.show', ['id' => $bill->id]) }}">--}}
                                    {{--{{ ++$billCounter }}--}}
                                {{--</a>--}}
                            {{--</td>--}}
                            <td>{{ $bill->date }}</td>
                            <td>{{ $bill->sum }}</td>
                            <td>
                                {{ $bill->tag->name}}
                            </td>
                            <td>
                                <button class="show-modal btn btn-success" data-id="{{$bill->id}}" data-date="{{ $bill->date }}" data-sum="{{ $bill->sum }}" data-tag="{{ $bill->tag->name }}">Show</button>
                                <a class="btn btn-default" href="{{ route('bills.edit', ['id' => $bill->id]) }}">Edit</a>
                            </td>
                            <td>
                                <button class="delete-modal btn btn-danger" data-id="{{$bill->id}}">Delete</button>
                                {{--<form method="post" action="{{ route('bills.destroy', ['id' => $bill->id]) }}">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--{{ method_field('delete') }}--}}
                                    {{--<input type="submit" value="Delete" class="btn btn-danger">--}}
                                {{--</form>--}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div id="showModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Date:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="date_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="content">Sum:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sum_show" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="content">Tag:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tag_show" disabled>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure you want to delete the following bill?</h3>
                        <br />
                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="id">ID:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="id_delete" disabled>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger delete" data-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <canvas id="fullDateChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="tagChart"></canvas>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Show');
            $('#id_show').val($(this).data('id'));
            $('#date_show').val($(this).data('date'));
            $('#sum_show').val($(this).data('sum'));
            $('#tag_show').val($(this).data('tag'));
            $('#showModal').modal('show');
        });

        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                url: 'bills/' + id,
                type: 'DELETE',
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    $('.item' + data['id']).remove();
                }
            });
        });
    </script>
    <script>
        function random_rgba() {
            var o = Math.round, r = Math.random, s = 255;
            return 'rgb(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ')';
        }
    </script>
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
@endsection