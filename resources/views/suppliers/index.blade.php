@extends('layouts.layouts')

@section('style')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh Sách {{$currentPage}}</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <div class="input-group-btn">
                                    <a href="{{ route('suppliers.create') }}">
                                        <button class="btn btn-success btn-sm">Thêm {{$currentPage}}</button>
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
                                <th style="width:10px;">#</th>
                                <th>Tên</th>
                                <th >Số điện thoại</th>
                                <th style="width:150px;">Sản phẩm cung cấp</th>
                                <th style="width:150px;">Chỉnh sửa/Xóa</th>
                            </tr>

                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp

                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{$i++ }}</td>
                                    <td>{{$supplier->name }}  </td>
                                    <td>{{$supplier->phone_number }}  </td>
                                    <td>{{$supplier->commodities_count }}  </td>
                                    <td>
                                        <a href="{{ route('suppliers.show', $supplier->code) }}"><button class="btn btn-block btn-info btn-xs">Chi Tiết</button></a>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        {{$suppliers->links()}}

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