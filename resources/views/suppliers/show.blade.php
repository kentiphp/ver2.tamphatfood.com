@extends('layouts.layouts')

@section('style')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$currentPage}} - {{$supplier->name}}} </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Số Điện Thoại</th>
                                <th>Ghi chú</th>
                                <th>Chỉnh sửa/Xóa</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$supplier->code }}</td>
                                <td>{{$supplier->name }}  </td>
                                <td>{{$supplier->phone_number }}  </td>
                                <td>{{$supplier->note }}  </td>
                                <td>
                                    <a href="{{ route('suppliers.edit', $supplier) }}">
                                        <button type="submit" class="btn btn-block btn-success btn-xs">Edit</button>
                                    </a>

                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST">
                                        @csrf
                                        {!! method_field('DELETE') !!}
                                        <button type="submit" value="delete" class="btn btn-block btn-danger btn-xs">Delete</button>
                                    </form>
                                </td>
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