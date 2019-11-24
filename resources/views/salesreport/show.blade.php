@extends('layouts.layouts')
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6" style=" padding-right: 5px;">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh Sách bán hàng</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p style="color: green">Tổng Doanh Thu
                            : {{ \App\Services\MyHelper::moneyFormating($getTotalExport) }}</p>
                        <p style="color: green">Tổng Lợi nhuận
                            : {{ \App\Services\MyHelper::moneyFormating($getTotalProfit)  }}</p>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Khách Hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Lợi nhuận</th>
                                <th>Ngày</th>
                                <th>Thêm</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($order1s as $order1)
                                <tr>
                                    <td>{{ $order1->customer->name }}</td>
                                    <td>{{ \App\Services\MyHelper::moneyFormating($order1->getTotal()) }}</td>
                                    <td>{{ \App\Services\MyHelper::moneyFormating($order1->details->sum('profit'))}}</td>
                                    <td>{{ $order1->created_at->diffForHumans() }}</td>

                                    <td>
                                        <a href="{{ route('export.show', $order1->code) }}">
                                            <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Danh sách nhâp hàng</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p style="color: green">Tổng : {{ \App\Services\MyHelper::moneyFormating($getTotalImport) }}</p>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Công Ty</th>
                                <th>Thành Tiền</th>
                                <th>Ngày Nhập</th>
                                <th>Chi tiết</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->supplier->name }}</td>
                                    <td>{{ \App\Services\MyHelper::moneyFormating($order->getTotal()) }}</td>
                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('import.show', $order->code) }}">
                                            <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                        </a>
                                        {{--<a href="{{ route('import.edit', $order) }}"><button class="btn btn-block btn-success btn-xs">Chỉnh Sửa</button></a>--}}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh Sách Chi Tiêu</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p style="color: green">Tổng : {{ \App\Services\MyHelper::moneyFormating($expenses->sum('total')) }}</p>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nội dung chi</th>
                                <th>Tổng</th>
                                <th>Ngày chi</th>
                                <th>Thêm</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{$expense->content }}</td>
                                    <td>{{$expense->total }}</td>
                                    <td>{{$expense->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('expense.show',$expense->id) }}"><button class="btn btn-block btn-info btn-xs">Chi Tiết</button></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>


        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end) {
                var a = start.format('YYYY-MM-DD');
                var b = end.format('YYYY-MM-DD');
                $("#date_min").attr('value', a);
                $("#date_max").attr('value', b);
            });
        });
    </script>
@endsection