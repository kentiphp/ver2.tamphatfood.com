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
                                    <a href="{{ route('commodities.create') }}">
                                        <button class="btn btn-success btn-sm">Thêm mới sản phẩm</button>
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
                                <th style="width: 10px">#</th>
                                <th>Tên sản phẩm</th>
                                <th>Nhà Cung Cấp</th>
                                <th>Quy cách</th>
                                <th>Đơn vị tính</th>
                                <th style="width: 150px;">Sản phẩm / Thùng</th>
                                <th style="width: 150px;">Thông tin thêm</th>
                            </tr>

                            </thead>
                            <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($commodities as $commodity)
                                <tr>
                                    <td>{{$i++ }}</td>
                                    <td>{{$commodity->name }}  </td>
                                    <td>{{$commodity->supplier->name }}  </td>
                                    <td>{{$commodity->specifications }}</td>
                                    <td>{{$commodity->unit }}</td>
                                    <td>{{$commodity->product_carton }}</td>
                                    <td>
                                        <a href="{{ route('commodities.show', $commodity->code) }}">
                                            <button class="btn btn-block btn-info btn-xs">Chi Tiết</button>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$commodities->links()}}
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