@extends('layouts.layouts')

@section('style')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tất cả {{$currentPage}}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <div class="input-group-btn">
                                    <a href="{{ route('expense.create') }}">
                                        <button class="btn btn-success btn-sm">Tạo {{$currentPage}}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nội dung chi</th>
                                <th>Số tiền</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Ngày chi</th>
                                <th>Ghi chú</th>
                                <th>Tùy chọn</th>
                            </tr>

                            </thead>
                            <tbody>

                            @foreach ($expenses as $expense)
                                <tr>
                                    <td>{{$expense->content }}</td>
                                    <td>{{$expense->price }}  </td>
                                    <td>{{$expense->quantity }}</td>
                                    <td>{{$expense->total }}</td>
                                    <td>{{$expense->created_at }}</td>
                                    <td>{{$expense->note }}</td>
                                    <td>
                                        <a href="{{ route('expense.show', $expense->id) }}"><button class="btn btn-block btn-info btn-xs">Chi Tiết</button></a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        {{$expenses->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
@section('script')
    <script>
    </script>
@endsection