@extends('layouts.layouts')
@section('style')

@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách đơn hàng đã đặt</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Số Sản phẩm</th>
                                <th>Thành tiền</th>
                                <th>Ngày nhập</th>
                                <th>Thêm</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($exports as $export)
                                <tr>
                                    <td>{{ $export->code }}</td>
                                    {{-- <td>{{ $detail->commodity->unitToString() }}</td>--}}
                                    <td>{{ $export->details_count }}</td>
                                    <td>{{ \App\Services\MyHelper::moneyFormating($export->getTotal()) }}</td>
                                    <td>{{ $export->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('export.show', $export->code) }}">
                                            <button type="submit" value="delete" class="btn btn-block btn-info btn-xs">
                                                Chi tiết
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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