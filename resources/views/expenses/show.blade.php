@extends('layouts.layouts')
@section('style')

@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$currentPage}} {{$expense->content}} </h3>
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
                                <tr>
                                    <td>{{$expense->content }}</td>
                                    <td>{{$expense->price }}  </td>
                                    <td>{{$expense->quantity }}</td>
                                    <td>{{$expense->total }}</td>
                                    <td>{{$expense->created_at }}</td>
                                    <td>{{$expense->note }}</td>

                                    <td>

                                        <a href="{{ route('expense.edit',$expense) }}"><button type="submit" value="delete" class="btn btn-block btn-success btn-xs">Edit</button></a>

                                        <form action="{{ route('expense.destroy', $expense->id) }}" method="POST">
                                            @csrf
                                            {!! method_field('DELETE') !!}
                                            <button type="submit" value="delete" class="btn btn-block btn-danger btn-xs">Delete</button>
                                        </form></td>
                                </tr>
                            </tbody>

                        </table>
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